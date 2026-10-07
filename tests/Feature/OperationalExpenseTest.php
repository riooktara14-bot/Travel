<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\OperationalExpense;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperationalExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_can_create_update_and_delete_an_operational_expense(): void
    {
        $finance = User::factory()->create(['role' => 'finance', 'status' => 'aktif']);
        $this->actingAs($finance);

        $response = $this->post(route('finance.laporan-keuangan.pengeluaran.store'), [
            'category' => 'Transportasi',
            'description' => 'Bahan bakar armada',
            'expense_date' => today()->toDateString(),
            'status' => 'Dibayar',
            'amount' => 1250000,
        ]);

        $response->assertRedirect(route('finance.laporankeuangan'));
        $expense = OperationalExpense::firstOrFail();
        $this->assertDatabaseHas('operational_expenses', [
            'id' => $expense->id,
            'category' => 'Transportasi',
            'amount' => 1250000,
        ]);

        $this->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Bahan bakar armada')
            ->assertSee('Rp1.250.000')
            ->assertSee('EXP-'.str_pad((string) $expense->id, 5, '0', STR_PAD_LEFT));

        $this->put(route('finance.laporan-keuangan.pengeluaran.update', $expense), [
            'category' => 'Operasional Kantor',
            'description' => 'Internet dan listrik',
            'expense_date' => today()->toDateString(),
            'status' => 'Pending',
            'amount' => 1500000,
        ])->assertRedirect(route('finance.laporankeuangan'));

        $this->assertDatabaseHas('operational_expenses', [
            'id' => $expense->id,
            'category' => 'Operasional Kantor',
            'description' => 'Internet dan listrik',
            'status' => 'Pending',
            'amount' => 1500000,
        ]);

        $this->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Rp1.500.000')
            ->assertSee('Internet dan listrik');

        $this->delete(route('finance.laporan-keuangan.pengeluaran.destroy', $expense))
            ->assertRedirect(route('finance.laporankeuangan'));

        $this->assertDatabaseMissing('operational_expenses', ['id' => $expense->id]);
        $this->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Belum ada data pengeluaran.')
            ->assertSee('Rp0');
    }

    public function test_only_finance_can_manage_expenses_and_owner_can_only_view_report(): void
    {
        $expense = OperationalExpense::create([
            'category' => 'Gaji Karyawan',
            'description' => 'Gaji bulanan',
            'expense_date' => today()->toDateString(),
            'status' => 'Dibayar',
            'amount' => 6500000,
        ]);

        $owner = User::factory()->create(['role' => 'owner', 'status' => 'aktif']);
        $this->actingAs($owner)
            ->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Gaji bulanan')
            ->assertDontSee(route('finance.laporan-keuangan.pengeluaran.store'));

        $this->post(route('finance.laporan-keuangan.pengeluaran.store'), [
            'category' => 'Transportasi',
            'description' => 'Bahan bakar',
            'expense_date' => today()->toDateString(),
            'status' => 'Dibayar',
            'amount' => 500000,
        ])->assertForbidden();

        $this->put(route('finance.laporan-keuangan.pengeluaran.update', $expense), [
            'category' => 'Gaji Karyawan',
            'description' => 'Perubahan tidak diizinkan',
            'expense_date' => today()->toDateString(),
            'status' => 'Dibayar',
            'amount' => 6500000,
        ])->assertForbidden();

        $this->delete(route('finance.laporan-keuangan.pengeluaran.destroy', $expense))
            ->assertForbidden();

        $this->assertDatabaseHas('operational_expenses', [
            'id' => $expense->id,
            'description' => 'Gaji bulanan',
        ]);
    }

    public function test_invalid_expense_data_is_rejected_without_creating_a_record(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']))
            ->from(route('finance.laporankeuangan'))
            ->post(route('finance.laporan-keuangan.pengeluaran.store'), [
                'category' => '',
                'description' => 'Data tidak valid',
                'expense_date' => today()->toDateString(),
                'status' => 'Tidak diketahui',
                'amount' => 0,
            ])
            ->assertRedirect(route('finance.laporankeuangan'))
            ->assertSessionHasErrors(['category', 'status', 'amount']);

        $this->assertDatabaseCount('operational_expenses', 0);
    }

    public function test_financial_report_transaction_counts_match_payment_records(): void
    {
        $this->createTransaction('TRX-COUNT-PAID', 500000, 'Lunas');
        $this->createTransaction('TRX-COUNT-PENDING', 300000, 'Pending');
        $this->createTransaction('TRX-COUNT-FAILED', 200000, 'Dibatalkan');

        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']))
            ->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Total Transaksi')
            ->assertSee('3')
            ->assertSee('1 transaksi berhasil')
            ->assertSee('Rp500.000');
    }

    public function test_financial_report_income_matches_the_income_page_transactions(): void
    {
        $this->createTransaction('TRX-PAID', 2000000, 'Lunas', 'QRIS', 'Bali');
        $this->createTransaction('TRX-REFUNDED', 1000000, 'Dibatalkan', 'Transfer Bank', 'Lombok');
        $this->createTransaction('TRX-PENDING', 9000000, 'Pending', 'QRIS', 'Labuan Bajo');

        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']));

        $incomeResponse = $this->get(route('pendapatan'));
        $incomeResponse->assertOk()->assertSee('Rp2.000.000');

        $reportResponse = $this->get(route('finance.laporankeuangan'));
        $reportResponse->assertOk()
            ->assertSee('Rp2.000.000')
            ->assertSee('Bali')
            ->assertDontSee('QRIS')
            ->assertDontSee('Rp2.700.000');

        $this->assertSame(
            $incomeResponse->viewData('totalPendapatan'),
            $reportResponse->viewData('totalIncome'),
        );
    }

    public function test_financial_report_syncs_paid_bookings_the_same_way_as_income_page(): void
    {
        Booking::create([
            'kode_booking' => 'BK-INCOME-SYNC',
            'nama_pelanggan' => 'Pelanggan Tes',
            'paket_wisata' => 'Paket Tes',
            'tanggal_berangkat' => today(),
            'jumlah_peserta' => 2,
            'total_biaya' => 1250000,
            'status' => 'Lunas',
        ]);

        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']));
        $incomeResponse = $this->get(route('pendapatan'));
        $reportResponse = $this->get(route('finance.laporankeuangan'));

        $this->assertSame(
            $incomeResponse->viewData('totalPendapatan'),
            $reportResponse->viewData('totalIncome'),
        );
        $reportResponse->assertSee('Rp1.250.000');
    }

    public function test_financial_report_groups_income_by_destination_not_payment_method(): void
    {
        $this->createTransaction('TRX-BALI-1', 1200000, 'Lunas', 'QRIS', 'Bali');
        $this->createTransaction('TRX-BALI-2', 800000, 'Selesai', 'Transfer Bank', 'Bali');
        $this->createTransaction('TRX-LOMBOK', 500000, 'Lunas', 'QRIS', 'Lombok');

        $this->actingAs(User::factory()->create(['role' => 'finance', 'status' => 'aktif']))
            ->get(route('finance.laporankeuangan'))
            ->assertOk()
            ->assertSee('Pendapatan berdasarkan destinasi wisata')
            ->assertSee('Bali')
            ->assertSee('Lombok')
            ->assertSee('Rp2.000.000')
            ->assertSee('Rp500.000')
            ->assertDontSee('QRIS')
            ->assertDontSee('Transfer Bank');
    }

    private function createTransaction(
        string $code,
        int $amount,
        string $status,
        string $method = 'QRIS',
        string $destination = 'Paket Tes',
    ): Transaksi {
        return Transaksi::create([
            'kode_transaksi' => $code,
            'nama_pelanggan' => 'Pelanggan Tes',
            'paket_wisata' => $destination,
            'metode_pembayaran' => $method,
            'total' => $amount,
            'tanggal_transaksi' => today(),
            'status' => $status,
        ]);
    }
}
