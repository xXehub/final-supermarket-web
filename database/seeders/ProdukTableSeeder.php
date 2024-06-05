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
            ['kode_produk' => 'A-001', 'nama_produk' => 'Coke', 'kategori_id' => 1, 'harga' => 20.000, 'stock' => 100, 'deskripsi' => 'Carbonated soft drink'],
            ['kode_produk' => 'A-002', 'nama_produk' => 'Chips', 'kategori_id' => 2, 'harga' => 20.000, 'stock' => 150, 'deskripsi' => 'Potato chips'],
            ['kode_produk' => 'G-001', 'nama_produk' => 'Detergent', 'kategori_id' => 3, 'harga' => 50.000, 'stock' => 50, 'deskripsi' => 'Laundry detergent']
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
