<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['kode_kategori' => 'MIN', 'nama_kategori' => 'Minuman', 'deskripsi' => 'Minuman ombenan sakkarepmu'],
            ['kode_kategori' => 'MAK', 'nama_kategori' => 'Makanan', 'deskripsi' => 'Yo panganan sakkarepmu'],
            ['kode_kategori' => 'BUA', 'nama_kategori' => 'Buah', 'deskripsi' => 'Buahmu Sakkarepmu'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
