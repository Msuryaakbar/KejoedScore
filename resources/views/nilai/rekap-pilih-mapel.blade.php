@extends('layouts.app')

@section('title', 'Rekap Nilai - Pilih Mata Pelajaran')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Rekap Nilai & Ranking</h1>
                <p class="text-gray-600">Pilih mata pelajaran untuk melihat rekap nilai dan peringkat siswa</p>
            </div>
            @if($tahunAjaranAktif)
            <div class="flex items-center gap-2 bg-green-50 px-4 py-3 rounded-lg border border-green-200">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="font-semibold text-green-700">{{ $tahunAjaranAktif->nama_lengkap }}</span>
            </div>
            @endif
        </div>
    </div>

    @if(!$mataPelajaran || $mataPelajaran->isEmpty())
        <!-- Empty State -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-yellow-800 mb-3">Belum Ada Mata Pelajaran</h3>
            <p class="text-yellow-700 mb-6">Silakan tambahkan mata pelajaran terlebih dahulu untuk dapat melihat rekap nilai.</p>
            <a href="{{ route('mata-pelajaran.index') }}" 
               class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Kelola Mata Pelajaran
            </a>
        </div>
    @else
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <div class="text-2xl font-bold text-purple-600 mb-2">{{ $mataPelajaran->count() }}</div>
                <div class="text-sm text-gray-600">Total Mapel</div>
            </div>
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <div class="text-2xl font-bold text-green-600 mb-2">
                    {{ $mataPelajaran->sum(fn($m) => $m->komponenNilai->count()) }}
                </div>
                <div class="text-sm text-gray-600">Komponen Nilai</div>
            </div>
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                @php
                    $mapelSiap = $mataPelajaran->filter(fn($m) => $m->komponenNilai->sum('bobot') == 100)->count();
                @endphp
                <div class="text-2xl font-bold text-blue-600 mb-2">{{ $mapelSiap }}</div>
                <div class="text-sm text-gray-600">Mapel Siap</div>
            </div>
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                @php
                    $mapelBelumSiap = $mataPelajaran->count() - $mapelSiap;
                @endphp
                <div class="text-2xl font-bold text-orange-600 mb-2">{{ $mapelBelumSiap }}</div>
                <div class="text-sm text-gray-600">Perlu Konfigurasi</div>
            </div>
        </div>

        <!-- Grid Mata Pelajaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mataPelajaran as $mapel)
            <a href="{{ route('nilai.rekap.pilih-kelas', $mapel->id) }}" 
               class="block bg-white rounded-xl shadow border p-6 hover:shadow-lg hover:border-purple-300 transition-all">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $mapel->nama_mapel }}</h3>
                        <p class="text-gray-600 text-sm">{{ $mapel->kode_mapel }}</p>
                    </div>
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Komponen Nilai -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                        <span>Komponen Nilai:</span>
                        <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $mapel->komponenNilai->count() }} item
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-1">
                        @foreach($mapel->komponenNilai->take(2) as $komponen)
                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                            {{ $komponen->nama_komponen }}
                        </span>
                        @endforeach
                        @if($mapel->komponenNilai->count() > 2)
                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                            +{{ $mapel->komponenNilai->count() - 2 }} lagi
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Total Bobot -->
                <div class="flex items-center justify-between mb-4 text-sm">
                    <span class="text-gray-600">Total Bobot:</span>
                    @php
                        $totalBobot = $mapel->komponenNilai->sum('bobot');
                    @endphp
                    <span class="font-semibold {{ $totalBobot == 100 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $totalBobot }}%
                    </span>
                </div>

                <!-- CTA -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-600 font-medium">Lihat Rekap</span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Info Section -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-blue-900 mb-2">Fitur Rekap Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 font-bold text-sm">📊</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Analisis Data</div>
                                <div class="text-gray-600 text-xs">Lihat performa siswa secara keseluruhan</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 font-bold text-sm">🏆</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Sistem Ranking</div>
                                <div class="text-gray-600 text-xs">Urutan peringkat siswa otomatis</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">📈</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Predikat Otomatis</div>
                                <div class="text-gray-600 text-xs">Klasifikasi A, B, C, D berdasarkan nilai</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection