<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KomponenNilaiController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NilaiDongkrakController;


// Public routes (login/register dari Breeze)
require __DIR__ . '/auth.php';

// Redirect root ke dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Protected Routes - Semua user yang login
Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ADMIN ONLY ROUTES
    Route::middleware(['role:admin'])->group(function () {
        // User Management
        Route::resource('users', UserController::class);

        // Kelas Management
        Route::resource('kelas', KelasController::class)->parameters([
            'kelas' => 'kelas'
        ]);
        // Siswa Management
        Route::resource('siswa', SiswaController::class);

        // Tahun Ajaran
        Route::get('tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran.index');
        Route::get('tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('tahun-ajaran.create');
        Route::post('tahun-ajaran', [TahunAjaranController::class, 'store'])->name('tahun-ajaran.store');
        Route::post('tahun-ajaran/{tahunAjaran}/set-active', [TahunAjaranController::class, 'setActive'])->name('tahun-ajaran.set-active');
        Route::delete('tahun-ajaran/{tahunAjaran}', [TahunAjaranController::class, 'destroy'])->name('tahun-ajaran.destroy');

        // Mata Pelajaran
        Route::get('mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran.index');
        Route::get('mata-pelajaran/create', [MataPelajaranController::class, 'create'])->name('mata-pelajaran.create');
        Route::post('mata-pelajaran', [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
        Route::get('mata-pelajaran/{mataPelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('mata-pelajaran.edit');
        Route::put('mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
        Route::delete('mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');

        // Komponen Nilai
        Route::get('mata-pelajaran/{mapel}/komponen', [KomponenNilaiController::class, 'index'])->name('komponen-nilai.index');
        Route::post('mata-pelajaran/{mapel}/komponen', [KomponenNilaiController::class, 'store'])->name('komponen-nilai.store');
        Route::put('mata-pelajaran/{mapel}/komponen/{komponen}', [KomponenNilaiController::class, 'update'])->name('komponen-nilai.update');
        Route::delete('mata-pelajaran/{mapel}/komponen/{komponen}', [KomponenNilaiController::class, 'destroy'])->name('komponen-nilai.destroy');

        // Nilai Dongkrak - Admin Only
        Route::get('nilai-dongkrak', [NilaiDongkrakController::class, 'index'])->name('nilai-dongkrak.index');
        Route::get('nilai-dongkrak/kelas/{kelas}', [NilaiDongkrakController::class, 'showKelas'])->name('nilai-dongkrak.show-kelas');
        Route::get('nilai-dongkrak/siswa/{siswa}', [NilaiDongkrakController::class, 'showSiswa'])->name('nilai-dongkrak.show-siswa');
        Route::post('nilai-dongkrak/siswa/{siswa}', [NilaiDongkrakController::class, 'update'])->name('nilai-dongkrak.update');

        // Export - Admin only
        Route::get('export', [ExportController::class, 'index'])->name('export.index');
        Route::get('export/kelas/{kelas}', [ExportController::class, 'export'])->name('export.excel');
    });

    // ADMIN & GURU ROUTES
    Route::middleware(['role:admin,guru'])->group(function () {
        // Input Nilai
        Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('nilai/mapel/{mapel}', [NilaiController::class, 'pilihKelas'])->name('nilai.pilih-kelas');
        Route::get('nilai/mapel/{mapel}/kelas/{kelas}', [NilaiController::class, 'show'])->name('nilai.show-mapel');
        Route::post('nilai/mapel/{mapel}/kelas/{kelas}/batch', [NilaiController::class, 'batchUpdate'])->name('nilai.batch.update-mapel');

        // Rekap Nilai
        Route::get('nilai/rekap', [NilaiController::class, 'rekapIndex'])->name('nilai.rekap.index');
        Route::get('nilai/rekap/mapel/{mapel}', [NilaiController::class, 'rekapPilihKelas'])->name('nilai.rekap.pilih-kelas');
        Route::get('nilai/rekap/mapel/{mapel}/kelas/{kelas}', [NilaiController::class, 'rekapShow'])->name('nilai.rekap.show-mapel');
    });

    // ALL AUTHENTICATED USERS (termasuk Orang Tua)
    // Rapor - Semua bisa lihat, tapi akan di-filter di controller
    Route::get('rapor', [RaporController::class, 'index'])->name('rapor.index');
    Route::get('rapor/kelas/{kelas}', [RaporController::class, 'showKelas'])->name('rapor.kelas');
    Route::get('rapor/siswa/{siswa}', [RaporController::class, 'showSiswa'])->name('rapor.siswa');
    Route::get('rapor/siswa/{siswa}/print', [RaporController::class, 'printSiswa'])->name('rapor.print');
    Route::get('rapor/siswa/{siswa}/performen', [RaporController::class, 'printSiswaDongkrak'])->name('rapor.print-dongkrak');
});
