<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'nama_hotel',
        'lokasi',
        'deskripsi',
        'harga_per_malam',
        'rating',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga_per_malam' => 'decimal:2',
        'rating' => 'decimal:1',
    ];
}
