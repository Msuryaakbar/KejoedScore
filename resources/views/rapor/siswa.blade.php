@extends('layouts.app')

@section('title', 'Rapor ' . $siswa->nama)

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-4">
                <a href="{{ route('rapor.kelas', $siswa->kelas_id) }}" 
                   class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-fit">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Daftar Siswa</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
                <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Rapor Siswa</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">
                        <span class="font-semibold">{{ $siswa->nama }}</span> - 
                        {{ $siswa->kelas->nama_kelas }} - 
                        {{ $tahunAjaranAktif->nama_lengkap }}
                    </p>
                </div>
            </div>

            <!-- Student Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nama Siswa</p>
                            <p class="text-lg font-bold text-gray-900">{{ $siswa->nama }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-id-card text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">NIS</p>
                            <p class="text-lg font-bold text-gray-900">{{ $siswa->nis }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-school text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Kelas</p>
                            <p class="text-lg font-bold text-gray-900">{{ $siswa->kelas->nama_kelas }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <a href="{{ route('rapor.kelas', $siswa->kelas_id) }}" 
               class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali
            </a>
            <a href="{{ route('rapor.print', $siswa->id) }}" target="_blank"
               class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <i class="fas fa-print mr-1"></i>
                Print/PDF
            </a>
            
            <!-- Tombol Print Dongkrak - HANYA untuk Admin & Guru -->
            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
            <a href="{{ route('rapor.print-dongkrak', $siswa->id) }}" 
                class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                target="_blank">
                <i class="fas fa-chart-line mr-1"></i>
                Print Performen
            </a>
            @endif
        </div>

        <!-- Ringkasan Nilai -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="text-center">
                    <div class="text-lg md:text-2xl font-bold text-blue-600 mb-2">{{ $jumlahMapel }}</div>
                    <div class="text-xs md:text-sm text-gray-600">Mata Pelajaran</div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="text-center">
                    <div class="text-lg md:text-2xl font-bold text-green-600 mb-2">{{ number_format($rataRata, 2) }}</div>
                    <div class="text-xs md:text-sm text-gray-600">Rata-rata</div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="text-center">
                    <div class="text-lg md:text-2xl font-bold text-purple-600 mb-2">{{ $ranking ?? '-' }}</div>
                    <div class="text-xs md:text-sm text-gray-600">Ranking</div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="text-center">
                    @php
                        if ($rataRata >= 90) $pred = 'A';
                        elseif ($rataRata >= 80) $pred = 'B';
                        elseif ($rataRata >= 70) $pred = 'C';
                        elseif ($rataRata >= 60) $pred = 'D';
                        else $pred = 'E';
                    @endphp
                    <div class="text-lg md:text-2xl font-bold text-orange-600 mb-2">{{ $pred }}</div>
                    <div class="text-xs md:text-sm text-gray-600">Predikat</div>
                </div>
            </div>
        </div>

        <!-- Tabel Nilai Per Mapel -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-4 md:px-6 py-4 border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <h3 class="text-lg font-bold text-gray-900">Nilai Mata Pelajaran</h3>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">{{ count($nilaiPerMapel) }}</span> mata pelajaran
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 md:px-4 py-4 text-center border-b border-r bg-white sticky left-0 min-w-[50px] md:min-w-[60px]">
                                No
                            </th>
                            <th class="px-3 md:px-4 py-4 text-left border-b border-r bg-white sticky left-[50px] md:left-[60px] min-w-[150px] md:min-w-[200px]">
                                Mata Pelajaran
                            </th>
                            <th class="px-2 md:px-3 py-4 text-center border-b border-r bg-purple-50 min-w-[80px]">
                                <div class="flex flex-col items-center">
                                    <span class="font-semibold text-purple-800 text-xs md:text-sm">Catatan</span>
                                    <span class="text-xs text-purple-600">(Bonus)</span>
                                </div>
                            </th>
                            <th class="px-2 md:px-3 py-4 text-center border-b border-r bg-blue-50 min-w-[120px] md:min-w-[150px]">
                                <div class="font-semibold text-blue-800 text-xs md:text-sm">Komponen Nilai</div>
                            </th>
                            <th class="px-2 md:px-3 py-4 text-center border-b border-r bg-green-50 min-w-[100px] md:min-w-[120px]">
                                <div class="font-semibold text-green-800 text-xs md:text-sm">Kehadiran</div>
                            </th>
                            <th class="px-3 md:px-4 py-4 text-center border-b border-r bg-yellow-50 min-w-[80px] md:min-w-[100px]">
                                <div class="font-bold text-gray-800 text-xs md:text-sm">Nilai Akhir</div>
                            </th>
                            <th class="px-3 md:px-4 py-4 text-center border-b bg-indigo-50 min-w-[70px] md:min-w-[90px]">
                                <div class="font-semibold text-indigo-800 text-xs md:text-sm">Predikat</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($nilaiPerMapel as $data)
                        @php
                            $nilai = $data['nilai'];
                            $mapel = $data['mapel'];
                            $nilaiAkhir = $data['nilai_akhir'];
                            
                            if ($nilaiAkhir >= 90) {
                                $predikat = 'A';
                                $colorClass = 'bg-green-100 text-green-800 border-green-200';
                                $keterangan = 'Sangat Baik';
                            } elseif ($nilaiAkhir >= 80) {
                                $predikat = 'B';
                                $colorClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                $keterangan = 'Baik';
                            } elseif ($nilaiAkhir >= 70) {
                                $predikat = 'C';
                                $colorClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                $keterangan = 'Cukup';
                            } elseif ($nilaiAkhir >= 60) {
                                $predikat = 'D';
                                $colorClass = 'bg-orange-100 text-orange-800 border-orange-200';
                                $keterangan = 'Kurang';
                            } else {
                                $predikat = 'E';
                                $colorClass = 'bg-red-100 text-red-800 border-red-200';
                                $keterangan = 'Sangat Kurang';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- No -->
                            <td class="px-3 md:px-4 py-4 text-center border-r bg-white sticky left-0 font-semibold text-gray-700">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-xs">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            
                            <!-- Mata Pelajaran -->
                            <td class="px-3 md:px-4 py-4 border-r bg-white sticky left-[50px] md:left-[60px]">
                                <div class="font-semibold text-gray-900 text-sm md:text-base">{{ $mapel->nama_mapel }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $mapel->kode_mapel }}</div>
                            </td>
                            
                            <!-- Catatan -->
                            <td class="px-2 md:px-3 py-4 text-center border-r bg-purple-50/50">
                                <div class="flex flex-col items-center">
                                    <span class="font-bold text-purple-600 text-base md:text-lg">{{ $nilai->total_catatan }}</span>
                                    <span class="text-xs text-purple-600">paraf</span>
                                    <span class="text-xs text-green-600 font-semibold">+{{ min($nilai->total_catatan, 10) }}</span>
                                </div>
                            </td>
                            
                            <!-- Komponen Nilai -->
                            <td class="px-2 md:px-3 py-4 border-r bg-blue-50/50">
                                <div class="space-y-1">
                                    @if($nilai->nilai_komponen)
                                        @foreach($mapel->komponenNilai as $komp)
                                            @if(isset($nilai->nilai_komponen[$komp->id]))
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-gray-600 truncate">{{ $komp->nama_komponen }}</span>
                                                <span class="font-semibold text-gray-800 bg-white px-2 py-1 rounded text-xs">
                                                    {{ number_format($nilai->nilai_komponen[$komp->id], 1) }}
                                                </span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Kehadiran -->
                            <td class="px-2 md:px-3 py-4 text-center border-r bg-green-50/50">
                                <div class="space-y-1 text-xs">
                                    <div class="text-green-600 font-semibold">✓ {{ $nilai->hadir }}</div>
                                    <div class="flex gap-1 md:gap-2 justify-center text-xs">
                                        <span class="text-blue-600">I:{{ $nilai->izin }}</span>
                                        <span class="text-cyan-600">S:{{ $nilai->sakit }}</span>
                                    </div>
                                    @if($nilai->alfa > 0)
                                    <div class="text-red-600 font-bold bg-red-50 px-1 md:px-2 py-1 rounded text-xs">
                                        A:{{ $nilai->alfa }} (-{{ $nilai->alfa * 2 }})
                                    </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Nilai Akhir -->
                            <td class="px-3 md:px-4 py-4 text-center border-r bg-yellow-50/50">
                                <div class="text-lg md:text-xl font-bold {{ $nilaiAkhir >= 75 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ number_format($nilaiAkhir, 2) }}
                                </div>
                            </td>
                            
                            <!-- Predikat -->
                            <td class="px-3 md:px-4 py-4 text-center bg-indigo-50/50">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="inline-block px-2 md:px-3 py-1 md:py-2 rounded-lg text-xs md:text-sm font-bold border {{ $colorClass }}">
                                        {{ $predikat }}
                                    </span>
                                    <span class="text-xs text-gray-600 hidden md:block">{{ $keterangan }}</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i class="fas fa-clipboard-list text-4xl"></i>
                                    <p class="font-semibold text-lg">Belum ada data nilai</p>
                                    <p class="text-sm">Data nilai untuk siswa ini belum tersedia</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        
                        @if(count($nilaiPerMapel) > 0)
                        <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 font-bold border-t-2 border-blue-200">
                            <td colspan="5" class="px-4 md:px-6 py-4 text-right text-gray-700 border-r text-sm md:text-base">
                                RATA-RATA KESELURUHAN:
                            </td>
                            <td class="px-3 md:px-4 py-4 text-center border-r">
                                <span class="text-lg md:text-xl text-blue-600">{{ number_format($rataRata, 2) }}</span>
                            </td>
                            <td class="px-3 md:px-4 py-4 text-center">
                                <span class="inline-block px-2 md:px-3 py-1 md:py-2 rounded-lg text-sm font-bold border {{ $rataRata >= 75 ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' }}">
                                    {{ $pred }}
                                </span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Catatan Tambahan -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 md:p-6 border border-indigo-200">
            <div class="flex items-start gap-4">
                <div class="bg-indigo-100 p-3 rounded-xl flex-shrink-0">
                    <i class="fas fa-info-circle text-indigo-600 text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-indigo-900 mb-3 text-lg">Keterangan Rapor</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 text-sm">
                        <div>
                            <h4 class="font-semibold text-indigo-800 mb-2">Sistem Penilaian:</h4>
                            <ul class="space-y-2 text-gray-700 text-xs md:text-sm">
                                <li class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>Nilai Komponen: Total 100% per mata pelajaran</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                    <span>Bonus Catatan: +1 poin per paraf (maksimal +10)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span>Pengurang Alfa: -2 poin per kejadian</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-indigo-800 mb-2">Rentang Predikat:</h4>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="bg-green-100 text-green-800 px-2 md:px-3 py-2 rounded-lg text-center">
                                    <div class="font-bold">A: 90-100</div>
                                    <div class="text-xs">Sangat Baik</div>
                                </div>
                                <div class="bg-blue-100 text-blue-800 px-2 md:px-3 py-2 rounded-lg text-center">
                                    <div class="font-bold">B: 80-89</div>
                                    <div class="text-xs">Baik</div>
                                </div>
                                <div class="bg-yellow-100 text-yellow-800 px-2 md:px-3 py-2 rounded-lg text-center">
                                    <div class="font-bold">C: 70-79</div>
                                    <div class="text-xs">Cukup</div>
                                </div>
                                <div class="bg-orange-100 text-orange-800 px-2 md:px-3 py-2 rounded-lg text-center">
                                    <div class="font-bold">D: 60-69</div>
                                    <div class="text-xs">Kurang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.sticky {
    position: sticky;
    background: inherit;
    z-index: 10;
}

.overflow-x-auto {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Print Styles */
@media print {
    .no-print, button, a:not(.print-link) { 
        display: none !important; 
    }
    body { 
        background: white !important; 
        font-size: 12pt;
    }
    .max-w-full {
        max-width: none !important;
    }
    table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    .bg-gradient-to-r {
        background: #f3f4f6 !important;
    }
    .sticky {
        position: relative !important;
    }
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .max-w-full {
        max-width: 100%;
    }
    
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Adjust table font sizes for mobile */
    table {
        font-size: 0.7rem;
    }
    
    .text-xs {
        font-size: 0.65rem;
    }
    
    .sticky.left-\[50px\] {
        left: 50px;
    }
}

/* Smooth transitions */
tr {
    transition: background-color 0.2s ease-in-out;
}

/* Custom focus styles */
a:focus, button:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}
</style>

<script>
// Enhanced print functionality
document.addEventListener('DOMContentLoaded', function() {
    const printButtons = document.querySelectorAll('a[target="_blank"]');
    printButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state for print buttons
            if (this.href.includes('print')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Loading...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            }
        });
    });
    
    // Add row highlighting on hover
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8fafc';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endsection