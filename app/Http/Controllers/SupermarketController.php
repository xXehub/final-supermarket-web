<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class SupermarketController extends Controller
{
    public function index()
    {
        $ingfo_sakkarepmu = 'Tambah Kategori';
        $produk = Kategori::all();
        $kategoris = Kategori::all();
        return view('supermarket.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produks' => $produk,
            'kategoris' => $kategoris,
        ]);
    }

    public function create()
    {
        // Ambil semua kategori dari database
        $kategoris = Kategori::all();

        // Kirim data kategori ke view
        return view('supermarket.index', ['kategoris' => $kategoris]);
    }

}
