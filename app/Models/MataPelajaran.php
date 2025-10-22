<?php
// app/Models/MataPelajaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $fillable = ['nama_mapel', 'kode_mapel', 'deskripsi'];

    // Relasi
    public function komponenNilai()
    {
        return $this->hasMany(KomponenNilai::class)->orderBy('urutan');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
