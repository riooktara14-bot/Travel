<?php

namespace Tests\Feature;

use App\Models\Promo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PromoTest extends TestCase
{
    use RefreshDatabase;

    public function test_promo_page_loads_with_crud_data(): void
    {
        $response = $this->get('/promo');

        $response->assertOk();
        $response->assertSee('Promo TravelGo');
        $response->assertSee('Kelola promo dan diskon perjalanan TravelGo');
    }

    public function test_active_promo_shows_active_status(): void
    {
        Promo::create([
            'nama_promo' => 'Promo Liburan',
            'kode_promo' => 'LIBURAN10',
            'deskripsi' => 'Diskon liburan',
            'tipe_diskon' => 'persen',
            'nilai_diskon' => 10,
            'minimal_transaksi' => 500000,
            'tanggal_mulai' => now()->subDay(),
            'tanggal_selesai' => now()->addDay(),
            'gambar' => 'https://example.com/promo.jpg',
            'status' => 'aktif',
        ]);

        $response = $this->get('/promo');

        $response->assertOk();
        $response->assertSee('Aktif');
        $this->assertTrue(Promo::first()->isAvailable());
    }
}
