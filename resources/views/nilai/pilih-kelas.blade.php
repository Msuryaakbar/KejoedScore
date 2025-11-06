@extends('layouts.app')

@section('title', 'Pilih Kelas - ' . $mapel->nama_mapel)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('nilai.index') }}" 
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pilih Mapel
            </a>
        </div>
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Input Nilai</h1>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg border border-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-semibold text-blue-700">{{ $mapel->nama_mapel }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-semibold text-gray-700">{{ $tahunAjaranAktif->nama_lengkap }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Komponen Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Komponen Penilaian</h3>
                <div class="flex flex-wrap gap-3 mb-3">
                    @foreach($mapel->komponenNilai as $komponen)
                    <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg border border-blue-200 shadow-sm">
                        <span class="font-medium text-gray-700">{{ $komponen->nama_komponen }}</span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-bold">
                            {{ $komponen->bobot }}%
                        </span>
                    </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-600">
                    Total Bobot: <span class="font-bold text-blue-600">{{ $mapel->komponenNilai->sum('bobot') }}%</span>
                </p>
            </div>
        </div>
    </div>

    @if($kelas->isEmpty())
        <!-- Empty State -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">Belum Ada Kelas Tersedia</h3>
            <p class="text-gray-600 mb-6">Silakan tambahkan kelas terlebih dahulu untuk dapat menginput nilai.</p>
            <a href="{{ route('kelas.index') }}" 
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Kelola Kelas
            </a>
        </div>
    @else
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-2">{{ $kelas->count() }}</div>
                <div class="text-sm text-gray-600">Total Kelas</div>
            </div>
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-2">{{ $kelas->sum('siswa_count') ?? 0 }}</div>
                <div class="text-sm text-gray-600">Total Siswa</div>
            </div>
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-2">{{ $mapel->komponenNilai->count() }}</div>
                <div class="text-sm text-gray-600">Komponen Nilai</div>
            </div>
        </div>

        <!-- Grid Kelas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelas as $k)
            <a href="{{ route('nilai.show-mapel', [$mapel->id, $k->id]) }}" 
               class="group block bg-white rounded-xl shadow border p-6 hover:shadow-lg hover:border-blue-300 transition-all">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $k->nama_kelas }}</h3>
                        <p class="text-gray-600 text-sm">Kelas {{ $k->tingkat }}</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $k->siswa_count ?? 0 }} Siswa</span>
                    </div>
                    <div class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                        Aktif
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Progress Input</span>
                        <span>0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-600 font-medium">Input Nilai</span>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Info Section -->
        <div class="mt-8 bg-gray-50 border border-gray-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900 mb-3">Tips Input Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">1</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Pilih Kelas</div>
                                <div class="text-gray-600 text-xs">Klik kelas yang ingin diinput nilainya</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">2</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Input Nilai</div>
                                <div class="text-gray-600 text-xs">Isi nilai untuk setiap komponen penilaian</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">3</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700">Simpan Data</div>
                                <div class="text-gray-600 text-xs">Data tersimpan otomatis saat diinput</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection