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
            [
                'kode_produk' => 'YSS-1TM-C01',
                'nama_produk' => 'Marlboro Rokok Filter Ice Burst Special Edition 20',
                'kategori_id' => 1,
                'supplier_id' => 1,
                'harga' => 20000,
                'stock' => 7,
                'deskripsi' => 'Marlboro Rokok Filter Ice Burst Special Edition 20 adalah rokok dengan rasa segar yang menyegarkan. Menghadirkan kombinasi tembakau pilihan dan sentuhan es yang memberikan pengalaman merokok yang unik. Desain kemasannya modern dan praktis, menjadikannya pilihan yang populer di kalangan perokok yang menginginkan sensasi ringan dengan kesegaran yang tajam. Ideal untuk dinikmati di waktu santai atau saat berkumpul bersama teman-teman.',
                'gambar_produk' => 'marlborogold.jpg'
            ],
            [
                'kode_produk' => 'UNE-SA1-ONE',
                'nama_produk' => 'Marlboro Rokok Filter Gold Lights Special Edition 20',
                'kategori_id' => 2,
                'supplier_id' => 2,
                'harga' => 20000,
                'stock' => 88,
                'deskripsi' => 'Marlboro Rokok Filter Gold Lights Special Edition 20 adalah rokok dengan rasa ringan yang memikat. Dibuat dengan tembakau berkualitas tinggi yang dipadukan dengan sentuhan emas, rokok ini menawarkan pengalaman merokok yang elegan dan memuaskan. Desain kemasannya yang mewah mencerminkan kualitas tinggi dari produk ini. Cocok untuk mereka yang menginginkan sensasi merokok yang lebih halus namun tetap mewah, Marlboro Rokok Filter Gold Lights menjadi pilihan tepat bagi para pecinta rokok berkualitas.',
                'gambar_produk' => 'marlboroice.jpg'
            ],
            [
                'kode_produk' => 'QSS-TE2-L68',
                'nama_produk' => 'Marlboro Rokok Filter Hardpack Special Edition 20',
                'kategori_id' => 3,
                'supplier_id' => 3,
                'harga' => 50000,
                'stock' => 105,
                'deskripsi' => 'Marlboro Rokok Filter Hardpack Special Edition 20 adalah rokok dengan rasa kuat yang menggetarkan. Terbuat dari campuran tembakau pilihan dan cengkeh berkualitas tinggi, rokok ini memberikan sensasi merokok yang intens dan memuaskan. Kemasannya yang kokoh dan tangguh menambahkan kesan eksklusif pada produk ini. Cocok untuk mereka yang menginginkan pengalaman merokok yang lebih berat dan penuh karakter, Marlboro Rokok Filter Hardpack menjadi pilihan ideal bagi mereka yang menghargai kualitas dan cita rasa yang kuat.',
                'gambar_produk' => 'marlboroputih.jpg'
            ],
        ];


        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
