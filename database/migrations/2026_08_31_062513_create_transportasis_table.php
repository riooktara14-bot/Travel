<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transportasis', function (Blueprint $table) {
            $table->id();

            $table->string('nama_transportasi');

            $table->enum('jenis_transportasi', [
                'Bus',
                'Travel',
                'Kereta',
                'Pesawat',
                'Kapal',
                'Mobil',
            ]);

            $table->string('rute');

            $table->decimal('harga', 15, 2)->default(0);

            $table->integer('kapasitas')->default(1);

            $table->string('gambar')->nullable();

            $table->text('deskripsi')->nullable();

            $table->enum('status', [
                'aktif',
                'nonaktif',
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transportasis');
    }
};
