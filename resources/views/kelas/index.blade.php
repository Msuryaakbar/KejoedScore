@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 md:mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Data Kelas</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Kelola data kelas sekolah</p>
            </div>
            <a href="{{ route('kelas.create') }}" 
               class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Kelas</span>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-school text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Kelas</p>
                        <p class="text-lg font-bold text-gray-900">{{ $kelas->total() }}</p>
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
                        <i class="fas fa-chart-bar text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Rata-rata Siswa/Kelas</p>
                        <p class="text-lg font-bold text-gray-900">{{ round($kelas->avg('siswa_count'), 1) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2 sm:mb-0">Daftar Kelas</h2>
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Cari kelas..." 
                                   class="pl-9 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm w-full md:w-64"
                                   id="search-input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                @if($kelas->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Nama Kelas</span>
                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                </div>
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tingkat
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Siswa
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @foreach($kelas as $k)
                        <tr class="hover:bg-gray-50 transition-colors" data-search="{{ strtolower($k->nama_kelas) }}">
                            <td class="px-4 md:px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-school text-blue-600 text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate">{{ $k->nama_kelas }}</div>
                                        <div class="text-xs text-gray-500">Kelas {{ $k->tingkat }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($k->tingkat == 7) bg-green-100 text-green-800 border border-green-200
                                    @elseif($k->tingkat == 8) bg-blue-100 text-blue-800 border border-blue-200
                                    @elseif($k->tingkat == 9) bg-purple-100 text-purple-800 border border-purple-200
                                    @else bg-gray-100 text-gray-800 border border-gray-200
                                    @endif">
                                    <i class="fas fa-graduation-cap mr-1"></i>
                                    Kelas {{ $k->tingkat }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <i class="fas fa-user text-gray-600 text-xs"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $k->siswa_count }}</span>
                                    <span class="text-xs text-gray-500 ml-1">siswa</span>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('kelas.edit', $k) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                       title="Edit kelas">
                                        <i class="fas fa-edit mr-1.5 text-xs"></i>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $k) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                                title="Hapus kelas"
                                                data-kelas-name="{{ $k->nama_kelas }}">
                                            <i class="fas fa-trash mr-1.5 text-xs"></i>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-school text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data kelas</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan menambahkan kelas pertama Anda untuk mengelola data siswa.</p>
                    <a href="{{ route('kelas.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kelas Pertama
                    </a>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($kelas->hasPages())
            <div class="px-4 md:px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                    <!-- Showing info -->
                    <div class="text-sm text-gray-700">
                        Menampilkan 
                        <span class="font-medium">{{ $kelas->firstItem() }}</span>
                        sampai 
                        <span class="font-medium">{{ $kelas->lastItem() }}</span>
                        dari 
                        <span class="font-medium">{{ $kelas->total() }}</span> 
                        kelas
                    </div>

                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-1">
                        <!-- Previous Button -->
                        @if($kelas->onFirstPage())
                            <span class="px-3 py-1.5 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed inline-flex items-center">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $kelas->previousPageUrl() }}" 
                               class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors inline-flex items-center">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </a>
                        @endif

                        <!-- Page Numbers -->
                        @php
                            $current = $kelas->currentPage();
                            $last = $kelas->lastPage();
                            $start = max(1, $current - 2);
                            $end = min($last, $current + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $kelas->url(1) }}" 
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
                                <a href="{{ $kelas->url($page) }}" 
                                   class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        @if($end < $last)
                            @if($end < $last - 1)
                                <span class="px-2 py-1.5 text-gray-500">...</span>
                            @endif
                            <a href="{{ $kelas->url($last) }}" 
                               class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                {{ $last }}
                            </a>
                        @endif

                        <!-- Next Button -->
                        @if($kelas->hasMorePages())
                            <a href="{{ $kelas->nextPageUrl() }}" 
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
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const tableBody = document.getElementById('table-body');
    
    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = tableBody.querySelectorAll('tr[data-search]');
            
            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                if (searchData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Enhanced delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const kelasName = button.getAttribute('data-kelas-name');
            
            if (!confirm(`Yakin ingin menghapus kelas ${kelasName}? Tindakan ini tidak dapat dibatalkan.`)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5 text-xs"></i><span class="hidden sm:inline">Menghapus...</span>';
        });
    });
    
    // Add hover effects for better UX
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<style>
/* Custom styles for better mobile experience */
@media (max-width: 768px) {
    .max-w-7xl {
        max-width: 100%;
    }
    
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Make table more responsive */
    .overflow-x-auto {
        -webkit-overflow-scrolling: touch;
    }
    
    /* Adjust table cell padding for mobile */
    .px-4.md\:px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Smooth transitions */
tr {
    transition: all 0.2s ease-in-out;
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

/* Custom scrollbar for table */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endsection