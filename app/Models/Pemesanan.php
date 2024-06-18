<?php

// app/Models/Pemesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{

    protected $table = 'pemesanan';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class);
    }
    
    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    protected $fillable = ['id', 'kode_pesanan', 'name', 'user_id', 'tanggal', 'status', 'gambar_profile'];
}