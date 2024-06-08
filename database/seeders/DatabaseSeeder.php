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
            ProdukTableSeeder::class,
            SupplierSeeder::class,
            // add seeder disini ngab 
        ]);
    }
}
