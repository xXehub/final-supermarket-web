<?php

// app/Models/DetailPemesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $fillable = ['pemesanan_id', 'produk_id', 'jumlah', 'subtotal'];
}