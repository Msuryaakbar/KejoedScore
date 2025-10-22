@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold">Data Siswa</h2>
    <a href="{{ route('siswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Tambah Siswa
    </a>
</div>

@if($siswa->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada data siswa!</p>
        <p class="text-sm mt-1">Klik tombol "Tambah Siswa" untuk menambahkan siswa baru.</p>
    </div>
@else
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($siswa as $index => $s)
                <tr>
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $s->nama }}</td>
                    <td class="px-6 py-4">{{ $s->nis }}</td>
                    <td class="px-6 py-4">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('siswa.edit', $s) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('siswa.destroy', $s) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" 
                                onclick="return confirm('Yakin ingin menghapus siswa {{ $s->nama }}?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection