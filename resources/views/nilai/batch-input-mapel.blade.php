@extends('layouts.app')

@section('title', 'Input Nilai - ' . $mapel->nama_mapel . ' - ' . $kelas->nama_kelas)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('nilai.pilih-kelas', $mapel->id) }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Input Nilai Siswa</h1>
                
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg border border-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-semibold text-blue-700">{{ $mapel->nama_mapel }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="font-semibold text-green-700">{{ $kelas->nama_kelas }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-lg border border-purple-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-semibold text-purple-700">{{ $tahunAjaranAktif->nama_lengkap }}</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-600 text-white px-6 py-4 rounded-xl">
                    <div class="text-2xl font-bold">{{ $siswa->count() }}</div>
                    <div class="text-blue-100 text-sm">Total Siswa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Komponen Info -->
    <div class="bg-white rounded-xl shadow border p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-lg flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Komponen Penilaian</h3>
                
                <div class="flex flex-wrap gap-3 mb-4">
                    @foreach($mapel->komponenNilai as $komponen)
                    <div class="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-lg border border-blue-200">
                        <span class="font-medium text-blue-800">{{ $komponen->nama_komponen }}</span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-bold">
                            {{ $komponen->bobot }}%
                        </span>
                    </div>
                    @endforeach
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4 border">
                    <h4 class="font-bold text-gray-900 mb-2">Sistem Penilaian</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span class="font-medium text-gray-700">Bonus Paraf:</span>
                            <span class="text-gray-600">+1 poin/paraf (max +10)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="font-medium text-gray-700">Pengurangan Alfa:</span>
                            <span class="text-gray-600">-2 poin/kejadian</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Input Nilai -->
    <form action="{{ route('nilai.batch.update-mapel', [$mapel->id, $kelas->id]) }}" method="POST" id="formNilai">
        @csrf
        
        <div class="bg-white rounded-xl shadow border overflow-hidden mb-6">
            <!-- Table Header -->
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Data Nilai Siswa</h3>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">{{ $siswa->count() }}</span> siswa
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <!-- Fixed Columns -->
                            <th rowspan="2" class="px-4 py-3 text-center font-semibold text-gray-700 border-b border-r bg-white sticky left-0 z-20 min-w-[60px]">
                                No
                            </th>
                            <th rowspan="2" class="px-4 py-3 text-left font-semibold text-gray-700 border-b border-r bg-white sticky left-[60px] z-20 min-w-[200px]">
                                Nama Siswa
                            </th>
                            <th rowspan="2" class="px-4 py-3 text-center font-semibold text-gray-700 border-b border-r bg-white min-w-[120px]">
                                NIS
                            </th>
                            
                            <!-- Catatan/Paraf -->
                            <th colspan="10" class="px-4 py-2 text-center font-semibold border-b border-r bg-purple-50">
                                <div class="text-purple-700">Catatan/Paraf</div>
                            </th>
                            
                            <!-- Komponen Nilai -->
                            @foreach($mapel->komponenNilai as $komponen)
                            <th rowspan="2" class="px-4 py-3 text-center font-semibold border-b border-r bg-blue-50 min-w-[100px]">
                                <div class="text-blue-700">{{ $komponen->nama_komponen }}</div>
                                <div class="text-xs text-blue-600 font-normal mt-1">{{ $komponen->bobot }}%</div>
                            </th>
                            @endforeach
                            
                            <!-- Kehadiran -->
                            <th colspan="4" class="px-4 py-2 text-center font-semibold border-b bg-green-50">
                                <div class="text-green-700">Kehadiran</div>
                            </th>
                        </tr>
                        <tr>
                            <!-- Catatan Sub-headers -->
                            @for($i = 1; $i <= 10; $i++)
                            <th class="px-2 py-2 text-center text-xs font-semibold text-purple-700 border-b border-r bg-purple-100">
                                C{{ $i }}
                            </th>
                            @endfor
                            
                            <!-- Kehadiran Sub-headers -->
                            <th class="px-3 py-2 text-center text-xs font-semibold text-green-700 border-b border-r bg-green-100 min-w-[80px]">
                                Hadir
                            </th>
                            <th class="px-3 py-2 text-center text-xs font-semibold text-yellow-700 border-b border-r bg-yellow-100 min-w-[80px]">
                                Izin
                            </th>
                            <th class="px-3 py-2 text-center text-xs font-semibold text-cyan-700 border-b border-r bg-cyan-100 min-w-[80px]">
                                Sakit
                            </th>
                            <th class="px-3 py-2 text-center text-xs font-semibold text-red-700 border-b bg-red-100 min-w-[80px]">
                                Alfa
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($siswa as $index => $s)
                        @php
                            $nilaiSiswa = $s->nilai_mapel;
                            
                            // Handle catatan
                            $catatan = [];
                            if ($nilaiSiswa && $nilaiSiswa->catatan) {
                                if (is_string($nilaiSiswa->catatan)) {
                                    $decoded = json_decode($nilaiSiswa->catatan, true);
                                    $catatan = is_array($decoded) ? $decoded : [];
                                } elseif (is_array($nilaiSiswa->catatan)) {
                                    $catatan = $nilaiSiswa->catatan;
                                }
                            }
                            
                            // Handle nilai_komponen
                            $nilaiKomponen = [];
                            if ($nilaiSiswa && $nilaiSiswa->nilai_komponen) {
                                if (is_string($nilaiSiswa->nilai_komponen)) {
                                    $decoded = json_decode($nilaiSiswa->nilai_komponen, true);
                                    $nilaiKomponen = is_array($decoded) ? $decoded : [];
                                } elseif (is_array($nilaiSiswa->nilai_komponen)) {
                                    $nilaiKomponen = $nilaiSiswa->nilai_komponen;
                                }
                            }
                        @endphp
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <!-- Fixed Columns -->
                            <td class="px-4 py-3 text-center border-r bg-white sticky left-0 z-10 font-medium text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 py-3 border-r bg-white sticky left-[60px] z-10 font-medium text-gray-900">
                                {{ $s->nama }}
                            </td>
                            <td class="px-4 py-3 text-center border-r bg-white text-gray-600">
                                {{ $s->nis }}
                            </td>
                            
                            <!-- Catatan Checkboxes -->
                            @for($i = 1; $i <= 10; $i++)
                            <td class="px-2 py-3 text-center border-r bg-purple-50/50">
                                <input type="checkbox" 
                                    name="siswa[{{ $s->id }}][catatan][]" 
                                    value="Catatan {{ $i }}"
                                    {{ in_array("Catatan {$i}", $catatan) ? 'checked' : '' }}
                                    class="w-5 h-5 text-purple-600 rounded border-gray-300 focus:ring-2 focus:ring-purple-500 cursor-pointer transition-transform hover:scale-110">
                            </td>
                            @endfor
                            
                            <!-- Nilai Komponen -->
                            @foreach($mapel->komponenNilai as $komponen)
                            <td class="px-2 py-3 border-r bg-blue-50/50">
                                <input type="number" 
                                    name="siswa[{{ $s->id }}][nilai_komponen][{{ $komponen->id }}]" 
                                    value="{{ $nilaiKomponen[$komponen->id] ?? 0 }}"
                                    min="0" 
                                    max="100" 
                                    step="0.01"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    required>
                            </td>
                            @endforeach
                            
                            <!-- Kehadiran -->
                            <td class="px-2 py-3 border-r bg-green-50/50">
                                <input type="number" 
                                    name="siswa[{{ $s->id }}][hadir]" 
                                    value="{{ $nilaiSiswa->hadir ?? 0 }}"
                                    min="0" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all" 
                                    required>
                            </td>
                            <td class="px-2 py-3 border-r bg-yellow-50/50">
                                <input type="number" 
                                    name="siswa[{{ $s->id }}][izin]" 
                                    value="{{ $nilaiSiswa->izin ?? 0 }}"
                                    min="0" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all" 
                                    required>
                            </td>
                            <td class="px-2 py-3 border-r bg-cyan-50/50">
                                <input type="number" 
                                    name="siswa[{{ $s->id }}][sakit]" 
                                    value="{{ $nilaiSiswa->sakit ?? 0 }}"
                                    min="0" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all" 
                                    required>
                            </td>
                            <td class="px-2 py-3 bg-red-50/50">
                                <input type="number" 
                                    name="siswa[{{ $s->id }}][alfa]" 
                                    value="{{ $nilaiSiswa->alfa ?? 0 }}"
                                    min="0" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all" 
                                    required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white rounded-xl shadow border p-6">
            <div class="text-sm text-gray-600">
                Pastikan semua data telah diisi dengan benar sebelum menyimpan.
            </div>
            <div class="flex gap-3">
                <a href="{{ route('nilai.pilih-kelas', $mapel->id) }}" 
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg shadow-sm transition-all hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Nilai ({{ $siswa->count() }} Siswa)
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// Form submission confirmation
document.getElementById('formNilai').addEventListener('submit', function(e) {
    if (!confirm('Yakin ingin menyimpan semua nilai untuk {{ $siswa->count() }} siswa?')) {
        e.preventDefault();
    }
});

// Keyboard navigation - Enter to move to next input
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.tagName === 'INPUT' && e.target.type === 'number') {
        e.preventDefault();
        const inputs = Array.from(document.querySelectorAll('input[type="number"]'));
        const currentIndex = inputs.indexOf(e.target);
        if (currentIndex > -1 && currentIndex < inputs.length - 1) {
            inputs[currentIndex + 1].focus();
            inputs[currentIndex + 1].select();
        }
    }
});

// Highlight current row on input focus
document.querySelectorAll('tbody tr').forEach(row => {
    const inputs = row.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            row.style.backgroundColor = 'rgb(239 246 255)'; // blue-50
        });
        input.addEventListener('blur', () => {
            row.style.backgroundColor = '';
        });
    });
});
</script>

<style>
/* Sticky positioning */
.sticky {
    position: sticky;
}

/* Ensure sticky columns stay on top */
thead th.sticky {
    z-index: 20;
}

tbody td.sticky {
    z-index: 10;
}

/* Custom scrollbar */
.overflow-x-auto {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Smooth transitions */
input:focus {
    transform: scale(1.02);
}

/* Mobile responsive */
@media (max-width: 640px) {
    .sticky.left-\[60px\] {
        left: 50px;
        min-width: 150px;
    }
}
</style>
@endsection