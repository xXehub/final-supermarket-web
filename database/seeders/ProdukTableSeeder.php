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
                'kode_produk' => 'YSS-1TM-COK',
                'nama_produk' => 'Surya Pro Mild',
                'kategori_id' => 1,
                'harga' => 20000,
                'stock' => 7,
                'deskripsi' => 'Surya Pro Mild adalah sigaret kretek yang menawarkan pengalaman merokok dengan rasa yang lebih ringan dan halus. Dihasilkan dari campuran tembakau pilihan dan cengkeh berkualitas tinggi, rokok ini memberikan aroma khas yang menyenangkan. Desain kemasannya modern dan praktis, menjadikannya pilihan yang populer di kalangan perokok yang menginginkan kualitas dengan rasa yang tidak terlalu kuat. Ideal untuk dinikmati di waktu santai ataupun saat berkumpul bersama teman-teman.'
            ],
            [
                'kode_produk' => 'ASW-TAI-OKE',
                'nama_produk' => 'Sampoerna Revolution',
                'kategori_id' => 2,
                'harga' => 20000,
                'stock' => 88,
                'deskripsi' => 'Sampoerna Revolution adalah sigaret kretek premium yang dirancang untuk memberikan pengalaman merokok yang mewah dan memuaskan. Dengan tembakau berkualitas tinggi yang dipadukan dengan cengkeh pilihan, rokok ini menawarkan rasa yang kaya dan kompleks. Kemasannya elegan dan mencerminkan kualitas tinggi dari produk ini. Cocok untuk mereka yang menginginkan sensasi merokok yang lebih dalam dan memuaskan, Sampoerna Revolution menjadi pilihan tepat bagi para pecinta rokok kretek.'
            ],
            [
                'kode_produk' => 'QSS-TE2-L68',
                'nama_produk' => 'Djarum Black',
                'kategori_id' => 3,
                'harga' => 50000,
                'stock' => 105,
                'deskripsi' => 'Djarum Black adalah sigaret kretek hitam yang dikenal dengan rasa kuat dan aroma khas yang unik. Terbuat dari campuran tembakau pilihan dan cengkeh berkualitas tinggi, rokok ini memberikan sensasi merokok yang intens dan memuaskan. Kemasan hitamnya yang ikonik menambahkan kesan elegan dan eksklusif pada produk ini. Djarum Black sangat populer di kalangan perokok yang menginginkan pengalaman merokok yang lebih berat dan berkarakter. Ideal untuk dinikmati oleh mereka yang menghargai kualitas dan cita rasa yang kuat.'
            ],
        ];


        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
