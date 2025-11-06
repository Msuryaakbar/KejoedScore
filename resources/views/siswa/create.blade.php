@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('siswa.index') }}" 
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Data Siswa
            </a>
        </div>
        
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Siswa</h1>
            <p class="text-gray-600">Tambah data siswa baru ke sistem</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <h2 class="text-lg font-bold text-gray-900">Form Tambah Siswa</h2>
            <p class="text-gray-600 text-sm mt-1">Isi data siswa baru di bawah ini</p>
        </div>

        <div class="p-6">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-900 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama"
                           name="nama" 
                           value="{{ old('nama') }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('nama') border-red-500 @enderror"
                           placeholder="Masukkan nama lengkap siswa">
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIS -->
                <div class="mb-6">
                    <label for="nis" class="block text-sm font-semibold text-gray-900 mb-2">
                        NIS (Nomor Induk Siswa) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nis"
                           name="nis" 
                           value="{{ old('nis') }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('nis') border-red-500 @enderror"
                           placeholder="Masukkan NIS siswa">
                    @error('nis')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                        Email
                    </label>
                    <input type="email" 
                           id="email"
                           name="email" 
                           value="{{ old('email') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                           placeholder="Masukkan email siswa (opsional)">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas - Fixed for Mobile -->
                <div class="mb-6">
                    <label for="kelas_id" class="block text-sm font-semibold text-gray-900 mb-2">
                        Kelas <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="kelas_id" 
                                id="kelas_id"
                                required
                                class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none bg-white @error('kelas_id') border-red-500 @enderror"
                                style="max-width: 100%">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('kelas_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Siswa
                    </button>
                    <a href="{{ route('siswa.index') }}" 
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition-colors border border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Section -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-blue-900 mb-2">Tips Pengisian Data</h3>
                <div class="space-y-2 text-sm text-blue-800">
                    <p>• Pastikan NIS unik dan belum digunakan oleh siswa lain</p>
                    <p>• Pilih kelas yang sesuai untuk penempatan siswa</p>
                    <p>• Email bersifat opsional dan dapat diisi nanti</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fix untuk select dropdown di mobile */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1rem 1rem;
        padding-right: 2.5rem;
    }
    
    /* Fix untuk iOS */
    select:focus {
        outline: none;
    }
    
    /* Pastikan tidak melebihi container */
    .max-w-2xl {
        max-width: 42rem;
    }
    
    /* Fix untuk mobile viewport */
    @media (max-width: 640px) {
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        select {
            font-size: 16px; /* Prevent zoom on iOS */
            max-width: 100%;
        }
    }
</style>

<script>
    // Additional fix untuk mobile
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('kelas_id');
        
        // Prevent horizontal scrolling ketika select dibuka
        select.addEventListener('focus', function() {
            document.body.style.overflowX = 'hidden';
        });
        
        select.addEventListener('blur', function() {
            document.body.style.overflowX = 'auto';
        });
        
        // Force width constraint
        select.style.maxWidth = '100%';
    });
</script>
@endsection