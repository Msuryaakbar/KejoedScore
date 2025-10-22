@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold">📅 Tahun Ajaran</h2>
    <a href="{{ route('tahun-ajaran.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Tambah Tahun Ajaran
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($tahunAjaran as $ta)
            <tr class="{{ $ta->is_active ? 'bg-green-50' : '' }}">
                <td class="px-6 py-4 font-semibold">{{ $ta->tahun }}</td>
                <td class="px-6 py-4">Semester {{ $ta->semester }}</td>
                <td class="px-6 py-4 text-center">
                    @if($ta->is_active)
                        <span class="px-3 py-1 bg-green-500 text-white text-xs rounded-full font-bold">Aktif</span>
                    @else
                        <form action="{{ route('tahun-ajaran.set-active', $ta->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 text-xs rounded-full">
                                Set Aktif
                            </button>
                        </form>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    @if(!$ta->is_active)
                    <form action="{{ route('tahun-ajaran.destroy', $ta) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                    @else
                        <span class="text-gray-400 text-sm">Tidak bisa dihapus</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    Belum ada data tahun ajaran
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection