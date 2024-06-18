<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\MetodePembayaran;
use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{

    // Menampilkan semua entri dalam tabel keranjang
    public function index()
    {
        $ingfo_sakkarepmu = 'List Produk Keranjang Anda';
        $userId = Auth::id();
        $keranjang = Keranjang::where('user_id', $userId)->get();
        $jumlahProdukKeranjang = $keranjang->count();
        $pemesanan = Pemesanan::where('user_id', $userId)->get();
        $metode_pembayaran = MetodePembayaran::select('id', 'nama')->get();
        $jumlahPemesanan = $pemesanan->count();
        // Hitung total bayar
        $totalBayar = $keranjang->sum(function ($keranjang) {
            return $keranjang->jumlah * $keranjang->produk->harga;
        });
        return view('supermarket.keranjang.index', compact('keranjang', 'totalBayar', 'jumlahProdukKeranjang', 'jumlahPemesanan', 'metode_pembayaran', 'ingfo_sakkarepmu'));
    }

    public function create()
    {
        return view('supermarket.keranjang.create');
    }
    public function store(Request $request)
    {
        $request->validate([

        ]);

        Keranjang::create([

        ]);

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Keranjang berhasil ditambahkan!');
    }

    // Menampilkan entri tertentu dalam tabel keranjang
    public function show($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('keranjang.show', ['keranjang' => $keranjang]);
    }
    public function edit($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('supermarket.keranjang.edit', compact('keranjang'))->with('success', 'Quantity updated successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Quantity updated successfully.');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $produk = $keranjang->produk;
        $jumlahDihapus = $keranjang->jumlah;
        $keranjang->delete();
        $produk->stock += $jumlahDihapus;
        $produk->save();

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Berhasil dihapus.');
    }

    public function tambahProduk(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $userId = Auth::id();
        $existingKeranjang = Keranjang::where('user_id', $userId)
            ->where('produk_id', $produk->id)
            ->first();

        // Validasi stok produk
        if ($produk->stock < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok produk sudah habis.');
        }

        // Kurangi stok produk sesuai dengan jumlah yang ditambahkan ke keranjang
        $produk->stock -= $request->jumlah;

        // Simpan perubahan stok produk
        $produk->save();

        if ($existingKeranjang) {
            // Tambahkan jumlah produk yang sudah ada di keranjang
            $existingKeranjang->jumlah += $request->jumlah;
            $existingKeranjang->save();

            // Berikan respons kepada pengguna bahwa produk sudah ada di keranjang dan jumlah telah ditambahkan
            return redirect()->back()->with('status', 'updated');
        } else {
            // Simpan data produk ke dalam keranjang
            $keranjang = new Keranjang();
            $keranjang->produk_id = $produk->id;
            $keranjang->jumlah = $request->jumlah;
            $keranjang->user_id = $userId;
            $keranjang->save();

            // Berikan respons kepada pengguna bahwa produk berhasil ditambahkan ke keranjang
            return redirect()->back()->with('status', 'added');
        }
    }

    // gawe get data
    public function getData(Request $request)
    {
        $userId = Auth::id(); // Dapatkan ID pengguna yang sedang masuk
        $keranjangs = Keranjang::with(['user', 'produk'])->where('user_id', $userId);

        if ($request->ajax()) {
            return datatables()->of($keranjangs)
                ->addIndexColumn()
                ->addColumn('nama_user', function ($keranjang) {
                    return $keranjang->user->name ?? 'N/A';
                })
                ->addColumn('nama_produk', function ($keranjang) {
                    return $keranjang->produk->nama_produk ?? 'N/A';
                })
                ->addColumn('harga', function ($keranjang) {
                    return $keranjang->produk->harga ?? 0;
                })
                ->addColumn('gambar_produk', function ($keranjang) {
                    return $keranjang->produk->gambar_produk ?? 'N/A';
                })
                ->addColumn('nama_kategori', function ($keranjang) {
                    return $keranjang->produk->kategori->nama_kategori ?? 'N/A';
                })
                ->addColumn('jumlah', function ($keranjang) {
                    return $keranjang->jumlah ?? 0;
                })
                ->addColumn('created_at', function ($keranjang) {
                    return $keranjang->created_at ? $keranjang->created_at->format('Y-m-d H:i:s') : 'N/A';
                })
                ->addColumn('subtotal', function ($keranjang) {
                    return ($keranjang->jumlah ?? 0) * ($keranjang->produk->harga ?? 0);
                })
                ->addColumn('actions', function ($keranjang) {
                    return view('supermarket.keranjang.actions', compact('keranjang'));
                })
                ->toJson();
        }
    }
    public function payment()
    {
        return view('pesanan.payment');
    }

}
