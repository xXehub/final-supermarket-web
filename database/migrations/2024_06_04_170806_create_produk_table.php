<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 20)->unique();
            $table->string('nama_produk', 100);
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade'); // Cascade delete
            $table->foreignId('supplier_id')->constrained('supplier');
            $table->integer('harga');
            $table->integer('stock');
            $table->text('deskripsi')->nullable();
            $table->string('gambar_produk')->nullable(); // update gambar produk ommmmm wkwk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
