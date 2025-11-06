@extends('layouts.app')

@section('title', 'Rekap ' . $mapel->nama_mapel)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('nilai.rekap.index') }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pilih Mapel
            </a>
        </div>
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Rekap Nilai Siswa</h1>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-lg border border-purple-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-semibold text-purple-700">{{ $mapel->nama_mapel }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-semibold text-green-700">{{ $tahunAjaranAktif->nama_lengkap }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 text-gray-500 bg-blue-50 px-4 py-3 rounded-lg border border-blue-200">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="text-sm">Pilih kelas untuk melihat rekap nilai</span>
            </div>
        </div>
    </div>

    @if(!$kelas || $kelas->isEmpty())
        <!-- Empty State -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-yellow-800 mb-3">Belum Ada Data Kelas</h3>
            <p class="text-yellow-700 mb-6">Tidak ada kelas yang tersedia untuk mata pelajaran ini.</p>
            <a href="{{ route('kelas.index') }}" 
               class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Kelola Kelas
            </a>
        </div>
    @else
        <!-- Stats -->
        <div class="bg-white rounded-xl shadow border p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Kelas Tersedia</h3>
                        <p class="text-gray-600 text-sm">Total {{ $kelas->count() }} kelas dengan data rekap nilai</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-purple-600">{{ $kelas->count() }}</div>
                    <div class="text-sm text-gray-500">Kelas</div>
                </div>
            </div>
        </div>

        <!-- Grid Kelas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($kelas as $k)
                @if($k && isset($k->id) && isset($k->nama_kelas))
                <a href="{{ route('nilai.rekap.show-mapel', [$mapel->id, $k->id]) }}" 
                   class="block bg-white rounded-xl shadow border p-6 hover:shadow-lg hover:border-purple-300 transition-all">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $k->nama_kelas }}</h3>
                            <p class="text-gray-600 text-sm">Kelas {{ $k->tingkat ?? '-' }}</p>
                        </div>
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-purple-600">{{ $k->siswa_count ?? 0 }}</div>
                            <div class="text-xs text-gray-500">Siswa</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-green-600">{{ $k->mapel_count ?? 0 }}</div>
                            <div class="text-xs text-gray-500">Mapel</div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Tersedia
                        </span>
                    </div>
                </a>
                @endif
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
                    <h3 class="font-semibold text-blue-900 mb-3">Fitur Rekap Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 font-bold text-sm">📊</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Rekap Lengkap</div>
                                <div class="text-gray-600 text-xs">Lihat nilai semua siswa</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 font-bold text-sm">🏆</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Predikat Nilai</div>
                                <div class="text-gray-600 text-xs">Klasifikasi A, B, C, D</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">📈</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Analisis Data</div>
                                <div class="text-gray-600 text-xs">Performa belajar siswa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection