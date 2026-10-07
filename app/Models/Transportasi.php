<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;

    protected $table = 'transportasis';

    protected $fillable = [
        'nama_transportasi',
        'jenis_transportasi',
        'perusahaan',
        'rute',
        'deskripsi',
        'harga',
        'kapasitas',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'kapasitas' => 'integer',
    ];

    public function getJenisAttribute()
    {
        return $this->jenis_transportasi;
    }

    public function setJenisAttribute($value)
    {
        $this->attributes['jenis_transportasi'] = $value;
    }
}
