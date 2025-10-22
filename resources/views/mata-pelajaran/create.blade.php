@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6">Tambah Mata Pelajaran</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('mata-pelajaran.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" class="w-full border rounded px-3 py-2" 
                    placeholder="Contoh: Matematika" value="{{ old('nama_mapel') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kode Mata Pelajaran</label>
                <input type="text" name="kode_mapel" class="w-full border rounded px-3 py-2" 
                    placeholder="Contoh: MTK" value="{{ old('kode_mapel') }}" required>
                <p class="text-sm text-gray-500 mt-1">Kode unik untuk identifikasi</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="3" 
                    placeholder="Deskripsi singkat tentang mata pelajaran">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('mata-pelajaran.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection