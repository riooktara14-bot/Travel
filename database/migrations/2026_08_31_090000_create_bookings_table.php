<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->string('nama_pelanggan');
            $table->string('paket_wisata');
            $table->date('tanggal_berangkat');
            $table->integer('jumlah_peserta')->default(1);
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->string('status')->default('Menunggu Pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
