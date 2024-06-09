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
            ['kode_kategori' => 'FIL', 'nama_kategori' => 'Rokok Filter', 'deskripsi' => 'Jenis rokok dengan filter'],
            ['kode_kategori' => 'KRE', 'nama_kategori' => 'Rokok Kretek', 'deskripsi' => 'Jenis rokok kretek tradisional'],
            ['kode_kategori' => 'LIG', 'nama_kategori' => 'Rokok Light', 'deskripsi' => 'Jenis rokok dengan kadar nikotin yang rendah'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
