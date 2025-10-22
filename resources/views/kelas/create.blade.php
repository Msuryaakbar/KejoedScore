{{-- resources/views/kelas/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6">Tambah Kelas</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="w-full border rounded px-3 py-2" value="{{ old('nama_kelas') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Tingkat</label>
                <input type="text" name="tingkat" class="w-full border rounded px-3 py-2" value="{{ old('tingkat') }}" required>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('kelas.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection