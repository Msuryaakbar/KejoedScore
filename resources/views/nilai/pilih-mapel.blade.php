@extends('layouts.app')

@section('title', 'Input Nilai - Pilih Mata Pelajaran')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📝 Input Nilai</h2>
    <p class="text-gray-600 mt-2">Pilih mata pelajaran yang akan dinilai</p>
    
    @if($tahunAjaranAktif)
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg">
        <span class="font-semibold">Tahun Ajaran Aktif:</span> {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
    @endif
</div>

@if($mataPelajaran->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada mata pelajaran!</p>
        <p class="text-sm mt-1">Silakan tambahkan mata pelajaran terlebih dahulu di menu <a href="{{ route('mata-pelajaran.index') }}" class="underline font-semibold">Mata Pelajaran</a>.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($mataPelajaran as $mapel)
        <a href="{{ route('nilai.pilih-kelas', $mapel->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xl font-bold text-blue-600">{{ $mapel->nama_mapel }}</h3>
                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $mapel->kode_mapel }}</span>
            </div>
            @if($mapel->deskripsi)
            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($mapel->deskripsi, 80) }}</p>
            @endif
            <p class="text-blue-500 text-sm font-semibold">→ Pilih Kelas untuk Input Nilai</p>
        </a>
        @endforeach
    </div>
@endif
@endsection