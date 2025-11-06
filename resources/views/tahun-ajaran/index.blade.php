@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tahun Ajaran</h1>
                <p class="text-gray-600">Kelola periode tahun ajaran dan semester</p>
            </div>
            <a href="{{ route('tahun-ajaran.create') }}" 
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Tahun Ajaran
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="bg-green-100 p-2 rounded-full">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="text-green-800 font-medium">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Tahun Ajaran</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $tahunAjaran->count() }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Tahun Aktif</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $tahunAjaran->where('is_active', true)->count() }}
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Tahun Non-Aktif</p>
                    <p class="text-3xl font-bold text-gray-600">
                        {{ $tahunAjaran->where('is_active', false)->count() }}
                    </p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Daftar Tahun Ajaran</h3>
                <div class="text-sm text-gray-600">
                    <span class="font-semibold">{{ $tahunAjaran->count() }}</span> tahun ajaran
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-b">
                            Tahun Ajaran
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-b">
                            Semester
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-b">
                            Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider border-b">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tahunAjaran as $ta)
                    <tr class="{{ $ta->is_active ? 'bg-green-50 hover:bg-green-100' : 'hover:bg-gray-50' }} transition-colors">
                        <!-- Tahun -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-lg">{{ $ta->tahun }}</div>
                                    @if($ta->is_active)
                                    <div class="text-xs text-green-600 font-medium mt-1">Sedang berjalan</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        
                        <!-- Semester -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <span class="text-purple-600 font-bold text-sm">{{ $ta->semester }}</span>
                                </div>
                                <span class="text-gray-700 font-medium">Semester {{ $ta->semester }}</span>
                            </div>
                        </td>
                        
                        <!-- Status -->
                        <td class="px-6 py-4 text-center">
                            @if($ta->is_active)
                                <span class="inline-flex items-center gap-1 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <form action="{{ route('tahun-ajaran.set-active', $ta->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Set Aktif
                                    </button>
                                </form>
                            @endif
                        </td>
                        
                        <!-- Aksi -->
                        <td class="px-6 py-4 text-center">
                            @if(!$ta->is_active)
                            <form action="{{ route('tahun-ajaran.destroy', $ta) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                                        onclick="return confirm('Yakin ingin menghapus tahun ajaran {{ $ta->tahun }} Semester {{ $ta->semester }}?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @else
                                <span class="text-gray-400 text-sm">Tidak bisa dihapus</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="font-semibold text-lg">Belum ada data tahun ajaran</p>
                                <p class="text-sm">Mulai dengan menambahkan tahun ajaran baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Box -->
    @if($tahunAjaran->where('is_active', true)->count() > 0)
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2 rounded-lg">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-blue-800">
                <p class="font-semibold">Info Status Aktif</p>
                <p class="text-sm">Hanya satu tahun ajaran yang dapat aktif dalam satu waktu. Mengaktifkan tahun ajaran baru akan menonaktifkan tahun ajaran sebelumnya.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection