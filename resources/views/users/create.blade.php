@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah User Baru</h1>
                <p class="text-lg text-gray-600">Buat akun untuk Guru atau Orang Tua</p>
            </div>
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar User
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Form Tambah User</h2>
            <p class="text-blue-100 text-sm mt-1">Isi data user dengan lengkap dan benar</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Nama -->
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-3">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror" 
                        placeholder="Masukkan nama lengkap" required>
                </div>
                @error('name')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-3">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror" 
                        placeholder="user@example.com" required>
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-3">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror" 
                        placeholder="Minimal 8 karakter" required>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-3">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        placeholder="Ketik ulang password" required>
                </div>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <label for="role" class="block text-gray-700 font-medium mb-3">Role</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <select name="role" id="role" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none @error('role') border-red-500 @enderror" 
                        required onchange="toggleSiswaSelect()">
                        <option value="">Pilih Role User</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="ortu" {{ old('role') === 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Siswa (untuk Orang Tua) -->
            <div id="siswa-select" class="mb-6 transition-all duration-300" style="display: none;">
                <label class="block text-gray-700 font-medium mb-3">Pilih Siswa (Anak)</label>
                <div class="border border-gray-300 rounded-xl p-4 max-h-60 overflow-y-auto bg-gray-50">
                    @forelse($siswaList as $siswa)
                    <div class="flex items-center p-3 hover:bg-white rounded-lg transition-colors mb-2 last:mb-0">
                        <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" 
                            id="siswa_{{ $siswa->id }}"
                            class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            {{ in_array($siswa->id, old('siswa_ids', [])) ? 'checked' : '' }}>
                        <label for="siswa_{{ $siswa->id }}" class="ml-3 text-sm text-gray-700 cursor-pointer flex-1">
                            <div class="font-medium">{{ $siswa->nama }}</div>
                            <div class="text-gray-500 text-xs">
                                {{ $siswa->nis }} • {{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                            </div>
                        </label>
                    </div>
                    @empty
                    <div class="text-center py-4 text-gray-500">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <p class="text-sm">Tidak ada siswa yang tersedia.</p>
                    </div>
                    @endforelse
                </div>
                <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Hanya siswa yang belum terhubung dengan orang tua lain yang ditampilkan.
                </p>
                @error('siswa_ids')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}" 
                   class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" 
                        class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium px-8 py-3 rounded-xl shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan User
                </button>
            </div>
        </form>
    </div>

    <!-- Info Section -->
    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
        <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-xl flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-blue-900 mb-3">Informasi Role User</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white rounded-xl p-4 border border-blue-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold">👨‍💼</div>
                            <span class="font-semibold text-blue-800">Admin</span>
                        </div>
                        <p class="text-gray-600 text-xs leading-relaxed">Akses penuh ke semua fitur sistem</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-green-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-bold">👨‍🏫</div>
                            <span class="font-semibold text-green-800">Guru</span>
                        </div>
                        <p class="text-gray-600 text-xs leading-relaxed">Input nilai dan lihat rekap kelas</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-purple-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-bold">👨‍👩‍👧‍👦</div>
                            <span class="font-semibold text-purple-800">Orang Tua</span>
                        </div>
                        <p class="text-gray-600 text-xs leading-relaxed">Hanya bisa lihat rapor anaknya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSiswaSelect() {
    const role = document.getElementById('role').value;
    const siswaSelect = document.getElementById('siswa-select');
    
    if (role === 'ortu') {
        siswaSelect.style.display = 'block';
        // Smooth animation
        setTimeout(() => {
            siswaSelect.style.opacity = '1';
            siswaSelect.style.transform = 'translateY(0)';
        }, 10);
    } else {
        siswaSelect.style.opacity = '0';
        siswaSelect.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            siswaSelect.style.display = 'none';
        }, 300);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const siswaSelect = document.getElementById('siswa-select');
    siswaSelect.style.opacity = '0';
    siswaSelect.style.transform = 'translateY(-10px)';
    siswaSelect.style.transition = 'all 0.3s ease';
    
    toggleSiswaSelect();
});
</script>

<style>
select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}
</style>
@endsection