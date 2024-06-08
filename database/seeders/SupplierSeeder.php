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
                'nama_supplier' => 'Marlboro Rokok Filter Ice Burst Special Edition 20',
                'alamat' => 'Jl. Rokok Sejahtera No. 1',
                'no_hp' => '085731816771',
                'deskripsi' => 'Supplier rokok Marlboro'
            ],
            [
                'kode_supplier' => 'SUP-002',
                'nama_supplier' => 'Dunhill Rokok Fine Cut Blue 20',
                'alamat' => 'Jl. Rokok Asri No. 2',
                'no_hp' => '0815532217669',
                'deskripsi' => 'Supplier rokok Dunhill'
            ],
            [
                'kode_supplier' => 'SUP-003',
                'nama_supplier' => 'Gudang Garam Rokok Signature Mild 16',
                'alamat' => 'Jl. Rokok Damai No. 3',
                'no_hp' => '088989900911',
                'deskripsi' => 'Supplier rokok Gudang Garam'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
