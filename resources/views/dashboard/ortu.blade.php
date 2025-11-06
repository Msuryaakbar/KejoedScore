@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Orang Tua</h1>
        <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}! Pantau perkembangan nilai anak Anda.</p>
        @if($siswa->count() > 0)
        <p class="text-sm text-gray-500 mt-1">Anda memiliki {{ $siswa->count() }} anak terdaftar.</p>
        @endif
    </div>

    @if($siswa->count() > 0)
        @foreach($siswa as $anak)
        <div class="bg-white rounded-xl shadow border overflow-hidden mb-6">
            <!-- Student Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold">{{ $anak->nama }}</h3>
                        <p class="text-blue-100 text-sm mt-1">
                            {{ $anak->kelas->nama_kelas ?? 'Kelas tidak tersedia' }} - NIS: {{ $anak->nis }}
                        </p>
                    </div>
                    <a href="{{ route('rapor.siswa', $anak->id) }}" 
                       class="inline-flex items-center gap-2 bg-white text-blue-600 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Lihat Rapor Lengkap
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                @if($anak->nilai->count() > 0)
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4">Nilai Terbaru</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($anak->nilai->take(6) as $nilai)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <p class="text-sm font-medium text-gray-500 mb-2">
                                {{ $nilai->mataPelajaran->nama ?? 'Mata Pelajaran' }}
                            </p>
                            <div class="flex items-center justify-between">
                                <p class="text-2xl font-bold text-blue-600">
                                    {{ number_format($nilai->nilai_akhir ?? 0, 0) }}
                                </p>
                                @php
                                    $score = $nilai->nilai_akhir ?? 0;
                                    $color = $score >= 85 ? 'bg-green-100 text-green-800' : 
                                            ($score >= 75 ? 'bg-yellow-100 text-yellow-800' : 
                                            'bg-red-100 text-red-800');
                                @endphp
                                <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $color }}">
                                    {{ $score >= 85 ? 'A' : ($score >= 75 ? 'B' : 'C') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($anak->nilai->count() > 6)
                    <div class="text-center mt-4">
                        <a href="{{ route('rapor.siswa', $anak->id) }}" 
                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lihat semua {{ $anak->nilai->count() }} nilai →
                        </a>
                    </div>
                    @endif
                </div>
                @else
                <!-- Empty State -->
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada nilai</h4>
                    <p class="text-gray-500 text-sm">Nilai untuk {{ $anak->nama }} belum diinput oleh guru.</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @else
    <!-- No Students Connected -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
        <div class="flex items-start gap-4">
            <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-yellow-800 text-lg mb-2">Belum ada siswa terhubung</h3>
                <p class="text-yellow-700">
                    Silakan hubungi admin untuk menghubungkan akun Anda dengan data siswa.
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Stats -->
    @if($siswa->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-blue-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Total Anak</p>
            <p class="text-2xl font-bold text-gray-900">{{ $siswa->count() }}</p>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-green-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Total Nilai</p>
            <p class="text-2xl font-bold text-green-600">{{ $siswa->sum(fn($s) => $s->nilai->count()) }}</p>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-purple-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Rata-rata Nilai</p>
            <p class="text-2xl font-bold text-purple-600">
                @php
                    $totalNilai = $siswa->flatMap->nilai->avg('nilai_akhir') ?? 0;
                @endphp
                {{ number_format($totalNilai, 1) }}
            </p>
        </div>
    </div>
    @endif
</div>
@endsection