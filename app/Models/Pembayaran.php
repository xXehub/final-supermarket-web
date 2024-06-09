<?php
// app/Models/Pembayaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['pemesanan_id', 'total', 'metode_pembayaran'];
}