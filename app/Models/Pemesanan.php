<?php

// app/Models/Pemesanan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $fillable = ['user_id', 'tanggal', 'status'];
}