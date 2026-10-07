<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';

    protected $fillable = [
        'nama_promo',
        'kode_promo',
        'deskripsi',
        'tipe_diskon',
        'nilai_diskon',
        'minimal_transaksi',
        'gambar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'nilai_diskon' => 'decimal:2',
        'minimal_transaksi' => 'decimal:2',
    ];
}
