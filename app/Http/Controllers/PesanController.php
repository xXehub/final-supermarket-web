<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $ingfo_sakkarepmu = 'List Pesanan Anda';
        $keranjang = Keranjang::where('user_id', $userId)->get();
        $pemesanans = Pemesanan::where('user_id', $userId)->get();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        $users = User::all();
        $jumlahProdukKeranjang = $keranjang->count();
        $metode_pembayaran = Pembayaran::select('metode_pembayaran')->distinct()->get(); 
        $jumlahPemesanan = $pemesanans->count();

        // Ambil total bayar dari tabel Pembayaran berdasarkan pemesanan
        $totalBayar = Pembayaran::whereIn('pemesanan_id', $pemesanans->pluck('id'))
            ->where('status', '!=', 'dibatalkan')
            ->sum('total');

        return view('supermarket.pesanan.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pemesanans' => $pemesanans,
            'keranjang' => $keranjang,
            'users' => $users,
            'produks' => $produks,
            'jumlahProdukKeranjang' => $jumlahProdukKeranjang,
            'jumlahPemesanan' => $jumlahPemesanan,
            'metode_pembayaran' => $metode_pembayaran,
            'totalBayar' => $totalBayar,
        ]);
    }

    public function show($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        return view('supermarket.pesanan.show', compact('pesanan'));
    }

    // gawe pesan
    public function pesan(Request $request)
    {
        DB::beginTransaction();

        try {
            // njupuk fungsi random data sing nde ngisor
            $kode_pesanan = $this->generateRandomCodePemesanan();
            $user_id = Auth::id();

            // simpen ndek db
            $pemesanan = new Pemesanan();
            $pemesanan->kode_pesanan = $kode_pesanan;
            $pemesanan->user_id = $user_id;
            $pemesanan->status = 'pending';
            $pemesanan->tanggal = now();
            $pemesanan->save();

            // Ambil semua item dalam keranjang pengguna
            $itemsKeranjang = Keranjang::where('user_id', $user_id)->get();

            // Simpan data pembayaran
            $totalBayar = $itemsKeranjang->sum(function ($item) {
                return $item->jumlah * $item->produk->harga;
            });

            Pembayaran::create([
                'pemesanan_id' => $pemesanan->id,
                'total' => $totalBayar,
                'metode_pembayaran' => 'dana',
                'status' => 'pending',
            ]);

            // Iterasi setiap item dalam keranjang belanja
            foreach ($itemsKeranjang as $item) {
                $produk = Produk::find($item->produk_id);
                if ($produk) {
                    // Hitung subtotal untuk item dalam keranjang
                    $subtotal = $item->jumlah * $produk->harga;

                    // Simpan data ke dalam database detail_pemesanan
                    $detailPemesanan = new DetailPemesanan();
                    $detailPemesanan->pemesanan_id = $pemesanan->id;
                    $detailPemesanan->produk_id = $item->produk_id;
                    $detailPemesanan->jumlah = $item->jumlah;
                    $detailPemesanan->subtotal = $subtotal;
                    $detailPemesanan->save();

                    // Kurangi stok produk
                    $produk->stock -= $item->jumlah;
                    $produk->save();
                }
            }

            // Hapus semua item dalam keranjang setelah ditambahkan ke detail pesanan
            Keranjang::where('user_id', $user_id)->delete();

            // Commit transaksi jika berhasil
            DB::commit();

            // Berikan respons ke frontend
            return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Pesanan gagal ditambahkan.');
        }
    }

    // Generate random code for the pesanan
    private function generateRandomCodePemesanan()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $result = '';
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $result .= $characters[rand(0, strlen($characters) - 1)];
            }
            if ($i < 2) {
                $result .= '-'; // Add hyphen after each group of characters except the last one
            }
        }
        return $result;
    }

    public function pesanKeranjang(Request $request)
    {
        // Proses pesanan dari keranjang
        // Ambil data keranjang pengguna
        $keranjang = Keranjang::where('user_id', auth()->user()->id)->get();

        // Buat entri baru dalam tabel pemesanan
        $pemesanan = Pemesanan::create([
            'user_id' => auth()->user()->id,
            'tanggal' => now(),
            'status' => 'pending',
        ]);

        // Loop melalui setiap item keranjang dan buat entri detail pemesanan
        foreach ($keranjang as $item) {
            DetailPemesanan::create([
                'pemesanan_id' => $pemesanan->id,
                'produk_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->produk->harga * $item->jumlah,
            ]);

            // Hapus item keranjang setelah dipesan
            $item->delete();
        }

        return redirect()->route('supermarket.pesanan')->with('success', 'Pesanan berhasil diproses.');
    }

    public function getData(Request $request)
    {
        $userId = Auth::id(); // gawe njupuk user sing lagi login
        $pemesanans = Pemesanan::with('user')
            ->where('user_id', $userId);

        if ($request->ajax()) {
            return datatables()->of($pemesanans)
                ->addIndexColumn()
                ->addColumn('nama_user', function ($pemesanan) {
                    return $pemesanan->user->name;
                })
                ->addColumn('gambar_profile', function ($pemesanan) {
                    return $pemesanan->user->gambar_profile;
                })
                ->addColumn('total_bayar', function ($pemesanan) {
                    // itungan totalan
                    $total_bayar = Pembayaran::where('pemesanan_id', $pemesanan->id)->sum('total');
                    return $total_bayar;
                })

                ->addColumn('status_bayar', function ($pemesanan) {
                    $status_bayar = Pembayaran::where('pemesanan_id', $pemesanan->id)->sum('status');
                    // convert e
                    switch ($status_bayar) {
                        case 1:
                            return 'pending';
                        case 2:
                            return 'dibatalkan';
                        case 3:
                            return 'dibayar';
                        default:
                            return 'pending';
                    }
                })
                ->addColumn('actions', function ($pesanan) {
                    return view('supermarket.pesanan.actions', compact('pesanan'));
                })
                ->toJson();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->name = $request->name;
        $pesanan->save();
        return redirect()->route('pesanan.index', ['id' => $pesanan->id])->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan deleted successfully.');
    }

    public function payment()
    {
        return view('pesanan.payment');
    }

}
