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

class PesanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $ingfo_sakkarepmu = 'List Pemesanan';
        $keranjang = Keranjang::where('user_id', $userId)->get();
        $pemesanans = Pemesanan::first();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        $users = User::all();
        $jumlahProdukKeranjang = $keranjang->count();
        $totalBayar = $keranjang->sum(function ($keranjang) {
            return $keranjang->jumlah * $keranjang->produk->harga;
        });
        return view('supermarket.pesanan.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pemesanan' => $pemesanans,
            'keranjang' => $keranjang,
            'users' => $users,
            'produks' => $produks,
            'jumlahProdukKeranjang' => $jumlahProdukKeranjang,
            'totalBayar' => $produks,
        ]);
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
        $userId = Auth::id(); // Mendapatkan user_id yang sedang login

        $pemesanans = Pemesanan::with('user')
            ->where('user_id', $userId); // Menambahkan kondisi where

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
                    // kalkulasi total bayar
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
                ->addColumn('actions', function ($pemesanan) {
                    return view('supermarket.pesanan.actions', compact('pemesanan'));
                })
                ->toJson();
        }
    }

}
