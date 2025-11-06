@extends('layouts.app')

@section('title', 'Rekap Nilai ' . $mapel->nama_mapel . ' - ' . $kelas->nama_kelas)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('nilai.rekap.pilih-kelas', $mapel->id) }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pilih Kelas
            </a>
        </div>
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Rekap Nilai & Ranking</h1>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-lg border border-purple-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-semibold text-purple-700">{{ $mapel->nama_mapel }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg border border-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="font-semibold text-blue-700">{{ $kelas->nama_kelas }}</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-600 text-white px-6 py-4 rounded-xl">
                    <div class="text-2xl font-bold">{{ $siswa->count() }}</div>
                    <div class="text-blue-100 text-sm">Total Siswa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600 mb-2">{{ $siswa->count() }}</div>
                <div class="text-sm text-gray-600">Total Siswa</div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="text-center">
                @php
                    $rataKelas = $siswa->count() > 0 ? $siswa->avg('nilai_akhir') : 0;
                @endphp
                <div class="text-2xl font-bold text-green-600 mb-2">{{ number_format($rataKelas, 1) }}</div>
                <div class="text-sm text-gray-600">Rata-rata Kelas</div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="text-center">
                @php
                    $nilaiTertinggi = $siswa->count() > 0 ? $siswa->max('nilai_akhir') : 0;
                @endphp
                <div class="text-2xl font-bold text-purple-600 mb-2">{{ number_format($nilaiTertinggi, 1) }}</div>
                <div class="text-sm text-gray-600">Nilai Tertinggi</div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="text-center">
                @php
                    $nilaiTerendah = $siswa->count() > 0 ? $siswa->min('nilai_akhir') : 0;
                @endphp
                <div class="text-2xl font-bold text-orange-600 mb-2">{{ number_format($nilaiTerendah, 1) }}</div>
                <div class="text-sm text-gray-600">Nilai Terendah</div>
            </div>
        </div>
    </div>

    <!-- Komponen Info -->
    <div class="bg-white rounded-xl shadow border p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Komponen Penilaian</h3>
                <div class="flex flex-wrap gap-3 mb-4">
                    @foreach($mapel->komponenNilai as $komponen)
                    <div class="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-lg border border-blue-200">
                        <span class="font-medium text-blue-800">{{ $komponen->nama_komponen }}</span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-bold">
                            {{ $komponen->bobot }}%
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('export.excel', $kelas->id) }}" 
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Download Excel
        </a>
        <a href="{{ route('nilai.show-mapel', [$mapel->id, $kelas->id]) }}" 
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Nilai
        </a>
        <button onclick="window.print()" 
                class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Print
        </button>
    </div>

    <!-- Tabel Rekap -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Data Ranking & Nilai Siswa</h3>
                <div class="text-sm text-gray-600">
                    <span class="font-semibold">{{ $siswa->count() }}</span> siswa
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 border-b border-r bg-white sticky left-0 min-w-[60px]">
                            Rank
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 border-b border-r bg-white sticky left-[60px] min-w-[200px]">
                            Nama Siswa
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 border-b border-r min-w-[100px]">
                            NIS
                        </th>
                        
                        <!-- Komponen Nilai -->
                        @foreach($mapel->komponenNilai as $komponen)
                        <th class="px-3 py-3 text-center font-semibold text-blue-700 border-b border-r bg-blue-50 min-w-[100px]">
                            <div>{{ $komponen->nama_komponen }}</div>
                            <div class="text-xs text-blue-600">{{ $komponen->bobot }}%</div>
                        </th>
                        @endforeach
                        
                        <!-- Nilai Akhir -->
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 border-b border-r bg-green-50">
                            Nilai Akhir
                        </th>
                        
                        <!-- Predikat -->
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 border-b bg-purple-50">
                            Predikat
                        </th>
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
                        <!-- Rank -->
                        <td class="px-4 py-3 text-center border-r bg-white sticky left-0 font-medium text-gray-700">
                            {{ $rank }}
                        </td>
                        
                        <!-- Nama Siswa -->
                        <td class="px-4 py-3 border-r bg-white sticky left-[60px] font-medium text-gray-900">
                            {{ $s->nama }}
                        </td>
                        
                        <!-- NIS -->
                        <td class="px-4 py-3 text-center border-r text-gray-600">
                            {{ $s->nis }}
                        </td>
                        
                        <!-- Komponen Nilai -->
                        @foreach($mapel->komponenNilai as $komponen)
                        <td class="px-3 py-3 text-center border-r bg-blue-50">
                            @php
                                $nilaiKomponen = ($nilaiSiswa && $nilaiSiswa->nilai_komponen) ? ($nilaiSiswa->nilai_komponen[$komponen->id] ?? '-') : '-';
                            @endphp
                            <span class="font-medium text-gray-700">
                                {{ is_numeric($nilaiKomponen) ? number_format($nilaiKomponen, 1) : $nilaiKomponen }}
                            </span>
                        </td>
                        @endforeach
                        
                        <!-- Nilai Akhir -->
                        <td class="px-4 py-3 text-center border-r bg-green-50">
                            <span class="text-lg font-bold {{ $nilaiAkhir >= 75 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($nilaiAkhir, 1) }}
                            </span>
                        </td>
                        
                        <!-- Predikat -->
                        <td class="px-4 py-3 text-center bg-purple-50">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $colorClass }}">
                                {{ $predikat }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 4 + $mapel->komponenNilai->count() }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="font-semibold text-lg">Belum ada data nilai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Legend -->
    <div class="mt-6 bg-white rounded-xl shadow border p-6">
        <h3 class="font-bold text-lg mb-4 text-gray-900">Keterangan Predikat</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            <div class="flex items-center gap-2 p-2 bg-green-50 rounded-lg">
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-bold">A</span>
                <span class="text-sm text-green-800">90-100</span>
            </div>
            <div class="flex items-center gap-2 p-2 bg-blue-50 rounded-lg">
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm font-bold">B</span>
                <span class="text-sm text-blue-800">80-89</span>
            </div>
            <div class="flex items-center gap-2 p-2 bg-yellow-50 rounded-lg">
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-bold">C</span>
                <span class="text-sm text-yellow-800">70-79</span>
            </div>
            <div class="flex items-center gap-2 p-2 bg-orange-50 rounded-lg">
                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm font-bold">D</span>
                <span class="text-sm text-orange-800">60-69</span>
            </div>
            <div class="flex items-center gap-2 p-2 bg-red-50 rounded-lg">
                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-bold">E</span>
                <span class="text-sm text-red-800">0-59</span>
            </div>
        </div>
    </div>
</div>

<style>
.sticky {
    position: sticky;
    background: inherit;
}

.overflow-x-auto {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}
</style>
@endsection