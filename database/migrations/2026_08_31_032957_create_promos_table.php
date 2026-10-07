<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();

            $table->string('nama_promo');
            $table->string('kode_promo')->unique();

            $table->text('deskripsi')->nullable();

            $table->enum('tipe_diskon', [
                'persen',
                'nominal',
            ])->default('persen');

            $table->decimal('nilai_diskon', 15, 2)->default(0);

            $table->decimal('minimal_transaksi', 15, 2)->default(0);

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->string('gambar')->nullable();

            $table->enum('status', [
                'aktif',
                'nonaktif',
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
