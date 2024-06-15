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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // validator
    protected $fillable = [
        'id',
        'kode_produk',
        'nama_produk',
        'kategori_id',
        'supplier_id',
        'harga',
        'stock',
        'deskripsi',
        'gambar_produk',
    ];

}
