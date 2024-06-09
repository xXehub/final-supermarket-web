<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan contoh data pembayaran di sini
        Pembayaran::create([
            'pemesanan_id' => 1, // Ganti dengan id pemesanan yang sesuai
            'total' => 20000,
            'metode_pembayaran' => 'Cash on Delivery',
        ]);

        // Tambahkan data lain jika diperlukan
    }
}