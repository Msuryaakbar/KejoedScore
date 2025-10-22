@extends('layouts.app')

@section('title', 'Rekap Nilai')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📊 Rekap Nilai - Pilih Kelas</h2>
    <p class="text-gray-600 mt-2">Lihat rekap nilai dan predikat seluruh siswa per kelas</p>
</div>

@if($kelas->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada data kelas!</p>
        <p class="text-sm mt-1">Silakan tambahkan kelas terlebih dahulu di menu <a href="{{ route('kelas.index') }}" class="underline font-semibold">Data Kelas</a>.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelas as $k)
        <a href="{{ route('nilai.rekap.show', $k->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <h3 class="text-xl font-bold text-blue-600">{{ $k->nama_kelas }}</h3>
            <p class="text-gray-600 mt-2">Tingkat: {{ $k->tingkat }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $k->siswa_count }} siswa</p>
            <p class="text-blue-500 text-sm mt-3 font-semibold">→ Lihat Rekap Nilai</p>
        </a>
        @endforeach
    </div>
@endif
@endsection