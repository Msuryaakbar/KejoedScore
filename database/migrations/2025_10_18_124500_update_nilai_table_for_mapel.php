// database/migrations/xxxx_update_nilai_table_for_mapel.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Tambah kolom baru
            $table->foreignId('mata_pelajaran_id')->nullable()->after('siswa_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->nullable()->after('mata_pelajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');

            // Catatan tetap ada
            // nilai_tugas, nilai_mid, nilai_uas bisa jadi fleksibel atau hapus

            // Tambah kolom untuk komponen nilai fleksibel
            $table->json('nilai_komponen')->nullable()->after('catatan'); // {"komponen_id": nilai}
        });
    }

    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['mata_pelajaran_id']);
            $table->dropForeign(['tahun_ajaran_id']);
            $table->dropColumn(['mata_pelajaran_id', 'tahun_ajaran_id', 'nilai_komponen']);
        });
    }
};
