{{-- resources/views/kelas/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-4">
                <a href="{{ route('kelas.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-fit">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Data Kelas</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
                <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Tambah Kelas Baru</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Buat data kelas baru untuk mengelola siswa</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <h2 class="text-lg font-semibold text-gray-900">Form Tambah Kelas</h2>
                <p class="text-sm text-gray-600 mt-1">Lengkapi data kelas di bawah ini</p>
            </div>

            <div class="p-4 md:p-6">
                <form id="create-kelas-form" action="{{ route('kelas.store') }}" method="POST">
                    @csrf

                    <!-- Nama Kelas -->
                    <div class="mb-5 md:mb-6">
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="nama_kelas"
                                   name="nama_kelas" 
                                   value="{{ old('nama_kelas') }}" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10"
                                   placeholder="Contoh: VII A, VIII B, IX C"
                                   maxlength="20">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-school text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Masukkan nama kelas (maksimal 20 karakter)</p>
                        @error('nama_kelas')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Tingkat -->
                    <div class="mb-6 md:mb-8">
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tingkat Kelas <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="tingkat" 
                                    id="tingkat"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none pr-10">
                                <option value="">Pilih Tingkat Kelas</option>
                                <option value="7" {{ old('tingkat') == '7' ? 'selected' : '' }}>Kelas 7</option>
                                <option value="8" {{ old('tingkat') == '8' ? 'selected' : '' }}>Kelas 8</option>
                                <option value="9" {{ old('tingkat') == '9' ? 'selected' : '' }}>Kelas 9</option>
                                <option value="10" {{ old('tingkat') == '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ old('tingkat') == '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ old('tingkat') == '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Pilih tingkat kelas yang sesuai</p>
                        @error('tingkat')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Preview Info -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-800 mb-2 flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Preview Kelas
                        </h3>
                        <div class="text-sm text-blue-700">
                            <div id="preview-content" class="space-y-1">
                                <p>Nama Kelas: <span id="preview-nama" class="font-semibold">-</span></p>
                                <p>Tingkat: <span id="preview-tingkat" class="font-semibold">-</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button type="submit" 
                                id="submit-button"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>
                            <span>Simpan Kelas</span>
                        </button>
                        <a href="{{ route('kelas.index') }}" 
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="fas fa-times mr-2"></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-xl p-4">
            <div class="flex items-start">
                <i class="fas fa-lightbulb text-yellow-500 mt-0.5 mr-3"></i>
                <div>
                    <p class="text-sm font-medium text-gray-800">Tips Pengisian</p>
                    <ul class="text-xs text-gray-600 mt-1 list-disc list-inside space-y-1">
                        <li>Gunakan format konsisten untuk nama kelas, contoh: "VII A" atau "7A"</li>
                        <li>Pastikan tingkat kelas sesuai dengan kurikulum yang berlaku</li>
                        <li>Nama kelas harus unik dan belum digunakan sebelumnya</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('create-kelas-form');
    const submitButton = document.getElementById('submit-button');
    const namaKelasInput = document.getElementById('nama_kelas');
    const tingkatSelect = document.getElementById('tingkat');
    const previewNama = document.getElementById('preview-nama');
    const previewTingkat = document.getElementById('preview-tingkat');
    
    // Real-time preview update
    function updatePreview() {
        previewNama.textContent = namaKelasInput.value || '-';
        
        const selectedOption = tingkatSelect.options[tingkatSelect.selectedIndex];
        previewTingkat.textContent = selectedOption.value ? selectedOption.text : '-';
    }
    
    namaKelasInput.addEventListener('input', updatePreview);
    tingkatSelect.addEventListener('change', updatePreview);
    
    // Initial preview update
    updatePreview();
    
    // Auto-format nama kelas
    namaKelasInput.addEventListener('blur', function() {
        let value = this.value.trim();
        if (value) {
            // Capitalize first letter of each word
            value = value.replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
            this.value = value;
            updatePreview();
        }
    });
    
    // Form submission handler
    form.addEventListener('submit', function() {
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Menyimpan...</span>';
        submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        submitButton.classList.add('bg-blue-400');
    });
    
    // Real-time validation
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
        const errorElement = field.parentElement.nextElementSibling?.nextElementSibling;
        
        if (field.hasAttribute('required') && !value) {
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
            
            // Remove error message if exists and it's a validation error (not server error)
            if (errorElement && errorElement.classList.contains('text-red-600') && !errorElement.querySelector('.fa-exclamation-circle')) {
                errorElement.remove();
            }
        }
    }
    
    // Character counter for nama_kelas
    namaKelasInput.addEventListener('input', function() {
        const maxLength = this.getAttribute('maxlength');
        const currentLength = this.value.length;
        const counter = this.parentElement.querySelector('.char-counter') || 
                       document.createElement('div');
        
        if (!this.parentElement.querySelector('.char-counter')) {
            counter.className = 'char-counter absolute bottom-1 right-3 text-xs';
            this.parentElement.style.position = 'relative';
            this.parentElement.appendChild(counter);
        }
        
        counter.textContent = `${currentLength}/${maxLength}`;
        counter.className = `char-counter absolute bottom-1 right-3 text-xs ${
            currentLength > maxLength * 0.8 ? 'text-orange-500' : 'text-gray-400'
        }`;
    });
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

/* Custom select styling */
select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}
</style>
@endsection