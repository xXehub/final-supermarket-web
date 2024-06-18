<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->integer('total');
            $table->unsignedBigInteger('metode_pembayaran_id'); // Menggunakan id dari tabel metode_pembayaran
            $table->enum('status', ['pending', 'dibatalkan', 'diproses', 'dibayar'])->default('pending');
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan')->onDelete('cascade');
            $table->foreign('metode_pembayaran_id')->references('id')->on('metode_pembayaran')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

