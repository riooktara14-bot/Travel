<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_loads_and_can_create_record(): void
    {
        $response = $this->get('/booking');
        $response->assertOk();

        $create = $this->post('/booking', [
            'kode_booking' => 'BK-1001',
            'nama_pelanggan' => 'Budi Santoso',
            'paket_wisata' => 'Bali Escape',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2500000,
            'status' => 'Menunggu Pembayaran',
        ]);

        $create->assertRedirect('/booking');
        $this->assertDatabaseHas('bookings', ['kode_booking' => 'BK-1001']);
    }
}
