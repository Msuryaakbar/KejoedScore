<?php
// app/Models/KomponenNilai.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenNilai extends Model
{
    use HasFactory;

    protected $table = 'komponen_nilai';
    protected $fillable = ['mata_pelajaran_id', 'nama_komponen', 'bobot', 'urutan'];

    // Relasi
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
