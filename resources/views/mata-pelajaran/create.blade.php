@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-4">
                <a href="{{ route('mata-pelajaran.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-fit">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Mata Pelajaran</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
                <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Tambah Mata Pelajaran Baru</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Isi formulir di bawah ini untuk menambahkan mata pelajaran baru</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-100">
                <h2 class="text-lg font-semibold text-gray-900">Formulir Mata Pelajaran Baru</h2>
                <p class="text-sm text-gray-600 mt-1">Lengkapi data mata pelajaran di bawah ini</p>
            </div>

            <div class="p-4 md:p-6">
                <form id="create-mapel-form" action="{{ route('mata-pelajaran.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Mata Pelajaran -->
                    <div class="mb-5 md:mb-6">
                        <label for="nama_mapel" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_mapel" 
                                   id="nama_mapel"
                                   value="{{ old('nama_mapel') }}" 
                                   required
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Contoh: Matematika, Bahasa Indonesia, IPA"
                                   maxlength="100">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-book text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Masukkan nama lengkap mata pelajaran (maksimal 100 karakter)</p>
                        @error('nama_mapel')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Kode Mata Pelajaran -->
                    <div class="mb-5 md:mb-6">
                        <label for="kode_mapel" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="kode_mapel" 
                                   id="kode_mapel"
                                   value="{{ old('kode_mapel') }}" 
                                   required
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors uppercase"
                                   placeholder="Contoh: MTK, BIN, IPA"
                                   maxlength="10"
                                   oninput="this.value = this.value.toUpperCase()">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kode unik untuk identifikasi mata pelajaran (maksimal 10 karakter, otomatis kapital)</p>
                        @error('kode_mapel')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6 md:mb-8">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-gray-500 text-sm">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <textarea name="deskripsi" 
                                      id="deskripsi"
                                      rows="4"
                                      class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"
                                      placeholder="Deskripsi singkat tentang mata pelajaran, tujuan pembelajaran, atau informasi penting lainnya">{{ old('deskripsi') }}</textarea>
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-align-left text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <p class="text-xs text-gray-500">Deskripsi akan membantu memahami tujuan mata pelajaran</p>
                            <span id="char-count" class="text-xs text-gray-400">0/500</span>
                        </div>
                        @error('deskripsi')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Preview Card -->
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg transition-all duration-300">
                        <h3 class="text-sm font-medium text-green-800 mb-3 flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Preview Mata Pelajaran
                        </h3>
                        <div class="bg-white rounded-lg p-4 border border-green-100">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 id="preview-nama" class="font-semibold text-gray-900 text-lg">-</h4>
                                    <p class="text-sm text-gray-500">Kode: <span id="preview-kode" class="font-mono">-</span></p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-layer-group mr-1 text-xs"></i>
                                    0 Komponen
                                </span>
                            </div>
                            <p id="preview-deskripsi" class="text-sm text-gray-600 mt-2">-</p>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button type="submit" 
                                id="submit-button"
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-transform">
                            <i class="fas fa-save mr-2"></i>
                            <span>Simpan Mata Pelajaran</span>
                        </button>
                        <a href="{{ route('mata-pelajaran.index') }}" 
                           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="fas fa-times mr-2"></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start">
                <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-3"></i>
                <div>
                    <p class="text-sm font-medium text-blue-800 mb-2">Tips Pengisian</p>
                    <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                        <li>Gunakan nama mata pelajaran yang jelas dan mudah dipahami</li>
                        <li>Kode mata pelajaran harus unik dan konsisten</li>
                        <li>Deskripsi membantu guru dan siswa memahami tujuan pembelajaran</li>
                        <li>Setelah membuat mata pelajaran, Anda dapat menambahkan komponen penilaian</li>
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
    const form = document.getElementById('create-mapel-form');
    const submitButton = document.getElementById('submit-button');
    const namaMapelInput = document.getElementById('nama_mapel');
    const kodeMapelInput = document.getElementById('kode_mapel');
    const deskripsiTextarea = document.getElementById('deskripsi');
    const charCount = document.getElementById('char-count');
    const previewNama = document.getElementById('preview-nama');
    const previewKode = document.getElementById('preview-kode');
    const previewDeskripsi = document.getElementById('preview-deskripsi');
    
    // Real-time preview update
    function updatePreview() {
        // Update nama
        previewNama.textContent = namaMapelInput.value || '-';
        
        // Update kode
        previewKode.textContent = kodeMapelInput.value || '-';
        
        // Update deskripsi
        if (deskripsiTextarea.value) {
            previewDeskripsi.textContent = deskripsiTextarea.value;
            previewDeskripsi.classList.remove('text-gray-400', 'italic');
            previewDeskripsi.classList.add('text-gray-600');
        } else {
            previewDeskripsi.textContent = 'Tidak ada deskripsi';
            previewDeskripsi.classList.add('text-gray-400', 'italic');
            previewDeskripsi.classList.remove('text-gray-600');
        }
    }
    
    // Character counter for deskripsi
    function updateCharCount() {
        const currentLength = deskripsiTextarea.value.length;
        const maxLength = 500;
        charCount.textContent = `${currentLength}/${maxLength}`;
        
        if (currentLength > maxLength * 0.8) {
            charCount.classList.remove('text-gray-400');
            charCount.classList.add('text-orange-500');
        } else {
            charCount.classList.remove('text-orange-500');
            charCount.classList.add('text-gray-400');
        }
    }
    
    // Auto-capitalize kode mapel
    kodeMapelInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        updatePreview();
    });
    
    // Event listeners for real-time updates
    namaMapelInput.addEventListener('input', updatePreview);
    kodeMapelInput.addEventListener('input', updatePreview);
    deskripsiTextarea.addEventListener('input', function() {
        updatePreview();
        updateCharCount();
    });
    
    // Auto-format nama mapel
    namaMapelInput.addEventListener('blur', function() {
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
    
    // Initial updates
    updatePreview();
    updateCharCount();
    
    // Form submission handler
    form.addEventListener('submit', function(e) {
        // Basic validation
        const namaMapel = namaMapelInput.value.trim();
        const kodeMapel = kodeMapelInput.value.trim();
        
        if (!namaMapel || !kodeMapel) {
            e.preventDefault();
            alert('Harap lengkapi semua field yang wajib diisi!');
            return false;
        }
        
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Menyimpan...</span>';
        submitButton.classList.remove('bg-green-600', 'hover:bg-green-700', 'hover:-translate-y-0.5');
        submitButton.classList.add('bg-green-400');
    });
    
    // Real-time validation
    const inputs = form.querySelectorAll('input, textarea');
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
            field.classList.remove('border-gray-300', 'focus:ring-green-500', 'focus:border-green-500');
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300', 'focus:ring-green-500', 'focus:border-green-500');
            
            // Remove error message if exists and it's a validation error (not server error)
            if (errorElement && errorElement.classList.contains('text-red-600') && !errorElement.querySelector('.fa-exclamation-circle')) {
                errorElement.remove();
            }
        }
    }
    
    // Character counter for nama_mapel
    namaMapelInput.addEventListener('input', function() {
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
input, textarea, select {
    transition: all 0.2s ease-in-out;
}

/* Focus styles for better accessibility */
input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Style for character counters */
.char-counter {
    font-family: monospace;
    background: rgba(255, 255, 255, 0.9);
    padding: 2px 4px;
    border-radius: 4px;
}
</style>
@endsection