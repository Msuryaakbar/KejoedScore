@extends('layouts.app')

@section('title', 'Rapor Siswa')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📄 Rapor Siswa</h2>
    <p class="text-gray-600 mt-2">Lihat rapor lengkap seluruh mata pelajaran per siswa</p>
    
    @if($tahunAjaranAktif)
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg">
        <span class="font-semibold">Tahun Ajaran:</span> {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
    @endif
</div>

@if($kelas->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada kelas!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelas as $k)
        <a href="{{ route('rapor.kelas', $k->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <h3 class="text-xl font-bold text-blue-600">{{ $k->nama_kelas }}</h3>
            <p class="text-gray-600 mt-2">Tingkat: {{ $k->tingkat }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $k->siswa_count }} siswa</p>
            <p class="text-blue-500 text-sm mt-3 font-semibold">→ Lihat Daftar Rapor</p>
        </a>
        @endforeach
    </div>
@endif
@endsection