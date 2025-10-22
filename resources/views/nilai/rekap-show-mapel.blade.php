@extends('layouts.app')

@section('title', 'Rekap Nilai ' . $mapel->nama_mapel . ' - ' . $kelas->nama_kelas)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📊 Rekap Nilai - {{ $mapel->nama_mapel }} - {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('nilai.rekap.pilih-kelas', $mapel->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
    
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg ml-4">
        {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
</div>

<!-- Statistik Card -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
        <div>
            <p class="text-gray-600 text-sm">Total Siswa</p>
            <p class="text-3xl font-bold text-blue-600">{{ $siswa->count() }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Rata-rata Kelas</p>
            @php
                $rataKelas = $siswa->count() > 0 ? $siswa->avg('nilai_akhir') : 0;
            @endphp
            <p class="text-3xl font-bold text-green-600">{{ number_format($rataKelas, 2) }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nilai Tertinggi</p>
            @php
                $nilaiTertinggi = $siswa->count() > 0 ? $siswa->max('nilai_akhir') : 0;
            @endphp
            <p class="text-3xl font-bold text-purple-600">{{ number_format($nilaiTertinggi, 2) }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nilai Terendah</p>
            @php
                $nilaiTerendah = $siswa->count() > 0 ? $siswa->min('nilai_akhir') : 0;
            @endphp
            <p class="text-3xl font-bold text-orange-600">{{ number_format($nilaiTerendah, 2) }}</p>
        </div>
        <div>
            <a href="{{ route('export.excel', $kelas->id) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                📥 Download Excel
            </a>
        </div>
    </div>
</div>

<!-- Info Komponen -->
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
    <h3 class="font-bold text-blue-900 mb-2">📋 Komponen Penilaian:</h3>
    <div class="flex flex-wrap gap-2 mb-3">
        @foreach($mapel->komponenNilai as $komponen)
        <span class="px-3 py-1 bg-blue-200 text-blue-900 rounded-full text-sm font-semibold">
            {{ $komponen->nama_komponen }} ({{ $komponen->bobot }}%)
        </span>
        @endforeach
    </div>
    <div class="text-sm text-blue-800 bg-white rounded p-3">
        <p class="font-semibold mb-2">📌 Formula Perhitungan:</p>
        <ul class="list-disc list-inside ml-2 space-y-1">
            <li><span class="font-semibold">Nilai Komponen:</span> Total 100% (sesuai bobot di atas)</li>
            <li><span class="text-purple-700 font-semibold">Bonus Catatan:</span> +1 poin per paraf (maksimal +10 poin)</li>
            <li><span class="text-red-700 font-semibold">Pengurang Alfa:</span> -2 poin per kejadian</li>
            <li><span class="text-gray-700 font-semibold">Nilai Akhir:</span> (Nilai Komponen + Bonus Catatan - Pengurang Alfa), min 0 max 100</li>
        </ul>
    </div>
</div>

<!-- Tabel Rekap dengan Ranking -->
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-center border border-gray-300 bg-yellow-50">🏆 Rank</th>
                <th class="px-6 py-3 text-left border border-gray-300">Nama Siswa</th>
                <th class="px-4 py-3 text-center border border-gray-300">NIS</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-purple-50">Catatan<br><small class="text-xs">(Bonus)</small></th>
                
                @foreach($mapel->komponenNilai as $komponen)
                <th class="px-4 py-3 text-center border border-gray-300 bg-blue-50">
                    {{ $komponen->nama_komponen }}<br>
                    <small class="text-xs">({{ $komponen->bobot }}%)</small>
                </th>
                @endforeach
                
                <th class="px-4 py-3 text-center border border-gray-300 bg-green-50">Kehadiran</th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-yellow-100">
                    <div class="font-bold">Nilai Akhir</div>
                    <div class="text-xs font-normal">(Sudah + Bonus - Alfa)</div>
                </th>
                <th class="px-4 py-3 text-center border border-gray-300 bg-indigo-50">Predikat</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($siswa as $index => $s)
            @php
                $nilaiSiswa = $s->nilai_mapel;
                $nilaiAkhir = $s->nilai_akhir;
                $rank = $index + 1;
                
                // Tentukan predikat
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
                
                // Medal untuk top 3
                $medal = '';
                if ($rank == 1) $medal = '🥇';
                elseif ($rank == 2) $medal = '🥈';
                elseif ($rank == 3) $medal = '🥉';
            @endphp
            <tr class="hover:bg-gray-50 {{ $rank <= 3 ? 'bg-yellow-50' : '' }}">
                <td class="px-4 py-4 text-center border border-gray-300">
                    <span class="text-xl font-bold {{ $rank <= 3 ? 'text-yellow-600' : 'text-gray-600' }}">
                        {{ $medal }} {{ $rank }}
                    </span>
                </td>
                <td class="px-6 py-4 border border-gray-300">
                    <span class="font-semibold {{ $rank <= 3 ? 'text-blue-700' : '' }}">{{ $s->nama }}</span>
                </td>
                <td class="px-4 py-4 text-center border border-gray-300">{{ $s->nis }}</td>
                <td class="px-4 py-4 text-center border border-gray-300">
                    <div class="flex flex-col items-center">
                        <span class="font-bold text-purple-600 text-lg">{{ $nilaiSiswa ? $nilaiSiswa->total_catatan : 0 }}</span>
                        <span class="text-xs text-purple-600">paraf</span>
                        <span class="text-xs text-green-600 font-semibold">+{{ $nilaiSiswa ? min($nilaiSiswa->total_catatan, 10) : 0 }} poin</span>
                    </div>
                </td>
                
                @foreach($mapel->komponenNilai as $komponen)
                <td class="px-4 py-4 text-center border border-gray-300">
                    @php
                        $nilaiKomponen = ($nilaiSiswa && $nilaiSiswa->nilai_komponen) ? ($nilaiSiswa->nilai_komponen[$komponen->id] ?? '-') : '-';
                    @endphp
                    <span class="font-semibold">{{ is_numeric($nilaiKomponen) ? number_format($nilaiKomponen, 1) : $nilaiKomponen }}</span>
                </td>
                @endforeach
                
                <td class="px-4 py-4 text-center border border-gray-300 text-xs">
                    @if($nilaiSiswa)
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-green-600 font-semibold">✓ {{ $nilaiSiswa->hadir }}</span>
                            <div class="flex gap-2 text-xs">
                                <span class="text-blue-600">I:{{ $nilaiSiswa->izin }}</span>
                                <span class="text-cyan-600">S:{{ $nilaiSiswa->sakit }}</span>
                            </div>
                            @if($nilaiSiswa->alfa > 0)
                            <span class="text-red-600 font-bold bg-red-50 px-2 py-1 rounded">
                                A:{{ $nilaiSiswa->alfa }} (-{{ $nilaiSiswa->alfa * 2 }})
                            </span>
                            @endif
                        </div>
                    @else
                        -
                    @endif
                </td>
                
                <td class="px-4 py-4 text-center border border-gray-300">
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-2xl font-bold {{ $nilaiAkhir >= 75 ? 'text-green-600' : 'text-red-600' }}">
                            {{ number_format($nilaiAkhir, 2) }}
                        </span>
                        @if($nilaiSiswa && $nilaiSiswa->total_catatan > 0)
                        <span class="text-xs text-purple-600">
                            (Base: {{ number_format($nilaiAkhir - min($nilaiSiswa->total_catatan, 10) + ($nilaiSiswa->alfa * 2), 2) }})
                        </span>
                        @endif
                    </div>
                </td>
                
                <td class="px-4 py-4 text-center border border-gray-300">
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
                <td colspan="{{ 6 + $mapel->komponenNilai->count() }}" class="px-6 py-8 text-center text-gray-500">
                    Belum ada data nilai untuk mata pelajaran ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Legend -->
<div class="mt-6 bg-white rounded-lg shadow p-4">
    <h3 class="font-bold text-lg mb-3">📋 Keterangan:</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Predikat -->
        <div>
            <p class="font-semibold mb-2">Predikat Nilai:</p>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 rounded bg-green-100 text-green-800 font-bold">A</span>
                    <span>90-100 (Sangat Baik)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 font-bold">B</span>
                    <span>80-89 (Baik)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800 font-bold">C</span>
                    <span>70-79 (Cukup)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 rounded bg-orange-100 text-orange-800 font-bold">D</span>
                    <span>60-69 (Kurang)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 rounded bg-red-100 text-red-800 font-bold">E</span>
                    <span>0-59 (Sangat Kurang)</span>
                </div>
            </div>
        </div>
        
        <!-- Kehadiran & Formula -->
        <div>
            <p class="font-semibold mb-2">Kehadiran & Bonus:</p>
            <div class="text-sm space-y-1">
                <div>✓ = Hadir</div>
                <div>I = Izin (tidak mengurangi nilai)</div>
                <div>S = Sakit (tidak mengurangi nilai)</div>
                <div class="text-red-600 font-semibold">A = Alfa (Mengurangi 2 poin per kejadian)</div>
                <div class="text-purple-600 font-semibold mt-2">Catatan/Paraf = Bonus +1 poin (max +10)</div>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="mt-6 flex gap-3 justify-end">
    <a href="{{ route('nilai.show-mapel', [$mapel->id, $kelas->id]) }}" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-semibold">
        ✏️ Edit Nilai
    </a>
    <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded font-semibold">
        🖨️ Print
    </button>
</div>

<style>
@media print {
    aside, .no-print, button { display: none !important; }
    body { background: white; }
    table { page-break-inside: avoid; }
}
</style>
@endsection