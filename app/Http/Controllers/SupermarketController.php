<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class SupermarketController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari model Produk
        $produks = Produk::all();
        
        // Kirimkan variabel $produks ke view 'supermarket.index'
        return view('supermarket.index', compact('produks')); 
    }
}
