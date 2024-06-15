<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::create([
            'pemesanan_id' => 1, // Ganti dengan id pemesanan yang sesuai
            'total' => 20000,
            'metode_pembayaran' => 'dana', // Sesuaikan dengan salah satu dari enum yang ada
            'status' => 'pending', // Default status
        ]);

        Pembayaran::create([
            'pemesanan_id' => 2, // Ganti dengan id pemesanan yang sesuai
            'total' => 15000,
            'metode_pembayaran' => 'ovo', // Sesuaikan dengan salah satu dari enum yang ada
            'status' => 'dibayar', // Status yang telah dibayar
        ]);

        // Tambahkan sebanyak yang Anda butuhkan
    }
}