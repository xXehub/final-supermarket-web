<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; 
    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::class); 
    }
}
