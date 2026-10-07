<?php

namespace Tests\Feature;

use App\Models\DestinasiWisata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinasiWisataTest extends TestCase
{
    use RefreshDatabase;

    public function test_destinasi_wisata_page_loads(): void
    {
        $response = $this->get('/destinasi-wisata');

        $response->assertOk();
        $response->assertSee('Destinasi Wisata');
        $response->assertSee('Kelola destinasi wisata TravelGo');
    }

    public function test_public_destination_page_displays_active_database_records_with_details(): void
    {
        DestinasiWisata::create([
            'nama_destinasi' => 'Pantai Contoh',
            'lokasi' => 'Bali',
            'deskripsi' => 'Pantai dengan pemandangan matahari terbenam.',
            'harga' => 150000,
            'durasi' => 2,
            'gambar' => 'https://example.com/pantai.jpg',
            'status' => 'aktif',
        ]);
        DestinasiWisata::create([
            'nama_destinasi' => 'Destinasi Tidak Aktif',
            'lokasi' => 'Jawa Barat',
            'deskripsi' => 'Tidak ditampilkan di katalog publik.',
            'harga' => 90000,
            'durasi' => 1,
            'status' => 'nonaktif',
        ]);

        $response = $this->get('/destination');

        $response->assertOk()
            ->assertSee('Pantai Contoh')
            ->assertSee('Bali')
            ->assertSee('https://example.com/pantai.jpg')
            ->assertSee('Pantai dengan pemandangan matahari terbenam.')
            ->assertSee('Rp150.000')
            ->assertSee('Durasi perjalanan 2 hari')
            ->assertDontSee('Destinasi Tidak Aktif');
    }

    public function test_public_destination_page_can_filter_by_search_and_location(): void
    {
        DestinasiWisata::create([
            'nama_destinasi' => 'Pantai Contoh',
            'lokasi' => 'Bali',
            'harga' => 150000,
            'durasi' => 2,
            'status' => 'aktif',
        ]);
        DestinasiWisata::create([
            'nama_destinasi' => 'Gunung Contoh',
            'lokasi' => 'Jawa Barat',
            'harga' => 120000,
            'durasi' => 3,
            'status' => 'aktif',
        ]);

        $response = $this->get('/destination?q=Pantai&lokasi=Bali');

        $response->assertOk()
            ->assertSee('Pantai Contoh')
            ->assertDontSee('Gunung Contoh');
    }
}
