<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\User;

class KeranjangSeeder extends Seeder
{
    public function run()
    {
        // Ambil beberapa produk dari database
        $produks = Produk::inRandomOrder()->limit(5)->get();

        // Ambil beberapa user dari database
        $users = User::inRandomOrder()->limit(3)->get();

        // looping
        foreach ($produks as $produk) {
            // jupuk user random
            $user = $users->random();

            Keranjang::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'jumlah' => rand(1, 5), // jumlah produk sing nde keranjang
    
            ]);
        }
    }
}
