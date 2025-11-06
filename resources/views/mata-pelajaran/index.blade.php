@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 md:mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Mata Pelajaran</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Kelola mata pelajaran dan komponen penilaian</p>
            </div>
            <a href="{{ route('mata-pelajaran.create') }}" 
               class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Mata Pelajaran</span>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-book text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Mata Pelajaran</p>
                        <p class="text-lg font-bold text-gray-900">{{ $mataPelajaran->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-cog text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Komponen</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $mataPelajaran->sum('komponen_nilai_count') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-pie text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Rata-rata Komponen</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $mataPelajaran->count() > 0 ? round($mataPelajaran->avg('komponen_nilai_count'), 1) : 0 }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if($mataPelajaran->isEmpty())
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-8 text-center">
            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book-open text-yellow-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-yellow-800 mb-2">Belum ada mata pelajaran!</h3>
            <p class="text-yellow-700 mb-6 max-w-md mx-auto">Mulai dengan menambahkan mata pelajaran pertama Anda untuk mengelola komponen penilaian.</p>
            <a href="{{ route('mata-pelajaran.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-2"></i>
                Tambah Mata Pelajaran Pertama
            </a>
        </div>
        @else
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
                    <span class="text-sm text-gray-600 whitespace-nowrap">Urutkan:</span>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="sort-select">
                        <option value="nama">Nama A-Z</option>
                        <option value="nama-desc">Nama Z-A</option>
                        <option value="kode">Kode</option>
                        <option value="komponen">Jumlah Komponen</option>
                        <option value="komponen-desc">Komponen (Terbanyak)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6" id="mapel-grid">
            @foreach($mataPelajaran as $mapel)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300 hover:-translate-y-1 mapel-card" 
                 data-search="{{ strtolower($mapel->nama_mapel . ' ' . $mapel->kode_mapel) }}"
                 data-nama="{{ strtolower($mapel->nama_mapel) }}"
                 data-kode="{{ strtolower($mapel->kode_mapel) }}"
                 data-komponen="{{ $mapel->komponen_nilai_count }}">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-900 truncate">{{ $mapel->nama_mapel }}</h3>
                            <div class="flex items-center mt-1 space-x-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-hashtag mr-1 text-xs"></i>
                                    {{ $mapel->kode_mapel }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($mapel->komponen_nilai_count == 0) bg-red-100 text-red-800
                                    @elseif($mapel->komponen_nilai_count <= 3) bg-green-100 text-green-800
                                    @elseif($mapel->komponen_nilai_count <= 6) bg-blue-100 text-blue-800
                                    @else bg-purple-100 text-purple-800
                                    @endif">
                                    <i class="fas fa-layer-group mr-1 text-xs"></i>
                                    {{ $mapel->komponen_nilai_count }} Komponen
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    @if($mapel->deskripsi)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $mapel->deskripsi }}</p>
                    @else
                    <p class="text-gray-400 text-sm mb-4 italic">Tidak ada deskripsi</p>
                    @endif
                    
                    <!-- Progress Bar for Komponen -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Komponen Penilaian</span>
                            <span>{{ $mapel->komponen_nilai_count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" 
                                 style="width: {{ min(($mapel->komponen_nilai_count / 10) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('komponen-nilai.index', $mapel->id) }}" 
                           class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                            <i class="fas fa-cog mr-1.5"></i>
                            <span class="hidden sm:inline">Kelola</span>
                            <span class="sm:hidden">Komponen</span>
                        </a>
                        <a href="{{ route('mata-pelajaran.edit', $mapel) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                           title="Edit mata pelajaran">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('mata-pelajaran.destroy', $mapel) }}" method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                    title="Hapus mata pelajaran"
                                    data-mapel-name="{{ $mapel->nama_mapel }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
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

        <!-- Pagination -->
        @if($mataPelajaran->hasPages())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 md:px-6 py-4">
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                <!-- Showing info -->
                <div class="text-sm text-gray-700">
                    Menampilkan 
                    <span class="font-medium">{{ $mataPelajaran->firstItem() }}</span>
                    sampai 
                    <span class="font-medium">{{ $mataPelajaran->lastItem() }}</span>
                    dari 
                    <span class="font-medium">{{ $mataPelajaran->total() }}</span> 
                    mata pelajaran
                </div>

                <!-- Pagination Links -->
                <div class="flex items-center space-x-1">
                    <!-- Previous Button -->
                    @if($mataPelajaran->onFirstPage())
                        <span class="px-3 py-1.5 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed inline-flex items-center">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $mataPelajaran->previousPageUrl() }}" 
                           class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors inline-flex items-center">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    <!-- Page Numbers -->
                    @php
                        $current = $mataPelajaran->currentPage();
                        $last = $mataPelajaran->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $current + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $mataPelajaran->url(1) }}" 
                           class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            1
                        </a>
                        @if($start > 2)
                            <span class="px-2 py-1.5 text-gray-500">...</span>
                        @endif
                    @endif

                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $current)
                            <span class="px-3 py-1.5 bg-blue-600 text-white rounded-lg font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $mataPelajaran->url($page) }}" 
                               class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if($end < $last)
                        @if($end < $last - 1)
                            <span class="px-2 py-1.5 text-gray-500">...</span>
                        @endif
                        <a href="{{ $mataPelajaran->url($last) }}" 
                           class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            {{ $last }}
                        </a>
                    @endif

                    <!-- Next Button -->
                    @if($mataPelajaran->hasMorePages())
                        <a href="{{ $mataPelajaran->nextPageUrl() }}" 
                           class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span class="px-3 py-1.5 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const sortSelect = document.getElementById('sort-select');
    const mapelGrid = document.getElementById('mapel-grid');
    const mapelCards = document.querySelectorAll('.mapel-card');
    const noResults = document.getElementById('no-results');
    
    // Search function
    function performSearch() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        let visibleCount = 0;
        
        mapelCards.forEach(card => {
            const searchData = card.getAttribute('data-search');
            if (searchData.includes(searchTerm)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (visibleCount === 0 && searchTerm.length > 0) {
            noResults.classList.remove('hidden');
            mapelGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            mapelGrid.classList.remove('hidden');
        }
        
        // Sort cards if needed
        if (sortSelect) {
            sortCards(sortSelect.value);
        }
    }
    
    // Sort functionality
    function sortCards(sortBy) {
        const cards = Array.from(mapelCards);
        const container = mapelGrid;
        
        cards.sort((a, b) => {
            switch(sortBy) {
                case 'nama':
                    return a.getAttribute('data-nama').localeCompare(b.getAttribute('data-nama'));
                case 'nama-desc':
                    return b.getAttribute('data-nama').localeCompare(a.getAttribute('data-nama'));
                case 'kode':
                    return a.getAttribute('data-kode').localeCompare(b.getAttribute('data-kode'));
                case 'komponen':
                    return parseInt(a.getAttribute('data-komponen')) - parseInt(b.getAttribute('data-komponen'));
                case 'komponen-desc':
                    return parseInt(b.getAttribute('data-komponen')) - parseInt(a.getAttribute('data-komponen'));
                default:
                    return 0;
            }
        });
        
        // Reappend sorted cards
        cards.forEach(card => {
            container.appendChild(card);
        });
    }
    
    // Event listeners
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            sortCards(this.value);
        });
    }
    
    // Enhanced delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const mapelName = button.getAttribute('data-mapel-name');
            
            if (!confirm(`Yakin ingin menghapus mata pelajaran "${mapelName}"? Semua komponen penilaian yang terkait juga akan dihapus.`)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.classList.remove('hover:bg-red-700');
            button.classList.add('bg-red-400');
        });
    });
    
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
    mapelCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        card.style.transitionDelay = `${index * 0.1}s`;
        
        observer.observe(card);
    });
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
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
    .p-6 {
        padding: 1rem;
    }
}

/* Smooth transitions */
.mapel-card {
    transition: all 0.3s ease-in-out;
}

/* Custom focus styles */
a:focus, button:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}
</style>
@endsection