<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();

            $table->string('nama_hotel');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();

            $table->decimal('harga_per_malam', 15, 2)->default(0);

            $table->decimal('rating', 2, 1)->default(0);

            $table->string('gambar')->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
