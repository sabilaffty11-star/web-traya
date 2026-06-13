<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'Shop',
        'gambar',
        'user_id',
        'status'
    ];
    
    // Relasi ke User (penjual)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}