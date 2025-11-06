@extends('layouts.app')

@section('title', 'Pilih Siswa - Nilai Dongkrak')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
            <div class="flex-1">
                <!-- Breadcrumb -->
                <div class="flex items-center gap-3 mb-4">
                    <a href="{{ route('nilai-dongkrak.index') }}" 
                       class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition-colors duration-200 group">
                        <i class="fas fa-arrow-left text-sm group-hover:translate-x-[-2px] transition-transform"></i>
                        <span class="text-sm font-medium">Kembali ke Pilih Kelas</span>
                    </a>
                    <span class="text-gray-300">|</span>
                    <span class="text-sm text-gray-500">Nilai Dongkrak {{ $kelas->nama_kelas }}</span>
                </div>

                <!-- Page Title -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Input Nilai Dongkrak</h1>
                    <p class="text-gray-600">Pilih siswa untuk input nilai dongkrak kelas {{ $kelas->nama_kelas }}</p>
                </div>

                <!-- Info Cards -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-3 bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-blue-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Kelas</div>
                            <div class="font-semibold text-gray-900">{{ $kelas->nama_kelas }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Total Siswa</div>
                            <div class="font-semibold text-gray-900">{{ $siswa->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl shadow-lg p-6 text-white min-w-[200px]">
                <div class="text-3xl font-bold mb-1">{{ $siswa->count() }}</div>
                <div class="text-blue-100 text-sm font-medium">Siswa Tersedia</div>
                <div class="w-12 h-1 bg-blue-300 rounded-full mt-3"></div>
            </div>
        </div>
    </div>

    @if($siswa->isEmpty())
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-8 text-center max-w-2xl mx-auto">
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-exclamation-triangle text-amber-500 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-amber-800 mb-3">Belum Ada Data Siswa</h3>
            <p class="text-amber-700 mb-6 max-w-md mx-auto">
                Tidak ada siswa yang terdaftar di kelas {{ $kelas->nama_kelas }}.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('siswa.index') }}" 
                   class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md">
                    <i class="fas fa-plus-circle"></i>
                    Kelola Siswa
                </a>
                <a href="{{ route('nilai-dongkrak.index') }}" 
                   class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-amber-700 font-semibold px-6 py-3 rounded-lg border border-amber-300 transition-all duration-200">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    @else
        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Siswa - {{ $kelas->nama_kelas }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Total {{ $siswa->count() }} siswa</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Pilih siswa untuk input nilai dongkrak
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama Siswa
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                NIS
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($siswa as $index => $s)
                        <tr class="table-row hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <span class="text-sm font-semibold text-blue-600">{{ $index + 1 }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="avatar bg-gradient-to-br from-blue-500 to-cyan-600">
                                        {{ substr($s->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $s->nama }}</div>
                                        <div class="text-xs text-gray-500 mt-1">Kelas {{ $kelas->tingkat }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $s->nis }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('nilai-dongkrak.show-siswa', $s->id) }}" 
                                       class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105 shadow-sm">
                                        <i class="fas fa-edit text-xs"></i>
                                        Input Nilai Dongkrak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="text-center text-sm text-gray-600">
                    Menampilkan semua <span class="font-semibold">{{ $siswa->count() }}</span> siswa
                </div>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="mt-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-blue-900 mb-1">Informasi Nilai Dongkrak</h4>
                    <p class="text-sm text-blue-700">
                        Nilai dongkrak digunakan untuk meningkatkan nilai siswa pada mata pelajaran tertentu. 
                        Pastikan menginput nilai dengan teliti dan sesuai dengan kemampuan siswa.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        font-size: 14px;
    }
    
    .table-row {
        transition: all 0.2s ease;
    }
    
    .table-row:hover {
        background-color: #f8fafc;
    }
    
    @media (max-width: 768px) {
        .avatar {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }
    }
</style>
@endsection