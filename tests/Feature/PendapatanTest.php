<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendapatanTest extends TestCase
{
    use RefreshDatabase;

    public function test_pendapatan_page_shows_real_transaction_data(): void
    {
        Transaksi::create([
            'kode_transaksi' => 'TRX-1001',
            'nama_pelanggan' => 'Rina',
            'paket_wisata' => 'Bali Classic',
            'metode_pembayaran' => 'Transfer Bank',
            'total' => 1000000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Lunas',
        ]);

        $response = $this->get('/pendapatan');

        $response->assertOk();
        $response->assertSee('Rp1.000.000');
        $response->assertSee('TRX-1001');
    }

    public function test_pendapatan_can_create_transaction(): void
    {
        $response = $this->post('/pendapatan', [
            'kode_transaksi' => 'TRX-2001',
            'nama_pelanggan' => 'Dewi',
            'paket_wisata' => 'Labuan Bajo',
            'metode_pembayaran' => 'QRIS',
            'total' => 2500000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Lunas',
        ]);

        $response->assertRedirect('/pendapatan');
        $this->assertDatabaseHas('transaksi', [
            'kode_transaksi' => 'TRX-2001',
            'nama_pelanggan' => 'Dewi',
            'paket_wisata' => 'Labuan Bajo',
        ]);
    }

    public function test_paid_booking_is_shown_as_income(): void
    {
        Booking::create([
            'kode_booking' => 'BK-3001',
            'nama_pelanggan' => 'Budi',
            'paket_wisata' => 'Bali Escape',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 3000000,
            'status' => 'Lunas',
        ]);

        $response = $this->get('/pendapatan');

        $response->assertOk();
        $response->assertSee('BK-3001');
        $response->assertSee('Rp3.000.000');
    }

    public function test_admin_dashboard_income_matches_paid_transactions_and_bookings(): void
    {
        $this->actingAs(User::factory()->create([
            'role' => 'admin',
            'status' => 'aktif',
        ]));

        Transaksi::create([
            'kode_transaksi' => 'TRX-ADMIN-PAID',
            'nama_pelanggan' => 'Rina',
            'paket_wisata' => 'Bali Classic',
            'metode_pembayaran' => 'Transfer Bank',
            'total' => 1000000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Lunas',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-ADMIN-PENDING',
            'nama_pelanggan' => 'Dewi',
            'paket_wisata' => 'Labuan Bajo',
            'metode_pembayaran' => 'QRIS',
            'total' => 9000000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Pending',
        ]);

        Booking::create([
            'kode_booking' => 'BK-ADMIN-PAID',
            'nama_pelanggan' => 'Budi',
            'paket_wisata' => 'Bali Escape',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2000000,
            'status' => 'Lunas',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'BK-ADMIN-PAID',
            'nama_pelanggan' => 'Budi',
            'paket_wisata' => 'Bali Escape',
            'metode_pembayaran' => 'Transfer Bank',
            'total' => 500000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Lunas',
        ]);

        $response = $this->get('/admin');

        $response->assertOk();
        $response->assertSee('Rp3.000.000');
        $response->assertDontSee('Rp3.500.000');
        $response->assertDontSee('Rp12.000.000');
    }

    public function test_payment_method_update_is_kept_for_booking_income(): void
    {
        $booking = Booking::create([
            'kode_booking' => 'BK-4001',
            'nama_pelanggan' => 'Sari',
            'paket_wisata' => 'Lombok',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 1,
            'total_biaya' => 1500000,
            'metode_pembayaran' => 'Transfer Bank',
            'status' => 'Lunas',
        ]);

        $this->get('/pendapatan');
        $transaction = Transaksi::where('kode_transaksi', $booking->kode_booking)->firstOrFail();

        $response = $this->put(route('pendapatan.update', $transaction), [
            'kode_transaksi' => $transaction->kode_transaksi,
            'nama_pelanggan' => $transaction->nama_pelanggan,
            'paket_wisata' => $transaction->paket_wisata,
            'metode_pembayaran' => 'QRIS',
            'total' => 1500000,
            'tanggal_transaksi' => now()->toDateString(),
            'status' => 'Lunas',
        ]);

        $response->assertRedirect('/pendapatan');
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'metode_pembayaran' => 'QRIS']);
    }
}
