@extends('layouts.app')

@section('title', 'Rapor Siswa')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Rapor Siswa</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Lihat rapor lengkap seluruh mata pelajaran per siswa</p>
                </div>
                @if($tahunAjaranAktif)
                <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                    <i class="fas fa-calendar-alt text-green-600"></i>
                    <span class="font-semibold text-green-700 text-sm md:text-base">{{ $tahunAjaranAktif->nama_lengkap }}</span>
                </div>
                @endif
            </div>
        </div>

        @if(!isset($kelas) || $kelas->isEmpty())
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-8 text-center max-w-2xl mx-auto">
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-amber-500 text-2xl"></i>
            </div>
            <h3 class="text-xl md:text-2xl font-bold text-amber-800 mb-3">Belum Ada Data Kelas</h3>
            <p class="text-amber-700 mb-2 text-sm md:text-base">Anda perlu menambahkan kelas terlebih dahulu sebelum dapat melihat rapor siswa.</p>
            <p class="text-amber-600 text-xs md:text-sm mb-6">Setelah kelas dibuat dan data nilai diinput, rapor siswa akan tersedia di sini.</p>
            <a href="{{ route('kelas.index') }}" 
               class="inline-flex items-center gap-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-1"></i>
                Kelola Data Kelas
            </a>
        </div>
        @else
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-school text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Kelas</p>
                        <p class="text-lg font-bold text-gray-900">{{ $kelas->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-users text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                        <p class="text-lg font-bold text-gray-900">{{ $kelas->sum('siswa_count') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-book text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Mapel</p>
                        <p class="text-lg font-bold text-gray-900">{{ $kelas->sum('mapel_count') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Status</p>
                        <p class="text-lg font-bold text-green-600">Aktif</p>
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
                               placeholder="Cari kelas..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                               id="search-input">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Filter:</span>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="filter-select">
                        <option value="all">Semua Kelas</option>
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid Kelas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8" id="kelas-grid">
            @foreach($kelas as $k)
                @if($k && isset($k->id) && isset($k->nama_kelas))
                <div class="group relative kelas-card" 
                     data-search="{{ strtolower($k->nama_kelas) }}"
                     data-tingkat="{{ $k->tingkat ?? '' }}">
                    <a href="{{ route('rapor.kelas', $k->id) }}" 
                       class="block bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 hover:border-indigo-300 overflow-hidden h-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <!-- Header dengan Gradient -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 md:p-5 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-16 h-16 bg-white bg-opacity-10 rounded-full -mr-4 -mt-4"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-2 md:mb-3">
                                    <h3 class="text-lg md:text-xl font-bold truncate">{{ $k->nama_kelas }}</h3>
                                    <div class="bg-white bg-opacity-20 p-2 rounded-lg transform group-hover:scale-110 transition-transform">
                                        <i class="fas fa-file-alt text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 text-indigo-100 text-xs md:text-sm">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Kelas {{ $k->tingkat ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4 md:p-5">
                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-2 md:gap-3 mb-3 md:mb-4">
                                <div class="text-center bg-indigo-50 rounded-lg p-2">
                                    <div class="text-base md:text-lg font-bold text-indigo-600">{{ $k->siswa_count ?? 0 }}</div>
                                    <div class="text-xs text-indigo-500 font-medium">Siswa</div>
                                </div>
                                <div class="text-center bg-green-50 rounded-lg p-2">
                                    <div class="text-base md:text-lg font-bold text-green-600">{{ $k->mapel_count ?? 0 }}</div>
                                    <div class="text-xs text-green-500 font-medium">Mapel</div>
                                </div>
                            </div>
                            
                            <!-- Status Rapor -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-medium text-gray-500">Status:</span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check text-xs"></i>
                                    Tersedia
                                </span>
                            </div>
                            
                            <!-- Progress (optional) -->
                            <div class="mb-3">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Kelengkapan Data</span>
                                    <span>100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            
                            <!-- CTA -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <span class="text-sm text-gray-500 group-hover:text-indigo-600 transition-colors font-medium">
                                    Lihat Rapor
                                </span>
                                <div class="transform group-hover:translate-x-1 transition-transform">
                                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-indigo-500 text-xs"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hover Effect -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-indigo-400 rounded-xl transition-all duration-300 pointer-events-none"></div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>

        <!-- No Results State -->
        <div id="no-results" class="hidden text-center py-12">
            <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-search text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan</h3>
            <p class="text-gray-500">Tidak ada kelas yang sesuai dengan pencarian Anda.</p>
        </div>

        <!-- Info Section -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-200">
            <div class="flex items-start gap-4">
                <div class="bg-indigo-100 p-3 rounded-xl flex-shrink-0">
                    <i class="fas fa-info-circle text-indigo-600 text-lg"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-indigo-900 mb-3 text-lg">Informasi Rapor Siswa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white rounded-xl p-4 border border-indigo-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-book"></i>
                                </div>
                                <span class="font-semibold text-indigo-800">Semua Mapel</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Lihat nilai semua mata pelajaran dalam satu rapor lengkap</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-green-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <span class="font-semibold text-green-800">Analisis Komprehensif</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Dapatkan gambaran lengkap perkembangan belajar siswa</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-blue-100">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-print"></i>
                                </div>
                                <span class="font-semibold text-blue-800">Cetak Rapor</span>
                            </div>
                            <p class="text-gray-600 text-xs leading-relaxed">Fitur print untuk dokumen rapor resmi yang rapi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
            <h3 class="font-bold text-gray-900 mb-4 text-lg">Aksi Cepat</h3>
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Opsi 1: Redirect ke mata pelajaran -->
                <a href="{{ route('mata-pelajaran.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-edit mr-1"></i>
                    Input Nilai
                </a>
                <a href="{{ route('kelas.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i class="fas fa-school mr-1"></i>
                    Kelola Kelas
                </a>
                <a href="{{ route('mata-pelajaran.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    <i class="fas fa-book mr-1"></i>
                    Mata Pelajaran
                </a>
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
    const kelasGrid = document.getElementById('kelas-grid');
    const kelasCards = document.querySelectorAll('.kelas-card');
    const noResults = document.getElementById('no-results');

    // Search and filter functionality
    function performSearchAndFilter() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const filterValue = filterSelect ? filterSelect.value : 'all';
        let visibleCount = 0;

        kelasCards.forEach(card => {
            const searchData = card.getAttribute('data-search');
            const tingkat = card.getAttribute('data-tingkat');
            
            const matchesSearch = searchData.includes(searchTerm);
            const matchesFilter = filterValue === 'all' || tingkat === filterValue;
            
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
            kelasGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            kelasGrid.classList.remove('hidden');
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
    kelasCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        card.style.transitionDelay = `${index * 0.1}s`;
        
        observer.observe(card);
    });
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
    .p-4 {
        padding: 1rem;
    }
    
    .p-5 {
        padding: 1.25rem;
    }
}

/* Smooth transitions */
.kelas-card {
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

/* Ensure consistent card heights */
.h-full {
    height: 100%;
}
</style>
@endsection