@extends('layouts.app')

@section('title', 'Input Nilai - Pilih Mata Pelajaran')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Input Nilai Siswa</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Pilih mata pelajaran untuk memulai proses input nilai</p>
                </div>
                <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                    <i class="fas fa-calendar-alt text-green-600"></i>
                    <span class="font-semibold text-green-700 text-sm md:text-base">{{ $tahunAjaranAktif->nama_lengkap }}</span>
                </div>
            </div>
        </div>

        @if($mapel->isEmpty())
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-8 text-center">
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-amber-500 text-2xl"></i>
            </div>
            <h3 class="text-xl md:text-2xl font-bold text-amber-800 mb-3">Belum Ada Mata Pelajaran</h3>
            <p class="text-amber-700 mb-6 max-w-md mx-auto">Silakan tambahkan mata pelajaran terlebih dahulu untuk dapat menginput nilai.</p>
            <a href="{{ route('mata-pelajaran.index') }}" 
               class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-1"></i>
                Kelola Mata Pelajaran
            </a>
        </div>
        @else
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-book text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Mapel</p>
                        <p class="text-lg font-bold text-gray-900">{{ $mapel->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-cog text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Komponen</p>
                        <p class="text-lg font-bold text-gray-900">{{ $mapel->sum(fn($m) => $m->komponenNilai->count()) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Mapel Siap</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $mapel->filter(fn($m) => $m->komponenNilai->sum('bobot') == 100)->count() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-triangle text-orange-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Perlu Perbaikan</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $mapel->filter(fn($m) => $m->komponenNilai->sum('bobot') != 100)->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex-1">
                    <div class="relative max-w-md">
                        <input type="text" 
                               placeholder="Cari mata pelajaran..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                               id="search-input">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Filter:</span>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="filter-select">
                        <option value="all">Semua Mapel</option>
                        <option value="ready">Siap Digunakan</option>
                        <option value="not-ready">Perlu Konfigurasi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid Mata Pelajaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="mapel-grid">
            @foreach($mapel as $m)
            @php
                $totalBobot = $m->komponenNilai->sum('bobot');
                $isReady = $totalBobot == 100;
                $komponenCount = $m->komponenNilai->count();
            @endphp
            <div class="group mapel-card" 
                 data-search="{{ strtolower($m->nama_mapel . ' ' . $m->kode_mapel) }}"
                 data-status="{{ $isReady ? 'ready' : 'not-ready' }}">
                <a href="{{ $isReady ? route('nilai.pilih-kelas', $m->id) : '#' }}" 
                   class="block bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 hover:border-blue-300 overflow-hidden h-full {{ !$isReady ? 'opacity-75 cursor-not-allowed' : '' }}"
                   @if(!$isReady) onclick="event.preventDefault(); showConfigAlert('{{ $m->nama_mapel }}', {{ $totalBobot }});" @endif>
                    <!-- Header -->
                    <div class="bg-gradient-to-r {{ $isReady ? 'from-blue-500 to-indigo-600' : 'from-gray-400 to-gray-500' }} p-5 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-white bg-opacity-10 rounded-full -mr-4 -mt-4"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-bold truncate">{{ $m->nama_mapel }}</h3>
                                <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                    @if($isReady)
                                    <i class="fas fa-play text-white text-sm"></i>
                                    @else
                                    <i class="fas fa-exclamation text-white text-sm"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-blue-100 text-sm">
                                <i class="fas fa-hashtag"></i>
                                <span class="font-mono">{{ $m->kode_mapel }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                        <!-- Status Indicator -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isReady ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                {{ $isReady ? 'Siap Digunakan' : 'Perlu Konfigurasi' }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $komponenCount }} komponen</span>
                        </div>

                        <!-- Komponen Nilai -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="font-medium">Komponen Penilaian:</span>
                            </div>
                            <div class="space-y-2">
                                @foreach($m->komponenNilai->take(2) as $komponen)
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-700 truncate flex-1 mr-2">{{ $komponen->nama_komponen }}</span>
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded font-bold whitespace-nowrap">
                                        {{ $komponen->bobot }}%
                                    </span>
                                </div>
                                @endforeach
                                @if($komponenCount > 2)
                                <div class="text-xs text-gray-500 text-center pt-1">
                                    +{{ $komponenCount - 2 }} komponen lainnya
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Total Bobot</span>
                                <span class="{{ $isReady ? 'text-green-600 font-bold' : 'text-red-600' }}">{{ $totalBobot }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-500 {{ $isReady ? 'bg-green-500' : 'bg-red-400' }}" 
                                     style="width: {{ min($totalBobot, 100) }}%"></div>
                            </div>
                        </div>
                        
                        <!-- CTA -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            @if($isReady)
                            <span class="text-sm text-gray-600 group-hover:text-blue-600 transition-colors font-medium">
                                Pilih Kelas
                            </span>
                            <div class="transform group-hover:translate-x-1 transition-transform">
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500"></i>
                            </div>
                            @else
                            <span class="text-sm text-red-600 font-medium">
                                Konfigurasi Bobot
                            </span>
                            <div>
                                <i class="fas fa-tools text-red-400"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Hover Border -->
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-blue-400 rounded-xl transition-all duration-300 pointer-events-none"></div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- No Results State -->
        <div id="no-results" class="hidden text-center py-12">
            <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-search text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan</h3>
            <p class="text-gray-500">Tidak ada mata pelajaran yang sesuai dengan pencarian Anda.</p>
        </div>

        <!-- Tips Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
            <div class="flex items-start gap-4">
                <div class="bg-blue-100 p-3 rounded-xl flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-blue-900 mb-3 text-lg">Panduan Input Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white rounded-xl p-4 border border-blue-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <span class="font-semibold text-blue-800">Pilih Mapel</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Pilih mata pelajaran yang akan diinput nilainya</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-green-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <span class="font-semibold text-green-800">Pilih Kelas</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Pilih kelas yang akan menerima input nilai</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-purple-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <span class="font-semibold text-purple-800">Input Nilai</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Masukkan nilai siswa sesuai komponen penilaian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const filterSelect = document.getElementById('filter-select');
    const mapelGrid = document.getElementById('mapel-grid');
    const mapelCards = document.querySelectorAll('.mapel-card');
    const noResults = document.getElementById('no-results');

    // Search and filter functionality
    function performSearchAndFilter() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const filterValue = filterSelect ? filterSelect.value : 'all';
        let visibleCount = 0;

        mapelCards.forEach(card => {
            const searchData = card.getAttribute('data-search');
            const status = card.getAttribute('data-status');
            
            const matchesSearch = searchData.includes(searchTerm);
            const matchesFilter = filterValue === 'all' || status === filterValue;
            
            if (matchesSearch && matchesFilter) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
            mapelGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            mapelGrid.classList.remove('hidden');
        }
    }

    // Event listeners
    if (searchInput) {
        searchInput.addEventListener('input', performSearchAndFilter);
    }
    
    if (filterSelect) {
        filterSelect.addEventListener('change', performSearchAndFilter);
    }

    // Initial filter
    performSearchAndFilter();
});

function showConfigAlert(mapelName, totalBobot) {
    const needed = 100 - totalBobot;
    Swal.fire({
        icon: 'warning',
        title: 'Konfigurasi Belum Lengkap',
        html: `
            <div class="text-left">
                <p class="mb-3"><strong>${mapelName}</strong> belum dapat digunakan karena konfigurasi bobot penilaian belum lengkap.</p>
                <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-3">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Total Bobot Saat Ini:</span>
                        <span class="font-bold text-red-600">${totalBobot}%</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Kekurangan:</span>
                        <span class="font-bold text-red-600">${needed}%</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Silakan lengkapi konfigurasi komponen penilaian terlebih dahulu.</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Konfigurasi Sekarang',
        cancelButtonText: 'Tutup',
        confirmButtonColor: '#3b82f6'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('mata-pelajaran.index') }}";
        }
    });
}

// Add animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe each card for animation
document.querySelectorAll('.mapel-card').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    card.style.transitionDelay = `${index * 0.1}s`;
    
    observer.observe(card);
});
</script>

<style>
.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}

/* Custom styles for better mobile experience */
@media (max-width: 768px) {
    .max-w-7xl {
        max-width: 100%;
    }
    
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Adjust card padding for mobile */
    .p-5 {
        padding: 1rem;
    }
}

/* Smooth transitions */
.mapel-card {
    transition: all 0.3s ease-in-out;
}

/* Custom focus styles */
a:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Loading animation for future use */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}
</style>

<!-- Include SweetAlert2 for beautiful alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection