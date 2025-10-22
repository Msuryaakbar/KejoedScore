<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // PENTING: Pastikan nama tabel benar
    protected $table = 'kelas';

    // PENTING: Pastikan fillable benar
    protected $fillable = ['nama_kelas', 'tingkat'];

    // Disable timestamps jika tidak ada created_at/updated_at
    // public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}
