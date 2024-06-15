<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
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
        $userAnyar = User::latest()->take(7)->get(); // Ambil 5 pengguna terbaru
        // Ambil tanggal hari ini
        $today = Carbon::now();
        // Buat array yang berisi nama-nama hari dari hari Senin hingga Minggu
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        // Ambil indeks hari ini dalam array $daysOfWeek
        $todayIndex = $today->dayOfWeek;
        // Ambil tanggal 7 hari yang lalu
        $startDate = $today->subDays(6);

        $pemesananPerHari = [];
        // Lakukan iterasi untuk 7 hari terakhir
        for ($i = 0; $i < 7; $i++) {
            // Ambil nama hari berdasarkan indeks hari dalam $daysOfWeek
            $hari = $daysOfWeek[($todayIndex + $i) % 7];
            // Ubah nama hari menjadi format l
            $hari = Carbon::createFromFormat('l', $hari)->format('l');
            // Masukkan nama hari ke dalam array $pemesananPerHari
            $pemesananPerHari[$hari] = [
                'pending' => 0,
                'dikemas' => 0,
                'dikirim' => 0,
                'diterima' => 0,
            ];
        }

        // Mengambil data pemesanan dari database
        $pemesanan = Pemesanan::whereBetween('created_at', [$startDate, Carbon::now()])
            ->orderBy('created_at')
            ->get();

        // Sekarang, lakukan pengisian data pemesanan sesuai dengan logikanya seperti sebelumnya
        foreach ($pemesanan as $data) {
            $tanggal = $data->created_at->format('l');
            // Pastikan tanggal berada di dalam array $pemesananPerHari yang sudah ditentukan
            if (isset($pemesananPerHari[$tanggal])) {
                // Lakukan penambahan jumlah pemesanan sesuai statusnya
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
        }

        // Menyiapkan data untuk chart
        $dates = array_keys($pemesananPerHari);
        $pendingData = array_column($pemesananPerHari, 'pending');
        $dikemasData = array_column($pemesananPerHari, 'dikemas');
        $dikirimData = array_column($pemesananPerHari, 'dikirim');
        $diterimaData = array_column($pemesananPerHari, 'diterima');

        // gawe user info
        $totalUser = User::count();
        $userBaruToday = User::whereDate('created_at', Carbon::today())->count();

        // gawe produk info
        $totalProduk = Produk::count();
        $barangBaruToday = Produk::whereDate('created_at', Carbon::today())->count();

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
        ]);
    }
}
