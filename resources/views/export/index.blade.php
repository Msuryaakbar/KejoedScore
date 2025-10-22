{{-- resources/views/export/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Ekspor Excel')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Ekspor Data Nilai ke Excel</h2>
    <p class="text-gray-600 mt-2">Pilih kelas untuk mengunduh data nilai dalam format Excel</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($kelas as $k)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-blue-600 mb-2">{{ $k->nama_kelas }}</h3>
        <p class="text-gray-600 mb-4">Tingkat: {{ $k->tingkat }}</p>
        <a href="{{ route('export.excel', $k->id) }}" 
            class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full text-center">
            📥 Download Excel
        </a>
    </div>
    @endforeach
</div>
@endsection