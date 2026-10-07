<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;

    protected $table = 'tour_guides';

    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'bahasa',
        'spesialisasi',
        'harga_per_hari',
        'rating',
        'deskripsi',
        'foto',
        'status',
    ];

    protected $casts = [
        'harga_per_hari' => 'decimal:2',
        'rating' => 'decimal:1',
    ];
}
