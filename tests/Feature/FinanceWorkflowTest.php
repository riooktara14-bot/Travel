<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\DestinasiWisata;
use App\Models\FinanceActivity;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\Role;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FinanceWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_can_access_booking_pendapatan_refund_and_profile_routes_only(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $this->actingAs($finance);

        foreach (['/booking', '/pendapatan', '/finance/laporan-keuangan'] as $uri) {
            $this->get($uri)->assertOk();
        }

        $this->get('/laporankeuangan')->assertRedirect(route('finance.laporankeuangan'));

        foreach ([
            '/admin',
            '/datapelanggan',
            '/destinasi-wisata',
            '/kelolaadmin',
            '/pengaturanweb',
            '/transportasi',
            '/finance',
            '/finance/dashboard',
            '/finance/pembayaran',
            '/finance/pendapatan',
            '/finance/laporan',
            '/finance/riwayat',
        ] as $uri) {
            $this->get($uri)->assertForbidden();
        }

        $this->get('/finance/refund')->assertOk();
        $this->get('/profiladmin')->assertOk();
        $this->get('/finance/profil')->assertOk();
    }

    public function test_finance_sidebar_shows_refund_link(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);

        $this->actingAs($finance)
            ->get(route('booking'))
            ->assertOk()
            ->assertSee('Booking')
            ->assertSee(route('booking'))
            ->assertSee('Pendapatan')
            ->assertSee('Laporan Keuangan')
            ->assertSee(route('finance.laporankeuangan'))
            ->assertSee('Refund')
            ->assertSee(route('finance.refund'))
            ->assertSee('Profil Saya')
            ->assertDontSee('Data Pembayaran')
            ->assertDontSee('Riwayat Transaksi')
            ->assertDontSee('Kelola Admin');
    }

    public function test_user_with_finance_role_relation_sees_booking_menu_after_login(): void
    {
        $financeRole = Role::firstOrCreate(['nama_peran' => 'Finance']);
        $finance = User::factory()->create([
            'role' => 'admin',
            'role_id' => $financeRole->id,
            'status' => 'aktif',
            'password' => 'finance-secret',
        ]);

        $this->post(route('login.attempt'), [
            'email' => $finance->email,
            'password' => 'finance-secret',
        ])->assertRedirect(route('booking'));

        $this->get(route('booking'))
            ->assertOk()
            ->assertSee('Booking')
            ->assertSee(route('booking'))
            ->assertSee('<span class="menu-title">Booking</span>', false);
    }

    public function test_only_finance_and_owner_can_view_financial_report(): void
    {
        $owner = User::factory()->create(['role' => 'owner', 'status' => 'aktif']);

        $this->actingAs($owner)
            ->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Laporan Keuangan')
            ->assertSee('Rp42.850.000');

        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $this->actingAs($admin)
            ->get(route('finance.laporankeuangan'))
            ->assertForbidden();

        $this->get(route('booking'))
            ->assertOk()
            ->assertDontSee(route('finance.laporankeuangan'));
    }

    public function test_admin_keeps_access_to_finance_features(): void
    {
        $this->get(route('finance.dashboard'))->assertOk();
        $this->get(route('finance.pembayaran'))->assertOk();
        $this->get(route('finance.refund'))->assertForbidden();
        $this->get(route('refund'))->assertForbidden();
    }

    public function test_admin_can_verify_pending_payment_and_cannot_reverify_final_payment(): void
    {
        $finance = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $booking = Booking::create([
            'kode_booking' => 'BK-FIN-100',
            'nama_pelanggan' => 'Pelanggan Finance',
            'paket_wisata' => 'Bali',
            'tanggal_berangkat' => now()->addDays(10)->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2000000,
            'status' => 'Menunggu Pembayaran',
        ]);
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => 2000000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Pending',
        ]);

        $this->actingAs($finance)->put(route('finance.pembayaran.verify', $payment), [
            'status' => 'Berhasil',
            'notes' => 'Bukti sudah diperiksa',
        ])->assertRedirect(route('finance.pembayaran.show', $payment));

        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'payment_status' => 'Berhasil', 'verified_by' => $finance->id]);
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'Lunas']);
        $this->assertDatabaseHas('transaksi', ['kode_transaksi' => 'BK-FIN-100', 'total' => 2000000]);
        $this->assertDatabaseHas('finance_activities', ['payment_id' => $payment->id, 'user_id' => $finance->id]);

        $this->put(route('finance.pembayaran.verify', $payment), ['status' => 'Gagal'])->assertStatus(422);
    }

    public function test_finance_can_approve_refund_and_cancel_related_transaction(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $booking = Booking::create([
            'kode_booking' => 'BK-REFUND-100',
            'nama_pelanggan' => 'Pelanggan Refund',
            'paket_wisata' => 'Bali',
            'tanggal_berangkat' => now()->addDays(10)->toDateString(),
            'jumlah_peserta' => 1,
            'total_biaya' => 1000000,
            'status' => 'Lunas',
        ]);
        $transaction = Transaksi::create([
            'kode_transaksi' => 'BK-REFUND-100',
            'nama_pelanggan' => 'Pelanggan Refund',
            'paket_wisata' => 'Bali',
            'metode_pembayaran' => 'Transfer Bank',
            'total' => 1000000,
            'tanggal_transaksi' => today(),
            'status' => 'Lunas',
        ]);
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'legacy_transaction_id' => $transaction->id,
            'amount' => 1000000,
            'payment_method' => 'Transfer Bank',
            'payment_status' => 'Berhasil',
        ]);

        $this->actingAs($finance)->post(route('finance.refund.store'), [
            'payment_id' => $payment->id,
            'amount' => 500000,
            'reason' => 'Pembatalan layanan',
        ])->assertRedirect(route('finance.refund'));

        $refund = Refund::firstOrFail();
        $this->put(route('finance.refund.update', $refund), ['status' => 'Diproses'])->assertRedirect(route('finance.refund'));
        $this->put(route('finance.refund.update', $refund), ['status' => 'Disetujui'])->assertRedirect(route('finance.refund'));

        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'payment_status' => 'Refund']);
        $this->assertDatabaseHas('refunds', ['id' => $refund->id, 'status' => 'Disetujui', 'processed_by' => $finance->id]);
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'Dibatalkan']);
        $this->assertDatabaseHas('transaksi', ['id' => $transaction->id, 'status' => 'Dibatalkan']);
        $this->assertGreaterThanOrEqual(3, FinanceActivity::where('payment_id', $payment->id)->count());
    }

    public function test_rejected_refund_keeps_original_booking_and_transaction_active(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $booking = Booking::create([
            'kode_booking' => 'BK-REFUND-REJECTED',
            'nama_pelanggan' => 'Pelanggan Refund',
            'paket_wisata' => 'Bali',
            'tanggal_berangkat' => now()->addDays(10)->toDateString(),
            'jumlah_peserta' => 1,
            'total_biaya' => 500000,
            'status' => 'Lunas',
        ]);
        $transaction = Transaksi::create([
            'kode_transaksi' => 'BK-REFUND-REJECTED',
            'nama_pelanggan' => 'Pelanggan Refund',
            'paket_wisata' => 'Bali',
            'metode_pembayaran' => 'QRIS',
            'total' => 500000,
            'tanggal_transaksi' => today(),
            'status' => 'Lunas',
        ]);
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'legacy_transaction_id' => $transaction->id,
            'amount' => 500000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);
        $refund = Refund::create([
            'payment_id' => $payment->id,
            'amount' => 200000,
            'reason' => 'Pembatalan layanan',
        ]);

        $this->actingAs($finance)
            ->put(route('finance.refund.update', $refund), ['status' => 'Diproses'])
            ->assertRedirect(route('finance.refund'));
        $this->put(route('finance.refund.update', $refund), ['status' => 'Ditolak'])
            ->assertRedirect(route('finance.refund'));

        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'payment_status' => 'Berhasil']);
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'Lunas']);
        $this->assertDatabaseHas('transaksi', ['id' => $transaction->id, 'status' => 'Lunas']);
    }

    public function test_refund_page_lists_filters_and_processes_refund_requests(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']));

        $payment = Payment::create([
            'amount' => 750000,
            'payment_method' => 'Transfer Bank',
            'payment_status' => 'Berhasil',
        ]);
        $refund = Refund::create([
            'payment_id' => $payment->id,
            'amount' => 250000,
            'reason' => 'Pembatalan pemesanan',
            'status' => 'Menunggu',
        ]);
        Refund::create([
            'payment_id' => $payment->id,
            'amount' => 100000,
            'reason' => 'Pengajuan lain',
            'status' => 'Berhasil',
        ]);
        $availablePayment = Payment::create([
            'amount' => 300000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);

        $this->get(route('finance.refund'))
            ->assertOk()
            ->assertSee('Pembatalan pemesanan')
            ->assertSee('Pengajuan lain')
            ->assertSee('Rp250.000')
            ->assertSee(route('finance.refund.update', $refund))
            ->assertSee('Pilih transaksi riwayat')
            ->assertSee('Lanjutkan proses refund')
            ->assertSee('Pembayaran #'.$availablePayment->id)
            ->assertSee(route('finance.refund.request.update', $refund))
            ->assertSee(route('finance.refund.destroy', $refund))
            ->assertSee('Hapus')
            ->assertSee('Proses');

        $this->get(route('finance.refund', ['status' => 'Menunggu']))
            ->assertOk()
            ->assertSee('Pembatalan pemesanan')
            ->assertDontSee('Pengajuan lain');

        $this->put(route('finance.refund.update', $refund), [
            'status' => 'Diproses',
            'notes' => 'Sedang ditinjau',
        ])->assertRedirect(route('finance.refund'));
        $this->put(route('finance.refund.update', $refund), [
            'status' => 'Disetujui',
            'notes' => 'Dana sudah dikembalikan',
        ])->assertRedirect(route('finance.refund'));

        $this->assertDatabaseHas('refunds', [
            'id' => $refund->id,
            'status' => 'Disetujui',
            'notes' => 'Dana sudah dikembalikan',
        ]);
        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'payment_status' => 'Refund']);

        $this->get(route('finance.refund', ['status' => 'invalid']))->assertStatus(422);
    }

    public function test_finance_layout_assets_use_root_relative_urls_on_nested_pages(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']));

        $this->get(route('finance.refund'))
            ->assertOk()
            ->assertSee('href="'.asset('assets/css/style.css').'"', false)
            ->assertSee('href="'.asset('assets/vendors/mdi/css/materialdesignicons.min.css').'"', false)
            ->assertSee('src="'.asset('assets/js/template.js').'"', false);
    }

    public function test_only_finance_can_open_or_process_refunds(): void
    {
        $payment = Payment::create([
            'amount' => 500000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);
        $refund = Refund::create([
            'payment_id' => $payment->id,
            'amount' => 100000,
            'reason' => 'Pembatalan',
        ]);

        foreach (['admin', 'owner', 'super admin'] as $role) {
            $user = User::factory()->create(['role' => $role, 'status' => 'aktif']);

            $this->actingAs($user)
                ->get(route('finance.refund'))
                ->assertForbidden();
            $this->get(route('refund'))->assertForbidden();
            $this->post(route('finance.refund.store'), [
                'payment_id' => $payment->id,
                'amount' => 100000,
                'reason' => 'Pembatalan',
            ])->assertForbidden();
            $this->put(route('finance.refund.update', $refund), ['status' => 'Diproses'])->assertForbidden();
            $this->put(route('finance.refund.request.update', $refund), [
                'amount' => 100000,
                'reason' => 'Perubahan',
            ])->assertForbidden();
            $this->delete(route('finance.refund.destroy', $refund))->assertForbidden();
        }

        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']))
            ->get(route('refund'))
            ->assertRedirect(route('finance.refund'));
    }

    public function test_admin_report_exports_csv_and_pending_is_not_income(): void
    {
        $finance = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        Payment::create(['amount' => 1500000, 'payment_method' => 'QRIS', 'payment_status' => 'Berhasil', 'verified_at' => now()]);
        Payment::create(['amount' => 900000, 'payment_method' => 'QRIS', 'payment_status' => 'Pending']);

        $this->actingAs($finance)->get(route('finance.pendapatan'))->assertOk()->assertSee('Rp1.500.000');
        $this->get(route('finance.laporan', ['export' => 'csv']))->assertOk()->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_admin_payment_date_filter_uses_verification_date_for_completed_payments(): void
    {
        $finance = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $payment = Payment::create([
            'amount' => 1500000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
            'verified_at' => today()->setTime(12, 0),
            'created_at' => today()->subDays(5),
            'updated_at' => today()->setTime(12, 0),
        ]);

        $this->actingAs($finance)
            ->get(route('finance.pembayaran', ['from' => today()->toDateString(), 'to' => today()->toDateString()]))
            ->assertOk()
            ->assertSee('PAY-'.$payment->id);
    }

    public function test_super_admin_can_create_a_finance_account_that_can_log_in(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super admin', 'status' => 'aktif']);

        $this->actingAs($superAdmin)->post(route('kelolaadmin.store'), [
            'name' => 'Finance TravelGo',
            'email' => 'finance@travelgo.test',
            'password' => 'finance-secret',
            'role' => 'finance',
            'status' => 'aktif',
        ])->assertRedirect(route('kelolaadmin'));

        $finance = User::where('email', 'finance@travelgo.test')->firstOrFail();
        $this->assertTrue(Hash::check('finance-secret', $finance->password));
        $this->post(route('logout'));
        $this->post(route('login.attempt'), [
            'email' => 'finance@travelgo.test',
            'password' => 'finance-secret',
        ])->assertRedirect(route('booking'));

        $this->get(route('booking'))->assertOk();
        $this->get(route('admin'))->assertForbidden();
    }

    public function test_public_booking_creates_a_pending_payment_at_the_destination_price(): void
    {
        DestinasiWisata::create([
            'nama_destinasi' => 'Pulau Contoh',
            'lokasi' => 'Indonesia',
            'harga' => 125000,
            'durasi' => 2,
            'status' => 'aktif',
        ]);

        $this->get(route('booking1'))
            ->assertOk()
            ->assertSee('Pulau Contoh')
            ->assertSee('name="nama"', false)
            ->assertSee('name="jumlah_orang"', false)
            ->assertSee('name="tanggal_berangkat"', false);

        $response = $this->post(route('booking1.store'), [
            'nama' => 'Pelanggan Contoh',
            'email' => 'customer@example.test',
            'telepon' => '08123456789',
            'jumlah_orang' => 2,
            'destinasi' => 'Pulau Contoh',
            'metode_pembayaran' => 'Transfer Bank',
            'tanggal_berangkat' => now()->addDays(30)->toDateString(),
        ]);
        $response->assertRedirect(route('booking1'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('bookings', [
            'paket_wisata' => 'Pulau Contoh',
            'nama_pelanggan' => 'Pelanggan Contoh',
            'jumlah_peserta' => 2,
            'total_biaya' => 250000,
            'status' => 'Menunggu Pembayaran',
        ]);
        $this->assertDatabaseHas('pelanggans', [
            'email' => 'customer@example.test',
            'nama_pelanggan' => 'Pelanggan Contoh',
            'no_hp' => '08123456789',
            'total_booking' => 1,
        ]);
        $this->assertDatabaseHas('payments', [
            'amount' => 250000,
            'payment_method' => 'Transfer Bank',
            'payment_status' => 'Pending',
        ]);
        $this->assertDatabaseHas('finance_activities', ['action' => 'payment_created']);

        $this->actingAs(User::factory()->create(['role' => 'admin', 'status' => 'aktif']))
            ->get(route('booking'))
            ->assertOk()
            ->assertSee('Pelanggan Contoh')
            ->assertSee('Pulau Contoh');
    }

    public function test_public_booking_rejects_inactive_destinations(): void
    {
        DestinasiWisata::create([
            'nama_destinasi' => 'Destinasi Tutup',
            'lokasi' => 'Indonesia',
            'harga' => 125000,
            'durasi' => 2,
            'status' => 'nonaktif',
        ]);

        $this->get(route('booking1'))
            ->assertOk()
            ->assertDontSee('Destinasi Tutup');

        $this->from(route('booking1'))
            ->post(route('booking1.store'), [
                'nama' => 'Pelanggan Contoh',
                'email' => 'customer@example.test',
                'telepon' => '08123456789',
                'jumlah_orang' => 2,
                'destinasi' => 'Destinasi Tutup',
                'tanggal_berangkat' => now()->addDays(30)->toDateString(),
            ])
            ->assertSessionHasErrors('destinasi');

        $this->assertDatabaseCount('bookings', 0);
    }

    public function test_editing_a_booking_updates_only_its_pending_finance_payment(): void
    {
        $booking = Booking::create([
            'kode_booking' => 'BK-FIN-EDIT',
            'nama_pelanggan' => 'Pelanggan Finance',
            'paket_wisata' => 'Bali',
            'tanggal_berangkat' => now()->addDays(10)->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2000000,
            'metode_pembayaran' => 'QRIS',
            'status' => 'Menunggu Pembayaran',
        ]);
        $pendingPayment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => 2000000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Pending',
        ]);
        $verifiedPayment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => 2000000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);

        $this->put(route('booking.update', $booking->id), [
            'kode_booking' => 'BK-FIN-EDIT',
            'nama_pelanggan' => 'Pelanggan Finance',
            'paket_wisata' => 'Bali',
            'tanggal_berangkat' => now()->addDays(10)->toDateString(),
            'jumlah_peserta' => 2,
            'total_biaya' => 2500000,
            'metode_pembayaran' => 'Transfer Bank',
            'status' => 'Menunggu Pembayaran',
        ])->assertRedirect(route('booking'));

        $this->assertDatabaseHas('payments', [
            'id' => $pendingPayment->id,
            'amount' => 2500000,
            'payment_method' => 'Transfer Bank',
        ]);
        $this->assertDatabaseHas('payments', [
            'id' => $verifiedPayment->id,
            'amount' => 2000000,
            'payment_status' => 'Berhasil',
        ]);
        $this->assertDatabaseHas('finance_activities', [
            'payment_id' => $pendingPayment->id,
            'action' => 'payment_updated',
        ]);
    }

    public function test_refund_requests_cannot_exceed_75_percent_of_payment_total(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $payment = Payment::create([
            'amount' => 1000000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);

        $this->actingAs($finance)->post(route('finance.refund.store'), [
            'payment_id' => $payment->id,
            'amount' => 750001,
            'reason' => 'Pembatalan layanan',
        ])->assertRedirect(route('finance.refund'))
            ->assertSessionHas('warning', 'Total refund tidak boleh melebihi 75% dari total pembayaran.');
        $this->assertDatabaseCount('refunds', 0);
        $this->get(route('finance.refund'))
            ->assertOk()
            ->assertSee('Total refund tidak boleh melebihi 75% dari total pembayaran.');

        $this->post(route('finance.refund.store'), [
            'payment_id' => $payment->id,
            'amount' => 750000,
            'reason' => 'Pembatalan layanan',
        ])->assertRedirect(route('finance.refund'));

        $this->assertDatabaseCount('refunds', 1);

        $this->post(route('finance.refund.store'), [
            'payment_id' => $payment->id,
            'amount' => 0.01,
            'reason' => 'Pengajuan refund tambahan',
        ])->assertRedirect(route('finance.refund'))
            ->assertSessionHas('warning', 'Total refund tidak boleh melebihi 75% dari total pembayaran.');
        $this->assertDatabaseCount('refunds', 1);
    }

    public function test_pending_and_processing_refund_requests_can_be_edited_and_deleted(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $payment = Payment::create([
            'amount' => 1000000,
            'payment_method' => 'QRIS',
            'payment_status' => 'Berhasil',
        ]);
        $refund = Refund::create([
            'payment_id' => $payment->id,
            'amount' => 500000,
            'reason' => 'Alasan awal',
            'status' => 'Menunggu',
        ]);

        $this->actingAs($finance)->put(route('finance.refund.request.update', $refund), [
            'amount' => 750001,
            'reason' => 'Alasan melewati batas',
        ])->assertRedirect(route('finance.refund'))
            ->assertSessionHas('warning', 'Total refund tidak boleh melebihi 75% dari total pembayaran.');
        $this->assertDatabaseHas('refunds', [
            'id' => $refund->id,
            'amount' => 500000,
            'reason' => 'Alasan awal',
        ]);

        $this->put(route('finance.refund.request.update', $refund), [
            'amount' => 700000,
            'reason' => 'Alasan diperbarui',
        ])->assertRedirect(route('finance.refund'));

        $this->assertDatabaseHas('refunds', [
            'id' => $refund->id,
            'amount' => 700000,
            'reason' => 'Alasan diperbarui',
            'status' => 'Menunggu',
        ]);
        $this->assertDatabaseHas('finance_activities', [
            'payment_id' => $payment->id,
            'action' => 'refund_updated',
        ]);

        $this->put(route('finance.refund.update', $refund), ['status' => 'Diproses'])
            ->assertRedirect(route('finance.refund'));
        $this->put(route('finance.refund.request.update', $refund), [
            'amount' => 750000,
            'reason' => 'Sudah diproses',
        ])->assertRedirect(route('finance.refund'));

        $this->delete(route('finance.refund.destroy', $refund))
            ->assertRedirect(route('finance.refund'));
        $this->assertDatabaseMissing('refunds', ['id' => $refund->id]);
        $this->assertDatabaseHas('finance_activities', [
            'payment_id' => $payment->id,
            'action' => 'refund_deleted',
        ]);

        $finalRefund = Refund::create([
            'payment_id' => $payment->id,
            'amount' => 750000,
            'reason' => 'Final',
            'status' => 'Disetujui',
        ]);
        $this->put(route('finance.refund.request.update', $finalRefund), [
            'amount' => 500000,
            'reason' => 'Tidak dapat diubah',
        ])->assertStatus(422);
        $this->delete(route('finance.refund.destroy', $finalRefund))->assertStatus(422);
    }

    public function test_finance_can_update_all_admin_profile_fields(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        Storage::fake('public');

        $this->actingAs($finance)
            ->get(route('profiladmin'))
            ->assertOk()
            ->assertSee('Profil Finance')
            ->assertSee(route('finance.profil.update'));

        $this->put(route('finance.profil.update'), [
            'name' => 'Finance Baru',
            'email' => 'finance-baru@example.test',
            'password' => 'new-finance-secret',
            'password_confirmation' => 'new-finance-secret',
            'profile_photo' => UploadedFile::fake()->image('finance-profile.png'),
        ])->assertRedirect(route('finance.profil'));

        $finance->refresh();
        $this->assertDatabaseHas('users', [
            'id' => $finance->id,
            'name' => 'Finance Baru',
            'email' => 'finance-baru@example.test',
        ]);
        $this->assertTrue(Hash::check('new-finance-secret', $finance->password));
        $this->assertNotEmpty($finance->profile_photo_path);
        Storage::disk('public')->assertExists($finance->profile_photo_path);
    }
}
