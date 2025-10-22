// database/migrations/xxxx_create_tahun_ajaran_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('tahun'); // 2024/2025
            $table->enum('semester', ['1', '2']);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            
            $table->unique(['tahun', 'semester']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahun_ajaran');
    }
};