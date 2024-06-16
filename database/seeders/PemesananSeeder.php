<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        Pemesanan::create([
            'kode_pesanan' => '6SJ-IVA-8KL',
            'user_id' => 1, 
            'tanggal' => now(),
            'status' => 'pending',
        ]);

        Pemesanan::create([
            'kode_pesanan' => 'SSI-09A-BBC',
            'user_id' => 2, 
            'tanggal' => now(),
            'status' => 'pending',
        ]);
    }
}