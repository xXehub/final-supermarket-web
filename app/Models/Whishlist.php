<?php

// app/Models/Whishlist.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Whishlist extends Model
{
    protected $table = 'whishlist';
    protected $fillable = ['user_id', 'produk_id'];
}