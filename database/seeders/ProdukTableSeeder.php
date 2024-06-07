<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['kode_produk' => 'YSS-1TM-COK', 'nama_produk' => 'Coke', 'kategori_id' => 1, 'harga' => 20000, 'stock' => 7, 'deskripsi' => 'Carbonated soft drink'],
            ['kode_produk' => 'ASW-TAI-OKE', 'nama_produk' => 'Chips', 'kategori_id' => 2, 'harga' => 20000, 'stock' => 88, 'deskripsi' => 'Potato chips'],
            ['kode_produk' => 'QSS-TE2-L68', 'nama_produk' => 'Detergent', 'kategori_id' => 3, 'harga' => 50000, 'stock' => 105, 'deskripsi' => 'Laundry detergent']
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
