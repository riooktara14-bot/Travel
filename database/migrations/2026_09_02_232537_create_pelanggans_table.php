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
        Schema::table('pelanggans', function (Blueprint $table) {
            if (! Schema::hasColumn('pelanggans', 'nama_pelanggan')) {
                $table->string('nama_pelanggan')->after('id');
            }
            if (! Schema::hasColumn('pelanggans', 'email')) {
                $table->string('email')->unique()->after('nama_pelanggan');
            }
            if (! Schema::hasColumn('pelanggans', 'no_hp')) {
                $table->string('no_hp')->after('email');
            }
            if (! Schema::hasColumn('pelanggans', 'alamat')) {
                $table->string('alamat')->after('no_hp');
            }
            if (! Schema::hasColumn('pelanggans', 'status')) {
                $table->string('status')->default('Member')->after('alamat');
            }
            if (! Schema::hasColumn('pelanggans', 'total_booking')) {
                $table->integer('total_booking')->default(0)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn([
                'nama_pelanggan',
                'email',
                'no_hp',
                'alamat',
                'status',
                'total_booking',
            ]);
        });
    }
};
