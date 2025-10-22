@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6">Edit Mata Pelajaran</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('mata-pelajaran.update', $mataPelajaran) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" class="w-full border rounded px-3 py-2" 
                    value="{{ old('nama_mapel', $mataPelajaran->nama_mapel) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kode Mata Pelajaran</label>
                <input type="text" name="kode_mapel" class="w-full border rounded px-3 py-2" 
                    value="{{ old('kode_mapel', $mataPelajaran->kode_mapel) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="3">{{ old('deskripsi', $mataPelajaran->deskripsi) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update
                </button>
                <a href="{{ route('mata-pelajaran.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection