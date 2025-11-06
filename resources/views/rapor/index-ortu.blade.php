@extends('layouts.app')

@section('title', 'Rapor Anak')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Rapor Anak</h2>
    <p class="text-gray-600 mt-1">Lihat rapor dan perkembangan nilai anak Anda</p>
</div>

@if($siswaList->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($siswaList as $siswa)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $siswa->nama }}</h3>
                        <p class="text-sm text-gray-600">NIS: {{ $siswa->nis }}</p>
                        <p class="text-sm text-gray-600">{{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}</p>
                    </div>
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Nilai</span>
                        <span class="font-semibold text-gray-900">{{ $siswa->nilai->count() }} mata pelajaran</span>
                    </div>
                </div>

                <div class="mt-4 flex gap-2">
                    <a href="{{ route('rapor.siswa', $siswa) }}" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center">
                        Lihat Rapor
                    </a>
                    <a href="{{ route('rapor.print', $siswa) }}" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
                        target="_blank">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <div class="flex items-center">
            <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div>
                <p class="font-semibold">Belum ada siswa terhubung</p>
                <p class="text-sm mt-1">Silakan hubungi admin untuk menghubungkan akun Anda dengan data siswa.</p>
            </div>
        </div>
    </div>
@endif
@endsection