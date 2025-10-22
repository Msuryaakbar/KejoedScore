@extends('layouts.app')

@section('title', 'Rapor ' . $kelas->nama_kelas)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">📄 Rapor - {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('rapor.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
    
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg ml-4">
        {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
</div>

@if($siswa->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        <p class="font-semibold">Belum ada siswa di kelas ini!</p>
    </div>
@else
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($siswa as $index => $s)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $s->nama }}</td>
                    <td class="px-6 py-4 text-center">{{ $s->nis }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('rapor.siswa', $s->id) }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm mr-2">
                            👁️ Lihat Rapor
                        </a>
                        <a href="{{ route('rapor.print', $s->id) }}" target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            🖨️ Print
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection