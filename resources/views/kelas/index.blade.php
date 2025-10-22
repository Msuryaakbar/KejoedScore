@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold">Data Kelas</h2>
    <a href="{{ route('kelas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Tambah Kelas
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tingkat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Siswa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($kelas as $k)
            <tr>
                <td class="px-6 py-4">{{ $k->nama_kelas }}</td>
                <td class="px-6 py-4">{{ $k->tingkat }}</td>
                <td class="px-6 py-4">{{ $k->siswa_count }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('kelas.edit', $k) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                    <form action="{{ route('kelas.destroy', $k) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus kelas ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection