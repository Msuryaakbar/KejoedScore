@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Input Nilai - Pilih Kelas</h2>
</div>

@if(!isset($kelas) || $kelas->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada data kelas!</p>
        <p class="text-sm mt-1">Silakan tambahkan kelas terlebih dahulu di menu <a href="{{ route('kelas.index') }}" class="underline font-semibold">Data Kelas</a>.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelas as $k)
            @if($k && isset($k->id) && isset($k->nama_kelas))
                <a href="{{ route('nilai.show', $k->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                    <h3 class="text-xl font-bold text-blue-600">{{ $k->nama_kelas }}</h3>
                    <p class="text-gray-600 mt-2">Tingkat: {{ $k->tingkat ?? '-' }}</p>
                    <p class="text-gray-500 text-sm mt-1">Klik untuk input nilai</p>
                </a>
            @endif
        @endforeach
    </div>
@endif
@endsection