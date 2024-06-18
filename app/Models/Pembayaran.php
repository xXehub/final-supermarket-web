<?php
// app/Models/Pembayaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['id', 'pemesanan_id', 'total', 'metode_pembayaran_id', 'status', 'gambar_profile'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}