@extends('layouts.app')

@section('title', 'Komponen Nilai - ' . $mapel->nama_mapel)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">⚙️ Komponen Nilai - {{ $mapel->nama_mapel }}</h2>
    <a href="{{ route('mata-pelajaran.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali ke Mata Pelajaran</a>
</div>

<!-- Info Total Bobot -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-600">Total Bobot Komponen</p>
            @php
                $totalBobot = $komponen->sum('bobot');
            @endphp
            <p class="text-3xl font-bold {{ $totalBobot == 100 ? 'text-green-600' : 'text-red-600' }}">
                {{ $totalBobot }}%
            </p>
        </div>
        <div class="text-right">
            @if($totalBobot == 100)
                <div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold block mb-2">
                        ✓ Bobot Sudah Tepat 100%
                    </span>
                    <div class="text-xs text-gray-600 space-y-1 bg-blue-50 p-2 rounded">
                        <p class="font-semibold text-blue-800">Formula Nilai Akhir:</p>
                        <p>Komponen (100%) + Bonus Catatan (max +10) - Alfa (-2/kejadian)</p>
                    </div>
                </div>
            @else
                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full font-semibold">
                    ⚠️ Bobot Harus 100%
                </span>
            @endif
        </div>
    </div>
</div>

<!-- Penjelasan Sistem -->
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
    <h3 class="font-bold text-blue-900 mb-2">📌 Cara Kerja Penilaian:</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
        <div class="bg-white rounded p-3">
            <p class="font-semibold text-blue-800 mb-1">1️⃣ Komponen Nilai (100%)</p>
            <p class="text-gray-700">Tentukan komponen penilaian dengan total bobot <span class="font-bold">100%</span></p>
            <p class="text-xs text-gray-500 mt-1">Contoh: Tugas 20%, UTS 30%, UAS 50%</p>
        </div>
        <div class="bg-white rounded p-3">
            <p class="font-semibold text-purple-800 mb-1">2️⃣ Bonus Catatan/Paraf</p>
            <p class="text-gray-700">Setiap paraf = <span class="font-bold">+1 poin</span> bonus (maksimal +10)</p>
            <p class="text-xs text-gray-500 mt-1">Tidak masuk bobot 100%, murni bonus</p>
        </div>
        <div class="bg-white rounded p-3">
            <p class="font-semibold text-red-800 mb-1">3️⃣ Pengurang Alfa</p>
            <p class="text-gray-700">Setiap alfa = <span class="font-bold">-2 poin</span></p>
            <p class="text-xs text-gray-500 mt-1">Mengurangi dari nilai akhir</p>
        </div>
    </div>
</div>

<!-- Form Tambah Komponen -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="font-bold text-lg mb-4">➕ Tambah Komponen Baru</h3>
    <form action="{{ route('komponen-nilai.store', $mapel->id) }}" method="POST" class="flex gap-3">
        @csrf
        <div class="flex-1">
            <input type="text" name="nama_komponen" class="w-full border rounded px-3 py-2" 
                placeholder="Nama Komponen (misal: Tugas, UTS, UAS, Praktik, Quiz)" required>
        </div>
        <div class="w-32">
            <input type="number" name="bobot" class="w-full border rounded px-3 py-2" 
                placeholder="Bobot %" min="0" max="100" required>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
            + Tambah
        </button>
    </form>
    <p class="text-xs text-gray-500 mt-2">
        💡 <span class="font-semibold">Tips:</span> Total semua bobot komponen harus <span class="font-bold">100%</span>. 
        Sisakan ruang untuk penyesuaian sebelum mencapai 100%.
    </p>
</div>

<!-- Tabel Komponen -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Komponen</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Bobot (%)</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kontribusi Nilai</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($komponen as $index => $k)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">
                    <span class="font-semibold text-gray-900">{{ $k->nama_komponen }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-bold text-lg">
                        {{ $k->bobot }}%
                    </span>
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">
                    <div>Jika nilai 100 → {{ $k->bobot }} poin</div>
                    <div class="text-xs text-gray-500">Jika nilai 80 → {{ $k->bobot * 0.8 }} poin</div>
                </td>
                <td class="px-6 py-4 text-center">
                    <button onclick="editKomponen({{ $k->id }}, '{{ $k->nama_komponen }}', {{ $k->bobot }})" 
                        class="text-blue-600 hover:underline mr-3 font-semibold">
                        Edit
                    </button>
                    <form action="{{ route('komponen-nilai.destroy', [$mapel->id, $k->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline font-semibold" 
                            onclick="return confirm('Yakin hapus komponen {{ $k->nama_komponen }}?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="font-semibold">Belum ada komponen nilai</p>
                        <p class="text-sm">Tambahkan komponen penilaian menggunakan form di atas</p>
                    </div>
                </td>
            </tr>
            @endforelse
            
            @if($komponen->count() > 0)
            <tr class="bg-blue-50 font-bold">
                <td colspan="2" class="px-6 py-4 text-right">TOTAL BOBOT:</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-4 py-2 {{ $totalBobot == 100 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} rounded-full text-xl">
                        {{ $totalBobot }}%
                    </span>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    @if($totalBobot == 100)
                        <span class="text-green-600">✓ Siap digunakan</span>
                    @elseif($totalBobot < 100)
                        <span class="text-orange-600">Kurang {{ 100 - $totalBobot }}%</span>
                    @else
                        <span class="text-red-600">Kelebihan {{ $totalBobot - 100 }}%</span>
                    @endif
                </td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Example -->
@if($komponen->count() > 0)
<div class="mt-6 bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-lg p-4">
    <h3 class="font-bold text-purple-900 mb-3">📊 Contoh Perhitungan Nilai Akhir:</h3>
    <div class="bg-white rounded-lg p-4 text-sm">
        <p class="font-semibold mb-2">Misalkan seorang siswa memiliki:</p>
        <ul class="space-y-1 ml-4 mb-3">
            @foreach($komponen as $k)
            <li>• {{ $k->nama_komponen }}: <span class="font-bold">85</span> → {{ $k->bobot }}% × 85 = <span class="text-blue-600 font-bold">{{ number_format($k->bobot * 0.85, 2) }}</span> poin</li>
            @endforeach
        </ul>
        <div class="border-t pt-2 space-y-1">
            <p>Total Komponen: <span class="font-bold text-blue-600">{{ number_format($komponen->sum(fn($k) => $k->bobot * 0.85), 2) }}</span> poin</p>
            <p>Bonus Catatan: 5 paraf = <span class="font-bold text-purple-600">+5</span> poin</p>
            <p>Pengurangan Alfa: 1 kejadian = <span class="font-bold text-red-600">-2</span> poin</p>
            <p class="text-lg font-bold text-green-600 pt-2 border-t">
                Nilai Akhir: {{ number_format($komponen->sum(fn($k) => $k->bobot * 0.85) + 5 - 2, 2) }}
            </p>
        </div>
    </div>
</div>
@endif

<!-- Modal Edit (Hidden) -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="font-bold text-lg mb-4">✏️ Edit Komponen Nilai</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Komponen</label>
                <input type="text" name="nama_komponen" id="edit_nama_komponen" 
                    class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Bobot (%)</label>
                <input type="number" name="bobot" id="edit_bobot" 
                    class="w-full border rounded px-3 py-2" min="0" max="100" required>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                    💾 Update
                </button>
                <button type="button" onclick="closeEditModal()" 
                    class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded font-semibold">
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