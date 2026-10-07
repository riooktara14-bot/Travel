<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'kode_booking',
        'pelanggan_id',
        'transportasi_id',
        'nama_pelanggan',
        'paket_wisata',
        'tanggal_berangkat',
        'jumlah_peserta',
        'total_biaya',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'total_biaya' => 'decimal:2',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
