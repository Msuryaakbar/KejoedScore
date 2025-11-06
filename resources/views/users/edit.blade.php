@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="py-4 md:py-6">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-4">
                <a href="{{ route('users.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors w-fit">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Data User</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
                <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                <div class="md:ml-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Edit User</h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Update informasi user {{ $user->name }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <h2 class="text-lg font-semibold text-gray-900">Form Edit User</h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui data user di bawah ini</p>
            </div>

            <div class="p-4 md:p-6">
                <form id="edit-user-form" action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-5 md:mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10 @error('name') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        @error('name')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5 md:mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10 @error('email') border-red-500 @enderror"
                                   placeholder="Masukkan alamat email">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5 md:mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10 @error('password') border-red-500 @enderror"
                                   placeholder="Masukkan password baru (opsional)">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                        @error('password')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-5 md:mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10"
                                   placeholder="Konfirmasi password baru">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-5 md:mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="role" 
                                    id="role" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none pr-10 @error('role') border-red-500 @enderror"
                                    onchange="toggleSiswaSelect()">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="guru" {{ old('role', $user->role) === 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="ortu" {{ old('role', $user->role) === 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('role')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Siswa (untuk Orang Tua) -->
                    <div id="siswa-select" class="mb-6 md:mb-8 transition-all duration-300 ease-in-out" 
                         style="display: {{ old('role', $user->role) === 'ortu' ? 'block' : 'none' }}; opacity: {{ old('role', $user->role) === 'ortu' ? '1' : '0' }};">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Pilih Siswa (Anak) <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Search Box -->
                        <div class="mb-3">
                            <div class="relative">
                                <input type="text" 
                                       id="siswa-search" 
                                       placeholder="Cari siswa..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm pr-10">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Students List -->
                        <div class="border border-gray-300 rounded-lg p-4 max-h-60 overflow-y-auto bg-gray-50">
                            @forelse($siswaList as $siswa)
                            <div class="siswa-item flex items-center mb-3 p-3 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition-colors" 
                                 data-name="{{ strtolower($siswa->nama) }}"
                                 data-nis="{{ $siswa->nis }}"
                                 data-kelas="{{ strtolower($siswa->kelas->nama_kelas ?? '') }}">
                                <input type="checkbox" 
                                       name="siswa_ids[]" 
                                       value="{{ $siswa->id }}" 
                                       id="siswa_{{ $siswa->id }}"
                                       class="mr-3 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                       {{ in_array($siswa->id, old('siswa_ids', $user->siswa->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="siswa_{{ $siswa->id }}" class="flex-1 cursor-pointer">
                                    <div class="text-sm font-medium text-gray-900">{{ $siswa->nama }}</div>
                                    <div class="text-xs text-gray-500 flex flex-wrap gap-2 mt-1">
                                        <span>NIS: {{ $siswa->nis }}</span>
                                        <span>•</span>
                                        <span>Kelas: {{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}</span>
                                    </div>
                                </label>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-users text-gray-300 text-2xl mb-2"></i>
                                <p class="text-gray-500 text-sm">Tidak ada siswa yang tersedia.</p>
                            </div>
                            @endforelse
                        </div>
                        
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-xs text-gray-500">
                                <span id="selected-count">0</span> siswa dipilih
                            </p>
                            <p class="text-xs text-gray-500">Hanya siswa yang belum terhubung dengan orang tua lain yang ditampilkan</p>
                        </div>
                        
                        @error('siswa_ids')
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
                            <span>Update User</span>
                        </button>
                        <a href="{{ route('users.index') }}" 
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
                        User: <span class="font-semibold">{{ $user->name }}</span> | 
                        Email: <span class="font-semibold">{{ $user->email }}</span> | 
                        Role: <span class="font-semibold capitalize">{{ $user->role }}</span>
                        @if($user->role === 'ortu' && $user->siswa->count() > 0)
                        | Siswa: <span class="font-semibold">{{ $user->siswa->pluck('nama')->join(', ') }}</span>
                        @endif
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
    const form = document.getElementById('edit-user-form');
    const submitButton = document.getElementById('submit-button');
    const siswaSearch = document.getElementById('siswa-search');
    const siswaItems = document.querySelectorAll('.siswa-item');
    const selectedCount = document.getElementById('selected-count');
    
    // Initial count update
    updateSelectedCount();
    
    // Search functionality for siswa
    if (siswaSearch) {
        siswaSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            siswaItems.forEach(item => {
                const name = item.getAttribute('data-name');
                const nis = item.getAttribute('data-nis');
                const kelas = item.getAttribute('data-kelas');
                
                if (name.includes(searchTerm) || nis.includes(searchTerm) || kelas.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Update selected count
    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('input[name="siswa_ids[]"]:checked');
        selectedCount.textContent = checkedBoxes.length;
    }
    
    // Add event listeners to checkboxes
    document.querySelectorAll('input[name="siswa_ids[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    
    // Enhanced role toggle function
    function toggleSiswaSelect() {
        const role = document.getElementById('role').value;
        const siswaSelect = document.getElementById('siswa-select');
        
        if (role === 'ortu') {
            siswaSelect.style.display = 'block';
            setTimeout(() => {
                siswaSelect.style.opacity = '1';
            }, 10);
        } else {
            siswaSelect.style.opacity = '0';
            setTimeout(() => {
                siswaSelect.style.display = 'none';
            }, 300);
        }
    }
    
    // Form submission handler
    form.addEventListener('submit', function() {
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Memproses...</span>';
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
        const errorElement = field.parentElement.nextElementSibling;
        
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
    
    // Password strength indicator (optional enhancement)
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = this.parentElement.querySelector('.password-strength') || 
                                   document.createElement('div');
            
            if (!this.parentElement.querySelector('.password-strength')) {
                strengthIndicator.className = 'password-strength mt-2 text-xs';
                this.parentElement.appendChild(strengthIndicator);
            }
            
            if (password.length === 0) {
                strengthIndicator.textContent = '';
                return;
            }
            
            let strength = 'Lemah';
            let color = 'text-red-500';
            
            if (password.length >= 8) {
                strength = 'Sedang';
                color = 'text-yellow-500';
            }
            
            if (password.length >= 8 && /[A-Z]/.test(password) && /[0-9]/.test(password) && /[^A-Za-z0-9]/.test(password)) {
                strength = 'Kuat';
                color = 'text-green-500';
            }
            
            strengthIndicator.innerHTML = `<span class="${color} font-medium">Kekuatan password: ${strength}</span>`;
        });
    }
});

// Loading animation
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

/* Custom styles for better mobile experience */
@media (max-width: 640px) {
    .max-w-2xl {
        max-width: 100%;
    }
    
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Smooth transitions */
input, select, .siswa-item {
    transition: all 0.2s ease-in-out;
}

/* Focus styles for better accessibility */
input:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Custom scrollbar for siswa list */
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</script>
@endsection