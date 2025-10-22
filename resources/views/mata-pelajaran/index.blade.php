@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold">📖 Mata Pelajaran</h2>
    <a href="{{ route('mata-pelajaran.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Mata Pelajaran
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($mataPelajaran as $mapel)
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-xl font-bold text-blue-600">{{ $mapel->nama_mapel }}</h3>
                <p class="text-sm text-gray-500">Kode: {{ $mapel->kode_mapel }}</p>
            </div>
            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">
                {{ $mapel->komponen_nilai_count }} Komponen
            </span>
        </div>
        
        @if($mapel->deskripsi)
        <p class="text-gray-600 text-sm mb-4">{{ $mapel->deskripsi }}</p>
        @endif
        
        <div class="flex gap-2">
            <a href="{{ route('komponen-nilai.index', $mapel->id) }}" 
                class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded text-sm">
                ⚙️ Komponen Nilai
            </a>
            <a href="{{ route('mata-pelajaran.edit', $mapel) }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm">
                Edit
            </a>
            <form action="{{ route('mata-pelajaran.destroy', $mapel) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm"
                    onclick="return confirm('Yakin hapus mata pelajaran ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-8 rounded text-center">
        <p class="font-semibold">Belum ada mata pelajaran!</p>
        <p class="text-sm mt-1">Klik tombol "Tambah Mata Pelajaran" untuk mulai.</p>
    </div>
    @endforelse
</div>
@endsection