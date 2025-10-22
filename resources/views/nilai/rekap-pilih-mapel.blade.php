@extends('layouts.app')

@section('title', 'Rekap Nilai - Pilih Mata Pelajaran')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📊 Rekap Nilai</h2>
    <p class="text-gray-600 mt-2">Pilih mata pelajaran untuk melihat rekap nilai & ranking</p>
    
    @if($tahunAjaranAktif)
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg">
        <span class="font-semibold">Tahun Ajaran Aktif:</span> {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
    @endif
</div>

@if($mataPelajaran->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada mata pelajaran!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($mataPelajaran as $mapel)
        <a href="{{ route('nilai.rekap.pilih-kelas', $mapel->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <h3 class="text-xl font-bold text-blue-600">{{ $mapel->nama_mapel }}</h3>
            <p class="text-sm text-gray-500 mt-2">Kode: {{ $mapel->kode_mapel }}</p>
            <p class="text-blue-500 text-sm mt-3 font-semibold">→ Lihat Rekap & Ranking</p>
        </a>
        @endforeach
    </div>
@endif
@endsection