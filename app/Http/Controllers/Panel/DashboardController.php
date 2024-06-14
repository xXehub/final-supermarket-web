<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pemesanan;
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
        // Mengambil data pengguna yang baru saja dibuat dari database
        $userAnyar = User::latest()->take(7)->get(); // Ambil 5 pengguna terbaru

        // Mengambil data pemesanan dari database
        $pemesanan = Pemesanan::all();

        // Mengelompokkan data pemesanan berdasarkan status
        $pemesananPerHari = [];
        foreach ($pemesanan as $data) {
            $tanggal = $data->created_at->format('l');
            if (!isset($pemesananPerHari[$tanggal])) {
                $pemesananPerHari[$tanggal] = [
                    'pending' => 0,
                    'dikemas' => 0,
                    'dikirim' => 0,
                    'diterima' => 0,
                ];
            }

            // Menambah jumlah produk dari setiap status pemesanan pada hari tersebut
            switch ($data->status) {
                case 'pending':
                    $pemesananPerHari[$tanggal]['pending']++;
                    break;
                case 'dikemas':
                    $pemesananPerHari[$tanggal]['dikemas']++;
                    break;
                case 'dikirim':
                    $pemesananPerHari[$tanggal]['dikirim']++;
                    break;
                case 'diterima':
                    $pemesananPerHari[$tanggal]['diterima']++;
                    break;
            }
        }

        // Menyiapkan data untuk chart
        $dates = array_keys($pemesananPerHari);
        $pendingData = array_column($pemesananPerHari, 'pending');
        $dikemasData = array_column($pemesananPerHari, 'dikemas');
        $dikirimData = array_column($pemesananPerHari, 'dikirim');
        $diterimaData = array_column($pemesananPerHari, 'diterima');

        // gawe produk info
        $totalProduk = Produk::count();
        $barangBaruToday = Produk::whereDate('created_at', Carbon::today())->count();

        // gawe user info
        $totalUser = User::count();
        $userBaruToday = User::whereDate('created_at', Carbon::today())->count();

        // gawe total pesanana
        $totalSemuaPesanan = Pemesanan::count();
        $totalPesananDiterima = Pemesanan::where('status', 'diterima')->count();
        $totalPemesanan = Pemesanan::count();

        $ingfo_sakkarepmu = "Dashboard";

        // Mengirimkan data ke view
        return view('panel.dashboard', [
            'totalProduk' => $totalProduk,
            'barangBaruToday' => $barangBaruToday,
            'totalUser' => $totalUser,
            'userBaruToday' => $userBaruToday,
            'totalSemuaPesanan' => $totalSemuaPesanan,
            'totalPesananDiterima' => $totalPesananDiterima,
            'totalPemesanan' => $totalPemesanan,
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pendingData' => $pendingData,
            'dikemasData' => $dikemasData,
            'dikirimData' => $dikirimData,
            'diterimaData' => $diterimaData,
            'dates' => $dates,
            'userAnyar' => $userAnyar, // Mengirimkan data pengguna baru ke view
        ])->with('success', 'Berhasil login.');

 
    }

    public function create()
    {
        $ingfo_sakkarepmu = 'Tambah Kategori';
        $produk = Kategori::all();
        $kategoris = Kategori::all();
        return view('panel.kategori.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produks' => $produk,
            'kategoris' => $kategoris,
        ]);
    }

}

