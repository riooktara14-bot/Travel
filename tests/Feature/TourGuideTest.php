<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourGuideTest extends TestCase
{
    use RefreshDatabase;

    public function test_tourguide_page_loads(): void
    {
        $response = $this->get('/tourguide');

        $response->assertOk();
        $response->assertSee('Tour Guide');
        $response->assertSee('Kelola data tour guide TravelGo');
    }
}
