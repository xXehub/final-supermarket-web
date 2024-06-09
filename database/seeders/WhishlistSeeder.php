<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Whishlist;

class WhishlistSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan contoh data whishlist di sini
        Whishlist::create([
            'user_id' => 1, // Ganti dengan id pengguna yang sesuai
            'produk_id' => 1, // Ganti dengan id produk yang sesuai
        ]);

        // Tambahkan data lain jika diperlukan
    }
}