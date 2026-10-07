<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransportasiTest extends TestCase
{
    use RefreshDatabase;

    public function test_transportasi_page_loads(): void
    {
        $response = $this->get('/transportasi');

        $response->assertOk();
        $response->assertSee('Transportasi');
        $response->assertSee('Kelola transportasi TravelGo');
        $response->assertSee('name="jenis_transportasi"', false);
        $response->assertDontSee('name="jenis"', false);
    }

    public function test_transportasi_can_be_created_with_rute_and_kapasitas(): void
    {
        $response = $this->post('/transportasi', [
            'nama_transportasi' => 'Travel Bali Express',
            'jenis_transportasi' => 'Travel',
            'rute' => 'Jakarta - Bali',
            'deskripsi' => 'Transportasi nyaman untuk liburan',
            'harga' => 500000,
            'kapasitas' => 12,
            'gambar' => 'https://example.com/bus.jpg',
            'status' => 'aktif',
        ]);

        $response->assertRedirect('/transportasi');
        $this->assertDatabaseHas('transportasis', [
            'nama_transportasi' => 'Travel Bali Express',
            'rute' => 'Jakarta - Bali',
            'kapasitas' => 12,
        ]);
    }
}
