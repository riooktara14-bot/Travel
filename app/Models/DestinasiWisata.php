<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    use HasFactory;

    protected $table = 'destinasi_wisatas';

    protected $fillable = [
        'nama_destinasi',
        'lokasi',
        'deskripsi',
        'harga',
        'durasi',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'durasi' => 'integer',
    ];
}
