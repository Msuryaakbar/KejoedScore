@extends('layouts.app')

@section('title', 'Komponen Nilai - ' . $mapel->nama_mapel)

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Komponen Nilai</h1>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-lg font-semibold text-gray-700">{{ $mapel->nama_mapel }}</span>
                    </div>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-600">Kode: {{ $mapel->kode_mapel }}</span>
                </div>
            </div>
            <a href="{{ route('mata-pelajaran.index') }}" 
               class="flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 font-medium px-4 py-2 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Status Bobot -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-100 font-medium">Total Bobot Komponen</p>
                    @php
                        $totalBobot = $komponen->sum('bobot');
                    @endphp
                    <p class="text-4xl font-bold">{{ $totalBobot }}%</p>
                </div>
            </div>
            
            <div class="text-right">
                @if($totalBobot == 100)
                    <div class="bg-green-500 bg-opacity-20 border border-green-300 border-opacity-50 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Bobot Sudah Tepat 100%</span>
                        </div>
                    </div>
                @else
                    <div class="bg-red-500 bg-opacity-20 border border-red-300 border-opacity-50 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Bobot Harus 100%</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sistem Penilaian -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-blue-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800">Komponen Nilai (100%)</h3>
            </div>
            <p class="text-gray-600 text-sm mb-2">Tentukan komponen penilaian dengan total bobot <span class="font-bold text-blue-600">100%</span></p>
            <p class="text-xs text-gray-500 bg-blue-50 p-2 rounded-lg">Contoh: Tugas 20%, UTS 30%, UAS 50%</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-purple-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-purple-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800">Bonus Catatan/Paraf</h3>
            </div>
            <p class="text-gray-600 text-sm mb-2">Setiap paraf = <span class="font-bold text-purple-600">+1 poin</span> bonus (maksimal +10)</p>
            <p class="text-xs text-gray-500 bg-purple-50 p-2 rounded-lg">Tidak masuk bobot 100%, murni bonus</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-red-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-red-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800">Pengurang Alfa</h3>
            </div>
            <p class="text-gray-600 text-sm mb-2">Setiap alfa = <span class="font-bold text-red-600">-2 poin</span></p>
            <p class="text-xs text-gray-500 bg-red-50 p-2 rounded-lg">Mengurangi dari nilai akhir</p>
        </div>
    </div>

    <!-- Form Tambah Komponen -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-green-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Tambah Komponen Baru</h3>
        </div>
        
        <form action="{{ route('komponen-nilai.store', $mapel->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Nama Komponen</label>
                    <div class="relative">
                        <input type="text" name="nama_komponen" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                            placeholder="Tugas, UTS, UAS, Praktik, Quiz" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Bobot (%)</label>
                    <div class="relative">
                        <input type="number" name="bobot" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" 
                            placeholder="0-100" min="0" max="100" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    💡 <span class="font-semibold">Tips:</span> Total semua bobot komponen harus <span class="font-bold text-green-600">100%</span>
                </p>
                <button type="submit" 
                    class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Komponen
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Komponen -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Daftar Komponen Nilai</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Komponen</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Bobot</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Kontribusi Nilai</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($komponen as $index => $k)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-sm font-semibold text-blue-600">{{ $index + 1 }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="font-semibold text-gray-800">{{ $k->nama_komponen }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-bold text-lg">
                                {{ $k->bobot }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-700">
                                    Nilai 100 → <span class="text-green-600">{{ $k->bobot }} poin</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Nilai 80 → <span class="text-blue-600">{{ $k->bobot * 0.8 }} poin</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="editKomponen({{ $k->id }}, '{{ $k->nama_komponen }}', {{ $k->bobot }})" 
                                    class="flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-2 rounded-lg font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <form action="{{ route('komponen-nilai.destroy', [$mapel->id, $k->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg font-medium transition-colors"
                                        onclick="return confirm('Yakin hapus komponen {{ $k->nama_komponen }}?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="font-semibold text-lg">Belum ada komponen nilai</p>
                                <p class="text-sm">Tambahkan komponen penilaian menggunakan form di atas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    
                    @if($komponen->count() > 0)
                    <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 font-bold border-t-2 border-blue-200">
                        <td colspan="2" class="px-6 py-4 text-right text-gray-700">TOTAL BOBOT:</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-6 py-3 rounded-full text-xl font-bold 
                                {{ $totalBobot == 100 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $totalBobot }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($totalBobot == 100)
                                <span class="text-green-600 font-semibold">✓ Siap digunakan</span>
                            @elseif($totalBobot < 100)
                                <span class="text-orange-600 font-semibold">Kurang {{ 100 - $totalBobot }}%</span>
                            @else
                                <span class="text-red-600 font-semibold">Kelebihan {{ $totalBobot - 100 }}%</span>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contoh Perhitungan -->
    @if($komponen->count() > 0)
    <div class="mt-8 bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl shadow-lg p-6 border border-purple-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="bg-purple-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-purple-900">Contoh Perhitungan Nilai Akhir</h3>
        </div>
        
        <div class="bg-white rounded-xl p-6">
            <p class="font-semibold text-gray-800 mb-4">Misalkan seorang siswa memiliki:</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Komponen Nilai:</h4>
                    <ul class="space-y-2">
                        @foreach($komponen as $k)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $k->nama_komponen }} (85):</span>
                            <span class="font-semibold text-blue-600">{{ number_format($k->bobot * 0.85, 2) }} poin</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Penyesuaian:</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Bonus Catatan (5 paraf):</span>
                            <span class="font-semibold text-purple-600">+5 poin</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Pengurangan Alfa (1 kejadian):</span>
                            <span class="font-semibold text-red-600">-2 poin</span>
                        </div>
                        <div class="border-t pt-3 mt-3">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span class="text-gray-800">Nilai Akhir:</span>
                                <span class="text-green-600 text-xl">
                                    {{ number_format($komponen->sum(fn($k) => $k->bobot * 0.85) + 5 - 2, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Edit Komponen Nilai</h3>
            </div>
        </div>
        
        <form id="editForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Komponen</label>
                    <input type="text" name="nama_komponen" id="edit_nama_komponen" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Bobot (%)</label>
                    <input type="number" name="bobot" id="edit_bobot" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        min="0" max="100" required>
                </div>
            </div>
            
            <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
                <button type="submit" 
                    class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-3 rounded-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    Update Komponen
                </button>
                <button type="button" onclick="closeEditModal()" 
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-xl transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function editKomponen(id, nama, bobot) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('edit_nama_komponen').value = nama;
    document.getElementById('edit_bobot').value = bobot;
    document.getElementById('editForm').action = '{{ route("komponen-nilai.update", [$mapel->id, ":id"]) }}'.replace(':id', id);
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
    }
});

// Close modal on background click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection