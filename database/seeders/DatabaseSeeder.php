<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            KategoriSeeder::class,
            SupplierSeeder::class,
            ProdukTableSeeder::class,
            WhishlistSeeder::class,
            PemesananSeeder::class,
            DetailPemesananSeeder::class,
            MetodePembayaranSeeder::class,
            PembayaranSeeder::class,
            KeranjangSeeder::class,

            // add seeder disini ngab 
        ]);
    }
}
