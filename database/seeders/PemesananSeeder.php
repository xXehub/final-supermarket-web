<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan contoh data pemesanan di sini
        Pemesanan::create([
            'user_id' => 1, // Ganti dengan id pengguna yang sesuai
            'tanggal' => now(),
            'status' => 'pending',
        ]);

        // Tambahkan data lain jika diperlukan
    }
}