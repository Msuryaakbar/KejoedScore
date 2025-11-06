@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-700 rounded-2xl p-6 md:p-8 mb-6 md:mb-8 text-white shadow-xl relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full"></div>
            
            <div class="relative z-10">
                <h1 class="text-2xl md:text-4xl font-bold mb-2">Dashboard Admin</h1>
                <p class="text-blue-100 text-lg">Selamat datang di Islamic Muhammadiyah Excellence Score System</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <!-- Total Siswa -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 shadow-md">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalSiswa }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>12% dari bulan lalu</span>
                </div>
            </div>

            <!-- Total Kelas -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 shadow-md">
                        <i class="fas fa-school text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Kelas</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalKelas }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>5% dari bulan lalu</span>
                </div>
            </div>

            <!-- Total Guru -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-4 shadow-md">
                        <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Guru</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalGuru }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>8% dari bulan lalu</span>
                </div>
            </div>

            <!-- Total Orang Tua -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 shadow-md">
                        <i class="fas fa-user-friends text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Orang Tua</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalOrtu }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-500">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>15% dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900">Quick Actions</h2>
                        <p class="text-gray-600 mt-1">Akses cepat ke fitur utama sistem</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-bolt mr-1"></i>
                            Akses Cepat
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                    <!-- Tambah User -->
                    <a href="{{ route('users.create') }}" class="group">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:border-blue-300 hover:transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-2xl p-3 group-hover:bg-blue-600 transition-colors duration-300">
                                    <i class="fas fa-user-plus text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Tambah User</h3>
                                    <p class="text-sm text-gray-600 mt-1">Guru atau Orang Tua</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span>Klik untuk menambah</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Tambah Siswa -->
                    <a href="{{ route('siswa.create') }}" class="group">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:border-green-300 hover:transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-2xl p-3 group-hover:bg-green-600 transition-colors duration-300">
                                    <i class="fas fa-user-graduate text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-300">Tambah Siswa</h3>
                                    <p class="text-sm text-gray-600 mt-1">Data siswa baru</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span>Klik untuk menambah</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Tambah Kelas -->
                    <a href="{{ route('kelas.create') }}" class="group">
                        <div class="bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:border-amber-300 hover:transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-amber-500 rounded-2xl p-3 group-hover:bg-amber-600 transition-colors duration-300">
                                    <i class="fas fa-plus text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-amber-600 transition-colors duration-300">Tambah Kelas</h3>
                                    <p class="text-sm text-gray-600 mt-1">Kelas baru</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span>Klik untuk menambah</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section (Optional) -->
        <div class="mt-6 md:mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            <!-- Recent Users -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pengguna Baru</h3>
                    <a href="{{ route('users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Guru Baru</p>
                                <p class="text-xs text-gray-500">2 jam yang lalu</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Guru</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Orang Tua</p>
                                <p class="text-xs text-gray-500">5 jam yang lalu</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Orang Tua</span>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Status Sistem</h3>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        <i class="fas fa-circle mr-1 text-green-500"></i>
                        Online
                    </span>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Server Load</span>
                        <span class="text-sm font-medium text-green-600">25%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-gray-600">Database</span>
                        <span class="text-sm font-medium text-green-600">Normal</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<style>
    /* Custom animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
</style>
@endsection