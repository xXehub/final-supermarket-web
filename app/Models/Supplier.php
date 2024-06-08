<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'supplier'; 

    /**
     * ambil data produk gawe supplier
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'alamat',
        'no_hp',
        'deskripsi',
    ];

}
