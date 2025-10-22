@extends('layouts.app')

@section('title', 'Pilih Kelas - ' . $mapel->nama_mapel)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📝 Input Nilai - {{ $mapel->nama_mapel }}</h2>
    <a href="{{ route('nilai.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali ke Pilih Mapel</a>
    
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg ml-4">
        <span class="font-semibold">{{ $tahunAjaranAktif->nama_lengkap }}</span>
    </div>
</div>

<!-- Info Komponen Nilai -->
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
    <h3 class="font-bold text-blue-900 mb-2">📋 Komponen Penilaian:</h3>
    <div class="flex flex-wrap gap-2">
        @foreach($mapel->komponenNilai as $komponen)
        <span class="px-3 py-1 bg-blue-200 text-blue-900 rounded-full text-sm font-semibold">
            {{ $komponen->nama_komponen }} ({{ $komponen->bobot }}%)
        </span>
        @endforeach
        <span class="px-3 py-1 bg-purple-200 text-purple-900 rounded-full text-sm font-semibold">
            Catatan/Paraf (10%)
        </span>
    </div>
</div>

<!-- Pilih Kelas -->
@if($kelas->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada kelas!</p>
        <p class="text-sm mt-1">Silakan tambahkan kelas terlebih dahulu.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelas as $k)
        <a href="{{ route('nilai.show-mapel', [$mapel->id, $k->id]) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <h3 class="text-xl font-bold text-blue-600">{{ $k->nama_kelas }}</h3>
            <p class="text-gray-600 mt-2">Tingkat: {{ $k->tingkat }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $k->siswa_count }} siswa</p>
            <p class="text-blue-500 text-sm mt-3 font-semibold">→ Input Nilai</p>
        </a>
        @endforeach
    </div>
@endif
@endsection