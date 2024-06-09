<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'kode_supplier' => 'SUP-001',
                'nama_supplier' => 'PT Djarum',
                'alamat' => 'Jl. Djarum No. 1',
                'no_hp' => '081234567890',
                'deskripsi' => 'Supplier rokok Djarum'
            ],
            [
                'kode_supplier' => 'SUP-002',
                'nama_supplier' => 'PT Gudang Garam',
                'alamat' => 'Jl. Gudang Garam No. 2',
                'no_hp' => '081234567891',
                'deskripsi' => 'Supplier rokok Gudang Garam'
            ],
            [
                'kode_supplier' => 'SUP-003',
                'nama_supplier' => 'PT Sampoerna',
                'alamat' => 'Jl. Sampoerna No. 3',
                'no_hp' => '081234567892',
                'deskripsi' => 'Supplier rokok Sampoerna'
            ]
        ];        

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
