@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('tahun-ajaran.index') }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-3 rounded-2xl">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Tahun Ajaran</h1>
                <p class="text-gray-600 mt-1">Buat periode tahun ajaran baru untuk sistem</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="bg-green-100 p-2 rounded-lg">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="text-green-800 font-medium">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    <!-- Form Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Form Tahun Ajaran</h2>
            <p class="text-gray-600 mt-1">Isi data tahun ajaran dengan benar</p>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form action="{{ route('tahun-ajaran.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Tahun Ajaran Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-900">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="tahun" 
                               value="{{ old('tahun') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('tahun') border-red-500 @enderror"
                               placeholder="Contoh: 2024/2025" 
                               required>
                        @error('tahun')
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('tahun')
                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                    @else
                        <p class="text-gray-500 text-sm">Format: YYYY/YYYY (contoh: 2024/2025)</p>
                    @enderror
                </div>

                <!-- Semester Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-900">
                        Semester <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="semester" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none @error('semester') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Semester</option>
                            <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                            <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                        @error('semester')
                            <div class="absolute inset-y-0 right-8 flex items-center pr-3">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('semester')
                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                    @else
                        <p class="text-gray-500 text-sm">Pilih semester untuk tahun ajaran ini</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg mt-0.5">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-blue-800">
                            <p class="font-semibold">Informasi Penting</p>
                            <p class="text-sm mt-1">Pastikan tahun ajaran yang akan ditambahkan belum ada dalam sistem. Hanya satu tahun ajaran yang dapat aktif dalam satu waktu.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6">
                    <button type="submit" 
                            class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors shadow-lg hover:shadow-xl flex-1 sm:flex-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Tahun Ajaran
                    </button>
                    <a href="{{ route('tahun-ajaran.index') }}" 
                       class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-8 py-3 rounded-xl transition-colors border border-gray-300 flex-1 sm:flex-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-blue-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Total Tahun Ajaran</p>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\TahunAjaran::count() }}</p>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-green-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Tahun Aktif</p>
            <p class="text-2xl font-bold text-green-600">{{ \App\Models\TahunAjaran::where('is_active', true)->count() }}</p>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6 text-center">
            <div class="bg-gray-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-600">Tahun Non-Aktif</p>
            <p class="text-2xl font-bold text-gray-600">{{ \App\Models\TahunAjaran::where('is_active', false)->count() }}</p>
        </div>
    </div>
</div>

<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
</style>
@endsection