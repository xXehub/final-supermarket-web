<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with total product count.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // gawe produk info
        $totalProduk = Produk::count();
        $barangBaruToday = Produk::whereDate('created_at', Carbon::today())->count();

        // gawe user info
        $totalUser = User::count();
        $userBaruToday = User::whereDate('created_at', Carbon::today())->count();

        $ingfo_sakkarepmu = "Dashboard";
        return view('panel.dashboard', [
            'totalProduk' => $totalProduk,
            'barangBaruToday' => $barangBaruToday,
            'totalUser' => $totalUser,
            'userBaruToday' => $userBaruToday,
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
        ]);
    }

    
}
