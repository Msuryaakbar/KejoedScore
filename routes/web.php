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

Route::get('/', function () {
    return redirect()->route('siswa.index');
});

// Kelas Routes
Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');
Route::get('kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Siswa Routes
Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
Route::get('siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

// Nilai Routes - Rekap (HARUS DI ATAS YANG LAIN!)
// Nilai Routes - Input (MULTI MAPEL)
Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
Route::get('nilai/mapel/{mapel}', [NilaiController::class, 'pilihKelas'])->name('nilai.pilih-kelas');
Route::get('nilai/mapel/{mapel}/kelas/{kelas}', [NilaiController::class, 'show'])->name('nilai.show-mapel');
Route::post('nilai/mapel/{mapel}/kelas/{kelas}/batch', [NilaiController::class, 'batchUpdate'])->name('nilai.batch.update-mapel');

// Nilai Routes - Rekap (MULTI MAPEL)
Route::get('nilai/rekap', [NilaiController::class, 'rekapIndex'])->name('nilai.rekap.index');
Route::get('nilai/rekap/mapel/{mapel}', [NilaiController::class, 'rekapPilihKelas'])->name('nilai.rekap.pilih-kelas');
Route::get('nilai/rekap/mapel/{mapel}/kelas/{kelas}', [NilaiController::class, 'rekapShow'])->name('nilai.rekap.show-mapel');

// Rapor Routes
Route::get('rapor', [RaporController::class, 'index'])->name('rapor.index');
Route::get('rapor/kelas/{kelas}', [RaporController::class, 'showKelas'])->name('rapor.kelas');
Route::get('rapor/siswa/{siswa}', [RaporController::class, 'showSiswa'])->name('rapor.siswa');
Route::get('rapor/siswa/{siswa}/print', [RaporController::class, 'printSiswa'])->name('rapor.print');
// Export Routes
Route::get('export', [ExportController::class, 'index'])->name('export.index');
Route::get('export/kelas/{kelas}', [ExportController::class, 'export'])->name('export.excel');

// Tahun Ajaran Routes
Route::get('tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran.index');
Route::get('tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('tahun-ajaran.create');
Route::post('tahun-ajaran', [TahunAjaranController::class, 'store'])->name('tahun-ajaran.store');
Route::post('tahun-ajaran/{tahunAjaran}/set-active', [TahunAjaranController::class, 'setActive'])->name('tahun-ajaran.set-active');
Route::delete('tahun-ajaran/{tahunAjaran}', [TahunAjaranController::class, 'destroy'])->name('tahun-ajaran.destroy');

// Mata Pelajaran Routes
Route::get('mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran.index');
Route::get('mata-pelajaran/create', [MataPelajaranController::class, 'create'])->name('mata-pelajaran.create');
Route::post('mata-pelajaran', [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
Route::get('mata-pelajaran/{mataPelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('mata-pelajaran.edit');
Route::put('mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
Route::delete('mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');

// Komponen Nilai Routes
Route::get('mata-pelajaran/{mapel}/komponen', [KomponenNilaiController::class, 'index'])->name('komponen-nilai.index');
Route::post('mata-pelajaran/{mapel}/komponen', [KomponenNilaiController::class, 'store'])->name('komponen-nilai.store');
Route::put('mata-pelajaran/{mapel}/komponen/{komponen}', [KomponenNilaiController::class, 'update'])->name('komponen-nilai.update');
Route::delete('mata-pelajaran/{mapel}/komponen/{komponen}', [KomponenNilaiController::class, 'destroy'])->name('komponen-nilai.destroy');
