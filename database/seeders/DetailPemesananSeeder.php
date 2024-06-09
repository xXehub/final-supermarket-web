<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPemesanan;

class DetailPemesananSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan contoh data detail pemesanan di sini
        DetailPemesanan::create([
            'pemesanan_id' => 1, // Ganti dengan id pemesanan yang sesuai
            'produk_id' => 1, // Ganti dengan id produk yang sesuai
            'jumlah' => 2,
            'subtotal' => 20000,
        ]);

        // Tambahkan data lain jika diperlukan
    }
}