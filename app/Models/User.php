<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Check role methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    public function isOrtu(): bool
    {
        return $this->role === 'ortu';
    }

    // Relationships
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function nilaiAsGuru()
    {
        return $this->hasMany(Nilai::class, 'guru_id');
    }

    // Relasi many-to-many dengan mata pelajaran (untuk guru)
    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajaran', 'guru_id', 'mata_pelajaran_id')
            ->withTimestamps();
    }
}
