<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ModuleCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_and_create_work(): void
    {
        $response = $this->get('/booking');
        $response->assertOk();

        $create = $this->post('/booking', [
            'kode_booking' => 'BK-2001',
            'nama_pelanggan' => 'Dewi Ayu',
            'paket_wisata' => 'Bali Sunset',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 3200000,
            'status' => 'Menunggu Pembayaran',
        ]);

        $create->assertRedirect('/booking');
        $this->assertDatabaseHas('bookings', [
            'kode_booking' => 'BK-2001',
            'nama_pelanggan' => 'Dewi Ayu',
        ]);
    }

    public function test_pelanggan_page_and_create_work(): void
    {
        $response = $this->get('/datapelanggan');
        $response->assertOk();

        $create = $this->post('/datapelanggan', [
            'nama_pelanggan' => 'Roni',
            'email' => 'roni@example.com',
            'no_hp' => '081234567890',
            'alamat' => 'Yogyakarta',
            'status' => 'Member',
            'total_booking' => 3,
        ]);

        $create->assertRedirect('/datapelanggan');
        $this->assertDatabaseHas('pelanggans', [
            'email' => 'roni@example.com',
            'nama_pelanggan' => 'Roni',
        ]);
    }

    public function test_booking_can_be_updated(): void
    {
        $booking = Booking::create([
            'kode_booking' => 'BK-UPDATE',
            'nama_pelanggan' => 'Lama',
            'paket_wisata' => 'Bali Lama',
            'tanggal_berangkat' => now()->toDateString(),
            'jumlah_peserta' => 1,
            'total_biaya' => 1000000,
            'status' => 'Menunggu Pembayaran',
        ]);

        $response = $this->put(route('booking.update', $booking), [
            'kode_booking' => 'BK-UPDATE',
            'nama_pelanggan' => 'Baru',
            'paket_wisata' => 'Bali Baru',
            'tanggal_berangkat' => now()->addDay()->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2000000,
            'status' => 'Lunas',
        ]);

        $response->assertRedirect('/booking');
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'Lunas', 'jumlah_peserta' => 2]);
    }

    public function test_pelanggan_can_be_updated(): void
    {
        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => 'Nama Lama',
            'email' => 'lama@example.com',
            'no_hp' => '0800000000',
            'alamat' => 'Alamat Lama',
            'status' => 'Member',
            'total_booking' => 0,
        ]);

        $response = $this->put(route('datapelanggan.update', $pelanggan), [
            'nama_pelanggan' => 'Nama Baru',
            'email' => 'baru@example.com',
            'no_hp' => '0811111111',
            'alamat' => 'Alamat Baru',
            'status' => 'Non Member',
            'total_booking' => 1,
        ]);

        $response->assertRedirect('/datapelanggan');
        $this->assertDatabaseHas('pelanggans', ['id' => $pelanggan->id, 'nama_pelanggan' => 'Nama Baru', 'email' => 'baru@example.com']);
    }

    public function test_admin_page_and_create_work(): void
    {
        $this->actingAs(User::factory()->create([
            'role' => 'super admin',
            'status' => 'aktif',
        ]));

        $response = $this->get('/kelolaadmin');
        $response->assertOk()
            ->assertSee('Admin')
            ->assertSee('Kelola Admin')
            ->assertSee(route('kelolaadmin'));

        $create = $this->post('/kelolaadmin', [
            'name' => 'Admin Baru',
            'email' => 'adminbaru@example.com',
            'password' => 'secret123',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $create->assertRedirect('/kelolaadmin');
        $this->assertDatabaseHas('users', [
            'email' => 'adminbaru@example.com',
            'role' => 'admin',
        ]);
    }

    public function test_owner_can_view_admin_pages_but_cannot_mutate_data(): void
    {
        $owner = User::factory()->create([
            'role' => 'owner',
            'status' => 'aktif',
        ]);

        $this->actingAs($owner);

        foreach ([
            '/admin',
            '/booking',
            '/datapelanggan',
            '/pendapatan',
            '/profiladmin',
            '/kelolaadmin',
            '/pengaturanweb',
            '/destinasi-wisata',
            '/hotel',
            '/transportasi',
            '/tourguide',
            '/promo',
        ] as $path) {
            $this->get($path)->assertOk();
        }

        $this->get('/profiladmin')
            ->assertOk()
            ->assertSee($owner->name)
            ->assertSee(route('profiladmin'))
            ->assertSee(route('logout'));

        $this->get('/kelolaadmin')
            ->assertOk()
            ->assertSee(route('kelolaadmin'))
            ->assertSee($owner->email)
            ->assertSee('owner-readonly')
            ->assertDontSee('Tambah Admin')
            ->assertDontSee('Hapus')
            ->assertDontSee('Edit');

        $this->get('/pengaturanweb')
            ->assertOk()
            ->assertSee('owner-settings-form')
            ->assertSee('TravelGo');

        $this->post('/booking', [])->assertForbidden();
        $this->put('/profiladmin', [
            'name' => 'Nama Owner Berubah',
            'email' => $owner->email,
        ])->assertForbidden();
        $this->delete('/kelolaadmin/'.$owner->id)->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $owner->id, 'name' => $owner->name]);
    }

    public function test_owner_can_logout(): void
    {
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'aktif']);

        $response = $this->actingAs($owner)->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_admin_profile_can_be_viewed_and_updated(): void
    {
        $admin = User::factory()->create([
            'email' => 'profile@example.com',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $this->actingAs($admin)
            ->get('/profiladmin')
            ->assertOk()
            ->assertSee($admin->name);

        $response = $this->actingAs($admin)
            ->put('/profiladmin', [
                'name' => 'Admin Profil Baru',
                'email' => 'profilbaru@example.com',
                'password' => 'secret123',
                'password_confirmation' => 'secret123',
            ]);

        $response->assertRedirect('/profiladmin');
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'name' => 'Admin Profil Baru', 'email' => 'profilbaru@example.com']);
        $this->assertTrue(Hash::check('secret123', User::find($admin->id)->password));
    }

    public function test_admin_can_upload_profile_photo(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($admin)->put('/profiladmin', [
            'name' => $admin->name,
            'email' => $admin->email,
            'profile_photo' => UploadedFile::fake()->image('profile.jpg'),
        ]);

        $response->assertRedirect('/profiladmin');
        $admin->refresh();
        $this->assertNotNull($admin->profile_photo_path);
        Storage::disk('public')->assertExists($admin->profile_photo_path);
    }
}
