<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $kelasId;

    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    public function collection()
    {
        return Siswa::where('kelas_id', $this->kelasId)
            ->with(['kelas', 'nilai'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIS',
            'Kelas',
            'Total Catatan',
            'Nilai Tugas',
            'Nilai Mid',
            'Nilai UAS',
            'Hadir',
            'Izin',
            'Sakit',
            'Alfa',
            'Nilai Akhir'
        ];
    }

    public function map($siswa): array
    {
        $nilai = $siswa->nilai;

        return [
            $siswa->nama,
            $siswa->nis,
            $siswa->kelas->nama_kelas,
            $nilai ? $nilai->total_catatan : 0,
            $nilai ? $nilai->nilai_tugas : 0,
            $nilai ? $nilai->nilai_mid : 0,
            $nilai ? $nilai->nilai_uas : 0,
            $nilai ? $nilai->hadir : 0,
            $nilai ? $nilai->izin : 0,
            $nilai ? $nilai->sakit : 0,
            $nilai ? $nilai->alfa : 0,
            $nilai ? number_format($nilai->nilai_akhir, 2) : 0,
        ];
    }
}
