@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6">Tambah Tahun Ajaran</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('tahun-ajaran.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Tahun Ajaran</label>
                <input type="text" name="tahun" class="w-full border rounded px-3 py-2" 
                    placeholder="Contoh: 2024/2025" value="{{ old('tahun') }}" required>
                <p class="text-sm text-gray-500 mt-1">Format: YYYY/YYYY (misal: 2024/2025)</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Semester</label>
                <select name="semester" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Semester</option>
                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('tahun-ajaran.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection