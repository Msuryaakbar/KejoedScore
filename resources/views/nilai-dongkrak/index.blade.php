@extends('layouts.app')

@section('title', 'Kelola Nilai Dongkrak')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Nilai Dongkrak</h1>
                <p class="text-gray-600">Input nilai dongkrak untuk keperluan dinas</p>
            </div>
            <div class="flex items-center gap-2 text-gray-500 bg-blue-50 px-4 py-3 rounded-lg border border-blue-200">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm">Pilih kelas untuk mengelola nilai dongkrak</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Kelas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $kelas->count() }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Siswa</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $kelas->sum('siswa_count') }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Mapel</p>
                    <p class="text-3xl font-bold text-green-600">{{ $kelas->sum('mapel_count') }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Tahun Ajaran</p>
                    <p class="text-xl font-bold text-purple-600">{{ $tahunAjaranAktif->nama ?? '-' }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-blue-900 mb-2">Tentang Nilai Dongkrak</h3>
                <p class="text-blue-800 text-sm leading-relaxed">
                    Nilai dongkrak adalah nilai yang disesuaikan untuk memenuhi KKM dan keperluan pelaporan dinas. 
                    Fitur ini memungkinkan penyesuaian nilai akhir siswa sesuai kebutuhan administrasi tanpa mengubah nilai asli.
                </p>
            </div>
        </div>
    </div>

    <!-- Kelas Section -->
    <div class="bg-white rounded-xl shadow border overflow-hidden mb-8">
        <!-- Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Pilih Kelas</h3>
                <div class="text-sm text-gray-600">
                    <span class="font-semibold">{{ $kelas->count() }}</span> kelas tersedia
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            @if(!$kelas || $kelas->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum Ada Kelas</h3>
                    <p class="text-gray-500 mb-6">Tidak ada kelas yang tersedia untuk pengelolaan nilai dongkrak.</p>
                    <a href="{{ route('kelas.index') }}" 
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Kelola Kelas
                    </a>
                </div>
            @else
                <!-- Kelas Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($kelas as $k)
                    <a href="{{ route('nilai-dongkrak.show-kelas', $k->id) }}" 
                       class="block bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200 overflow-hidden group">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-5 py-4 text-white">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-lg truncate">{{ $k->nama_kelas }}</h4>
                                <svg class="w-5 h-5 text-blue-200 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            <div class="flex items-center gap-2 mt-1 text-blue-100 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>Tingkat {{ $k->tingkat ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">{{ $k->siswa_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-500 font-medium">Siswa</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">{{ $k->mapel_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-500 font-medium">Mapel</div>
                                </div>
                            </div>
                            
                            <!-- Status -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Status</span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Siap
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Guide Section -->
    <div class="bg-white rounded-xl shadow border p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Panduan Penggunaan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg">
                <div class="bg-blue-100 text-blue-600 rounded-lg p-2">
                    <span class="font-bold text-sm">1</span>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-900 text-sm">Pilih Kelas</h4>
                    <p class="text-blue-700 text-xs mt-1">Pilih kelas yang akan dikelola nilai dongkraknya</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-4 bg-green-50 rounded-lg">
                <div class="bg-green-100 text-green-600 rounded-lg p-2">
                    <span class="font-bold text-sm">2</span>
                </div>
                <div>
                    <h4 class="font-semibold text-green-900 text-sm">Pilih Mapel</h4>
                    <p class="text-green-700 text-xs mt-1">Tentukan mata pelajaran yang akan disesuaikan</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-4 bg-purple-50 rounded-lg">
                <div class="bg-purple-100 text-purple-600 rounded-lg p-2">
                    <span class="font-bold text-sm">3</span>
                </div>
                <div>
                    <h4 class="font-semibold text-purple-900 text-sm">Input Nilai</h4>
                    <p class="text-purple-700 text-xs mt-1">Masukkan nilai dongkrak untuk kebutuhan dinas</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection