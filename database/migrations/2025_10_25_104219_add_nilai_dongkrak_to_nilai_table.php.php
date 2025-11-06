<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Nilai dongkrak untuk keperluan dinas - tambahkan di akhir tabel
            $table->decimal('nilai_dongkrak', 5, 2)->nullable();
            $table->text('catatan_dongkrak')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropColumn(['nilai_dongkrak', 'catatan_dongkrak']);
        });
    }
};
