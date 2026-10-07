<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotel_page_loads(): void
    {
        $response = $this->get('/hotel');

        $response->assertOk();
        $response->assertSee('Hotel');
        $response->assertSee('Kelola data hotel TravelGo');
    }
}
