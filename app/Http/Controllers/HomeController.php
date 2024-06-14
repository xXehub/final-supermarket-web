<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalProduk = Produk::count();
        $ingfo_sakkarepmu = "Dashboard";
        $produks = Produk::all(); // Tambahkan baris ini
        return view('home', [
            'totalProduk' => $totalProduk,
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produks' => $produks, // Tambahkan ini untuk meneruskan data produk ke view
        ]);
    }
    
}
