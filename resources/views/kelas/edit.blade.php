@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('kelas.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 mr-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <div class="h-6 w-px bg-gray-300 mr-4"></div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Kelas</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <form action="{{ route('kelas.update', $kelas) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kelas -->
                    <div class="mb-6">
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kelas
                        </label>
                        <input type="text" 
                               id="nama_kelas"
                               name="nama_kelas" 
                               value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan nama kelas">
                        @error('nama_kelas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tingkat -->
                    <div class="mb-6">
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tingkat
                        </label>
                        <select name="tingkat" 
                                id="tingkat"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Tingkat</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('tingkat', $kelas->tingkat) == $i ? 'selected' : '' }}>
                                    Kelas {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            Update Kelas
                        </button>
                        <a href="{{ route('kelas.index') }}" 
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection