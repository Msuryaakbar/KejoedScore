@extends('layouts.app')

@section('title', 'Rekap Nilai ' . $kelas->nama_kelas)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📊 Rekap Nilai - {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('nilai.rekap.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
</div>

<!-- Info Card -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
        <div>
            <p class="text-gray-600 text-sm">Total Siswa</p>
            <p class="text-2xl font-bold text-blue-600">{{ $siswa->count() }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Rata-rata Kelas</p>
            @php
                $rataKelas = 0;
                $siswaWithNilai = $siswa->filter(fn($s) => $s->nilai);
                if ($siswaWithNilai->count() > 0) {
                    $rataKelas = $siswaWithNilai->avg(fn($s) => $s->nilai->nilai_akhir);
                }
            @endphp
            <p class="text-2xl font-bold text-green-600">{{ number_format($rataKelas, 2) }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nilai Tertinggi</p>
            @php
                $nilaiTertinggi = 0;
                if ($siswaWithNilai->count() > 0) {
                    $nilaiTertinggi = $siswaWithNilai->max(fn($s) => $s->nilai->nilai_akhir);
                }
            @endphp
            <p class="text-2xl font-bold text-purple-600">{{ number_format($nilaiTertinggi, 2) }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nilai Terendah</p>
            @php
                $nilaiTerendah = 0;
                if ($siswaWithNilai->count() > 0) {
                    $nilaiTerendah = $siswaWithNilai->min(fn($s) => $s->nilai->nilai_akhir);
                }
            @endphp
            <p class="text-2xl font-bold text-orange-600">{{ number_format($nilaiTerendah, 2) }}</p>
        </div>
        <div>
            <a href="{{ route('export.excel', $kelas->id) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                📥 Download Excel
            </a>
        </div>
    </div>
</div>

<!-- Tabel Rekap -->
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-center border border-gray-300">No</th>
                <th class="px-6 py-3 text-left border border-gray-300">Nama Siswa</th>
                <th class="px-4 py-3 text-center border border-gray-300">NIS</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-purple-50">Catatan</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-green-50">Tugas</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-orange-50">MID</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-pink-50">UAS</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-blue-50">Kehadiran</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-yellow-50">Nilai Akhir</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-indigo-50">Predikat</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($siswa as $index => $s)
            @php
                $nilai = $s->nilai;
                $nilaiAkhir = $nilai ? $nilai->nilai_akhir : 0;
                
                // Tentukan predikat dan warna
                if ($nilaiAkhir >= 90) {
                    $predikat = 'A';
                    $keterangan = 'Sangat Baik';
                    $colorClass = 'bg-green-100 text-green-800';
                    $catatan = '🌟 Luar biasa! Pertahankan!';
                } elseif ($nilaiAkhir >= 80) {
                    $predikat = 'B';
                    $keterangan = 'Baik';
                    $colorClass = 'bg-blue-100 text-blue-800';
                    $catatan = '👍 Bagus, tingkatkan lagi!';
                } elseif ($nilaiAkhir >= 70) {
                    $predikat = 'C';
                    $keterangan = 'Cukup';
                    $colorClass = 'bg-yellow-100 text-yellow-800';
                    $catatan = '⚠️ Perlu ditingkatkan';
                } elseif ($nilaiAkhir >= 60) {
                    $predikat = 'D';
                    $keterangan = 'Kurang';
                    $colorClass = 'bg-orange-100 text-orange-800';
                    $catatan = '📚 Harus lebih giat belajar';
                } else {
                    $predikat = 'E';
                    $keterangan = 'Sangat Kurang';
                    $colorClass = 'bg-red-100 text-red-800';
                    $catatan = '❗ Perlu perhatian khusus';
                }
            @endphp
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center border border-gray-300">{{ $index + 1 }}</td>
                <td class="px-6 py-3 border border-gray-300 font-semibold">{{ $s->nama }}</td>
                <td class="px-4 py-3 text-center border border-gray-300">{{ $s->nis }}</td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    <span class="font-semibold text-purple-600">{{ $nilai ? $nilai->total_catatan : 0 }}</span>
                </td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    {{ $nilai ? number_format($nilai->nilai_tugas, 1) : '-' }}
                </td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    {{ $nilai ? number_format($nilai->nilai_mid, 1) : '-' }}
                </td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    {{ $nilai ? number_format($nilai->nilai_uas, 1) : '-' }}
                </td>
                <td class="px-4 py-3 text-center border border-gray-300 text-xs">
                    @if($nilai)
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-green-600">✓ {{ $nilai->hadir }}</span>
                            <span class="text-blue-600">I: {{ $nilai->izin }}</span>
                            <span class="text-cyan-600">S: {{ $nilai->sakit }}</span>
                            @if($nilai->alfa > 0)
                            <span class="text-red-600 font-bold">A: {{ $nilai->alfa }}</span>
                            @endif
                        </div>
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    <span class="text-xl font-bold {{ $nilaiAkhir >= 75 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($nilaiAkhir, 2) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center border border-gray-300">
                    <div class="flex flex-col items-center gap-2">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $colorClass }}">
                            {{ $predikat }} - {{ $keterangan }}
                        </span>
                        <p class="text-xs text-gray-600">{{ $catatan }}</p>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                    Belum ada data siswa di kelas ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Legend -->
<div class="mt-6 bg-white rounded-lg shadow p-4">
    <h3 class="font-bold text-lg mb-3">📋 Keterangan Predikat:</h3>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-sm">
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-bold">A</span>
            <span>90-100 (Sangat Baik)</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-bold">B</span>
            <span>80-89 (Baik)</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-bold">C</span>
            <span>70-79 (Cukup)</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-800 font-bold">D</span>
            <span>60-69 (Kurang)</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 font-bold">E</span>
            <span>0-59 (Sangat Kurang)</span>
        </div>
    </div>
</div>
@endsection