<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('tour_guides')) {
            return;
        }

        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->decimal('harga_per_hari', 15, 2)->default(0);
            $table->decimal('rating', 3, 1)->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['tersedia', 'bertugas', 'cuti'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guides');
    }
};
