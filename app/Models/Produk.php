<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk'; 
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // validator
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori_id',
        'harga',
        'stock',
        'deskripsi',
    ];

}
