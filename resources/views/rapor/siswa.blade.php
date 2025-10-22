@extends('layouts.app')

@section('title', 'Rapor ' . $siswa->nama)

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-3xl font-bold">📄 Rapor Siswa</h2>
            <p class="text-gray-600 mt-2">{{ $siswa->nama }} - {{ $siswa->kelas->nama_kelas }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('rapor.kelas', $siswa->kelas_id) }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                ← Kembali
            </a>
            <a href="{{ route('rapor.print', $siswa->id) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                🖨️ Print/PDF
            </a>
        </div>
    </div>
</div>

<!-- Info Siswa -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <p class="text-sm text-gray-600">Nama Lengkap</p>
            <p class="font-bold text-lg">{{ $siswa->nama }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">NIS</p>
            <p class="font-bold text-lg">{{ $siswa->nis }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Kelas</p>
            <p class="font-bold text-lg">{{ $siswa->kelas->nama_kelas }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Tahun Ajaran</p>
            <p class="font-bold text-lg">{{ $tahunAjaranAktif->nama_lengkap }}</p>
        </div>
    </div>
</div>

<!-- Ringkasan Nilai -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg shadow p-6">
        <p class="text-sm opacity-90">Jumlah Mata Pelajaran</p>
        <p class="text-4xl font-bold mt-2">{{ $jumlahMapel }}</p>
    </div>
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow p-6">
        <p class="text-sm opacity-90">Rata-rata Keseluruhan</p>
        <p class="text-4xl font-bold mt-2">{{ number_format($rataRata, 2) }}</p>
    </div>
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow p-6">
        <p class="text-sm opacity-90">Ranking di Kelas</p>
        <p class="text-4xl font-bold mt-2">{{ $ranking ?? '-' }}</p>
    </div>
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow p-6">
        <p class="text-sm opacity-90">Predikat Rata-rata</p>
        @php
            if ($rataRata >= 90) $pred = 'A';
            elseif ($rataRata >= 80) $pred = 'B';
            elseif ($rataRata >= 70) $pred = 'C';
            elseif ($rataRata >= 60) $pred = 'D';
            else $pred = 'E';
        @endphp
        <p class="text-4xl font-bold mt-2">{{ $pred }}</p>
    </div>
</div>

<!-- Tabel Nilai Per Mapel -->
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-left border">No</th>
                <th class="px-6 py-3 text-left border">Mata Pelajaran</th>
                <th class="px-4 py-3 text-center border bg-purple-50">Catatan</th>
                <th class="px-4 py-3 text-center border bg-blue-50">Komponen Nilai</th>
                <th class="px-4 py-3 text-center border bg-green-50">Kehadiran</th>
                <th class="px-4 py-3 text-center border bg-yellow-50">Nilai Akhir</th>
                <th class="px-4 py-3 text-center border bg-indigo-50">Predikat</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($nilaiPerMapel as $data)
            @php
                $nilai = $data['nilai'];
                $mapel = $data['mapel'];
                $nilaiAkhir = $data['nilai_akhir'];
                
                if ($nilaiAkhir >= 90) {
                    $predikat = 'A';
                    $colorClass = 'bg-green-100 text-green-800';
                } elseif ($nilaiAkhir >= 80) {
                    $predikat = 'B';
                    $colorClass = 'bg-blue-100 text-blue-800';
                } elseif ($nilaiAkhir >= 70) {
                    $predikat = 'C';
                    $colorClass = 'bg-yellow-100 text-yellow-800';
                } elseif ($nilaiAkhir >= 60) {
                    $predikat = 'D';
                    $colorClass = 'bg-orange-100 text-orange-800';
                } else {
                    $predikat = 'E';
                    $colorClass = 'bg-red-100 text-red-800';
                }
            @endphp
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center border">{{ $loop->iteration }}</td>
                <td class="px-6 py-3 border">
                    <div class="font-semibold">{{ $mapel->nama_mapel }}</div>
                    <div class="text-xs text-gray-500">{{ $mapel->kode_mapel }}</div>
                </td>
                <td class="px-4 py-3 text-center border">
                    <div class="font-bold text-purple-600">{{ $nilai->total_catatan }}</div>
                    <div class="text-xs text-green-600">+{{ min($nilai->total_catatan, 10) }}</div>
                </td>
                <td class="px-4 py-3 border">
                    <div class="space-y-1 text-xs">
                        @if($nilai->nilai_komponen)
                            @foreach($mapel->komponenNilai as $komp)
                                @if(isset($nilai->nilai_komponen[$komp->id]))
                                <div class="flex justify-between">
                                    <span>{{ $komp->nama_komponen }}:</span>
                                    <span class="font-semibold">{{ number_format($nilai->nilai_komponen[$komp->id], 1) }}</span>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </td>
                <td class="px-4 py-3 text-center border text-xs">
                    <div>✓ {{ $nilai->hadir }}</div>
                    <div>I: {{ $nilai->izin }} | S: {{ $nilai->sakit }}</div>
                    @if($nilai->alfa > 0)
                    <div class="text-red-600 font-bold">A: {{ $nilai->alfa }} (-{{ $nilai->alfa * 2 }})</div>
                    @endif
                </td>
                <td class="px-4 py-3 text-center border">
                    <div class="text-2xl font-bold {{ $nilaiAkhir >= 75 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($nilaiAkhir, 2) }}
                    </div>
                </td>
                <td class="px-4 py-3 text-center border">
                    <span class="px-3 py-1 rounded-full font-bold {{ $colorClass }}">
                        {{ $predikat }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    Belum ada nilai untuk siswa ini
                </td>
            </tr>
            @endforelse
            
            @if(count($nilaiPerMapel) > 0)
            <tr class="bg-blue-50 font-bold">
                <td colspan="5" class="px-6 py-4 text-right border">RATA-RATA KESELURUHAN:</td>
                <td class="px-4 py-4 text-center border">
                    <span class="text-2xl text-blue-600">{{ number_format($rataRata, 2) }}</span>
                </td>
                <td class="px-4 py-4 text-center border">
                    <span class="px-3 py-1 rounded-full font-bold {{ $rataRata >= 75 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $pred }}
                    </span>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection