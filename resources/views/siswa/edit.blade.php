@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-4">
                <a href="{{ route('siswa.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-fit">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Data Siswa</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
                <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Edit Siswa</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Perbarui data siswa {{ $siswa->nama }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <h2 class="text-lg font-semibold text-gray-900">Form Edit Siswa</h2>
                <p class="text-sm text-gray-600 mt-1">Lengkapi data siswa di bawah ini</p>
            </div>

            <div class="p-4 md:p-6">
                <form id="edit-siswa-form" action="{{ route('siswa.update', $siswa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-5 md:mb-6">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="nama"
                                   name="nama" 
                                   value="{{ old('nama', $siswa->nama) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10"
                                   placeholder="Masukkan nama lengkap siswa">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        @error('nama')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- NIS -->
                    <div class="mb-5 md:mb-6">
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">
                            NIS (Nomor Induk Siswa) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="nis"
                                   name="nis" 
                                   value="{{ old('nis', $siswa->nis) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10"
                                   placeholder="Masukkan NIS siswa">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                        </div>
                        @error('nis')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div class="mb-6 md:mb-8">
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="kelas_id" 
                                    id="kelas_id"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none pr-10">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('kelas_id')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button type="submit" 
                                id="submit-button"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>
                            <span>Update Siswa</span>
                        </button>
                        <a href="{{ route('siswa.index') }}" 
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="fas fa-times mr-2"></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Info -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                <div>
                    <p class="text-sm font-medium text-blue-800">Informasi Saat Ini</p>
                    <p class="text-xs text-blue-600 mt-1">
                        Siswa: <span class="font-semibold">{{ $siswa->nama }}</span> | 
                        NIS: <span class="font-semibold">{{ $siswa->nis }}</span> | 
                        Kelas: <span class="font-semibold">{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-siswa-form');
    const submitButton = document.getElementById('submit-button');
    
    form.addEventListener('submit', function() {
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Memproses...</span>';
        submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        submitButton.classList.add('bg-blue-400');
    });
    
    // Add real-time validation
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('border-red-500')) {
                validateField(this);
            }
        });
    });
    
    function validateField(field) {
        const value = field.value.trim();
        const errorElement = field.parentElement.nextElementSibling;
        
        if (field.hasAttribute('required') && !value) {
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-300');
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
            
            // Remove error message if exists
            if (errorElement && errorElement.classList.contains('text-red-600')) {
                errorElement.remove();
            }
        }
    }
});
</script>

<style>
/* Custom styles for better mobile experience */
@media (max-width: 640px) {
    .max-w-2xl {
        max-width: 100%;
    }
    
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .py-3 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
}

/* Smooth transitions for form elements */
input, select {
    transition: all 0.2s ease-in-out;
}

/* Focus styles for better accessibility */
input:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}
</style>
@endsection