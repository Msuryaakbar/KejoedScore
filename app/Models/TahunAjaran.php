<?php
// app/Models/TahunAjaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $fillable = ['tahun', 'semester', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    // Helper
    public function getNamaLengkapAttribute()
    {
        return $this->tahun . ' - Semester ' . $this->semester;
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
