<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with total product count.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalProduk = Produk::count();
        $ingfo_sakkarepmu = "Dashboard";
        return view('panel.dashboard', [
            'totalProduk' => $totalProduk,
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
        ]);
    }
}
