<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'mata_pelajaran_id',
        'tahun_ajaran_id',
        'catatan',
        'nilai_komponen',
        'nilai_tugas',
        'nilai_mid',
        'nilai_uas',
        'hadir',
        'izin',
        'sakit',
        'alfa',
        'nilai_dongkrak',
        'catatan_dongkrak',
    ];

    protected $casts = [
        'catatan' => 'array',
        'nilai_komponen' => 'array',
        'nilai_dongkrak' => 'decimal:2',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Accessor
    public function getTotalCatatanAttribute()
    {
        return is_array($this->catatan) ? count($this->catatan) : 0;
    }

    public function getNilaiAkhirAttribute()
    {
        if (!$this->nilai_komponen || !is_array($this->nilai_komponen)) {
            return 0;
        }

        $totalNilai = 0;

        // Hitung dari komponen fleksibel (Total 100%)
        foreach ($this->nilai_komponen as $komponenId => $nilai) {
            $komponen = KomponenNilai::find($komponenId);
            if ($komponen) {
                $totalNilai += ($nilai * $komponen->bobot / 100);
            }
        }

        // BONUS: Tambah poin dari catatan (maksimal 10 poin)
        $bonusCatatan = min($this->total_catatan, 10);
        $totalNilai += $bonusCatatan;

        // PENGURANG: Kurangi alfa
        $penguranganAlfa = $this->alfa * 2;

        // Nilai akhir tidak boleh lebih dari 100 atau kurang dari 0
        return max(0, min(100, $totalNilai - $penguranganAlfa));
    }

    // Accessor untuk nilai yang akan ditampilkan (dongkrak jika ada, atau asli)
    public function getNilaiDisplayAttribute()
    {
        return $this->nilai_dongkrak ?? $this->nilai_akhir;
    }
}
