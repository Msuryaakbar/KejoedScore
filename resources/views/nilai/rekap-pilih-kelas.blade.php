@extends('layouts.app')

@section('title', 'Rekap ' . $mapel->nama_mapel)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📊 Rekap Nilai - {{ $mapel->nama_mapel }}</h2>
    <a href="{{ route('nilai.rekap.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
    
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg ml-4">
        {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
</div>

@if($kelas->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada kelas!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelas as $k)
        <a href="{{ route('nilai.rekap.show-mapel', [$mapel->id, $k->id]) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <h3 class="text-xl font-bold text-blue-600">{{ $k->nama_kelas }}</h3>
            <p class="text-gray-600 mt-2">Tingkat: {{ $k->tingkat }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $k->siswa_count }} siswa</p>
            <p class="text-blue-500 text-sm mt-3 font-semibold">→ Lihat Rekap & Ranking</p>
        </a>
        @endforeach
    </div>
@endif
@endsection