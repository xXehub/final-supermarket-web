<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->integer('total');
            $table->enum('metode_pembayaran', ['dana', 'ovo', 'gopay'])->default('dana');
            $table->enum('status', ['pending', 'dibatalkan', 'dibayar'])->default('pending');
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
