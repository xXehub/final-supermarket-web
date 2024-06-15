<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;
use App\Models\Supplier;

class ProdukFactory extends Factory
{
    protected $model = \App\Models\Produk::class;

    public function definition()
    {
        return [
            'kode_produk' => strtoupper($this->faker->regexify('[A-Za-z]{3}-[A-Za-z]{3}-[A-Za-z]{3}')),
            'nama_produk' => $this->faker->word,
            'kategori_id' => Kategori::factory()->create()->id,
            'supplier_id' => Supplier::factory()->create()->id,
            'harga' => $this->faker->numberBetween(1000, 100000),
            'stock' => $this->faker->numberBetween(1, 100),
            'deskripsi' => $this->faker->optional()->text,
            'gambar_produk' => $this->faker->optional()->imageUrl(640, 480, 'product', true),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
