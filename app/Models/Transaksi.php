<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'nama_pelanggan',
        'paket_wisata',
        'metode_pembayaran',
        'total',
        'tanggal_transaksi',
        'status',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'total' => 'decimal:2',
    ];

    public static function syncPaidBookings(): void
    {
        Booking::whereIn('status', ['Lunas', 'Selesai'])
            ->get()
            ->each(function (Booking $booking): void {
                self::updateOrCreate(
                    ['kode_transaksi' => $booking->kode_booking],
                    [
                        'nama_pelanggan' => $booking->nama_pelanggan,
                        'paket_wisata' => $booking->paket_wisata,
                        'metode_pembayaran' => $booking->metode_pembayaran ?: 'Belum dipilih',
                        'total' => $booking->total_biaya,
                        'tanggal_transaksi' => $booking->tanggal_berangkat,
                        'status' => $booking->status,
                    ],
                );
            });
    }

    /**
     * @return Collection<int, self>
     */
    public static function incomeRecords(): Collection
    {
        return self::whereIn('status', ['Lunas', 'Selesai'])->get();
    }
}
