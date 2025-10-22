{{-- resources/views/siswa/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6">Tambah Siswa</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama</label>
                <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">NIS</label>
                <input type="text" name="nis" class="w-full border rounded px-3 py-2" value="{{ old('nis') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kelas</label>
                <select name="kelas_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('siswa.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection