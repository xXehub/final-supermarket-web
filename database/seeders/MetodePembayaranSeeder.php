<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetodePembayaran;

class MetodePembayaranSeeder extends Seeder
{
    public function run()
    {
        MetodePembayaran::create(['nama' => 'Dana']);
        MetodePembayaran::create(['nama' => 'Ovo']);
        MetodePembayaran::create(['nama' => 'Gopay']);
    }
}
