@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-700 rounded-2xl p-6 md:p-8 mb-6 text-white shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                    <p class="text-blue-100 text-lg">Anda telah menginput <span class="font-bold text-white">{{ $totalNilai }}</span> nilai siswa</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm font-semibold">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                        Dashboard Guru
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Nilai -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-xl p-3">
                        <i class="fas fa-edit text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Nilai Diinput</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalNilai }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>Aktif minggu ini</span>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-xl p-3">
                        <i class="fas fa-book text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Mata Pelajaran</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalMapel ?? '5' }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-list mr-1"></i>
                    <span>Yang diajar</span>
                </div>
            </div>

            <!-- Kelas -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-xl p-3">
                        <i class="fas fa-school text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Kelas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalKelas ?? '3' }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <i class="fas fa-users mr-1"></i>
                    <span>Yang dihandle</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Input Nilai Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold mb-2">Input Nilai</h3>
                        <p class="text-blue-100 mb-4">Masukkan nilai siswa dengan cepat dan mudah</p>
                        <a href="{{ route('nilai.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Mulai Input
                        </a>
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <i class="fas fa-edit text-white text-4xl opacity-20"></i>
                    </div>
                </div>
            </div>

            <!-- Rekap Nilai Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold mb-2">Rekap Nilai</h3>
                        <p class="text-green-100 mb-4">Lihat dan analisis rekap nilai siswa</p>
                        <a href="{{ route('nilai.rekap.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Lihat Rekap
                        </a>
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <i class="fas fa-chart-bar text-white text-4xl opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900">Aktivitas Terakhir</h3>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                        {{ $recentNilai->count() }} aktivitas
                    </span>
                </div>
            </div>

            @if($recentNilai->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentNilai as $nilai)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $nilai->siswa->nama ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ $nilai->siswa->nis ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $nilai->mataPelajaran->nama ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                    {{ $nilai->siswa->kelas->nama ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2 text-gray-400"></i>
                                    {{ $nilai->updated_at->diffForHumans() }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Aktivitas</h4>
                <p class="text-gray-500 mb-4">Mulai input nilai siswa untuk melihat aktivitas di sini</p>
                <a href="{{ route('nilai.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Input Nilai Pertama
                </a>
            </div>
            @endif
        </div>

        <!-- Quick Tips -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-lightbulb text-blue-600 mr-2"></i>
                    <span class="font-semibold text-blue-800">Tips Cepat</span>
                </div>
                <p class="text-sm text-blue-700">Gunakan filter untuk mencari siswa dengan cepat</p>
            </div>
            <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-bolt text-green-600 mr-2"></i>
                    <span class="font-semibold text-green-800">Fitur Baru</span>
                </div>
                <p class="text-sm text-green-700">Export nilai ke Excel tersedia</p>
            </div>
            <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-bell text-purple-600 mr-2"></i>
                    <span class="font-semibold text-purple-800">Pengingat</span>
                </div>
                <p class="text-sm text-purple-700">Jangan lupa simpan perubahan</p>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
@endsection