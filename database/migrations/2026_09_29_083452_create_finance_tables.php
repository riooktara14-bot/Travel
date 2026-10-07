<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('roles')->updateOrInsert(['nama_peran' => 'Finance'], []);

        Schema::create('payments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('pelanggans')->nullOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('Pending')->index();
            $table->string('payment_proof')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('legacy_transaction_id')->nullable()->unique();
            $table->timestamps();
        });

        Schema::create('refunds', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->text('reason');
            $table->string('status')->default('Menunggu')->index();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('finance_activities', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->text('description');
            $table->string('reference_code')->nullable()->index();
            $table->timestamps();
        });

        $this->importLegacyTransactions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_activities');
        Schema::dropIfExists('refunds');
        Schema::dropIfExists('payments');
    }

    private function importLegacyTransactions(): void
    {
        if (Schema::hasTable('transaksi')) {
            DB::table('transaksi')->orderBy('id')->get()->each(function (object $transaction): void {
                $booking = DB::table('bookings')->where('kode_booking', $transaction->kode_transaksi)->first();
                $status = $this->mapLegacyStatus($transaction->status);

                DB::table('payments')->insert([
                    'booking_id' => $booking?->id,
                    'customer_id' => $booking?->pelanggan_id,
                    'amount' => $transaction->total,
                    'payment_method' => $transaction->metode_pembayaran,
                    'payment_status' => $status,
                    'verified_at' => in_array($status, ['Berhasil', 'Refund'], true) ? $transaction->tanggal_transaksi : null,
                    'notes' => 'Diimpor dari transaksi lama.',
                    'legacy_transaction_id' => $transaction->id,
                    'created_at' => $transaction->created_at ?? now(),
                    'updated_at' => $transaction->updated_at ?? now(),
                ]);
            });
        }

        DB::table('bookings')->orderBy('id')->get()->each(function (object $booking): void {
            if (DB::table('payments')->where('booking_id', $booking->id)->exists()) {
                return;
            }

            $status = $this->mapLegacyStatus($booking->status);

            DB::table('payments')->insert([
                'booking_id' => $booking->id,
                'customer_id' => $booking->pelanggan_id,
                'amount' => $booking->total_biaya,
                'payment_method' => $booking->metode_pembayaran,
                'payment_status' => $status,
                'verified_at' => in_array($status, ['Berhasil', 'Refund'], true) ? $booking->updated_at : null,
                'notes' => 'Pembayaran awal dari booking lama.',
                'created_at' => $booking->created_at ?? now(),
                'updated_at' => $booking->updated_at ?? now(),
            ]);
        });
    }

    private function mapLegacyStatus(string $status): string
    {
        return match (strtolower($status)) {
            'lunas', 'berhasil', 'success', 'completed' => 'Berhasil',
            'pending', 'menunggu', 'menunggu pembayaran' => 'Pending',
            'refund', 'refunded' => 'Refund',
            'dibatalkan', 'cancelled', 'canceled' => 'Dibatalkan',
            default => 'Gagal',
        };
    }
};
