<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiDongkrakController extends Controller
{
    // Step 1: Pilih Kelas
    public function index()
    {
        // Hanya Admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $kelas = Kelas::withCount('siswa')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Belum ada tahun ajaran aktif.');
        }

        return view('nilai-dongkrak.index', compact('kelas', 'tahunAjaranAktif'));
    }

    // Step 2: Pilih Siswa dari Kelas
    public function showKelas($kelasId)
    {
        // Hanya Admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $kelas = Kelas::findOrFail($kelasId);
        $siswa = Siswa::where('kelas_id', $kelasId)->orderBy('nama')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('nilai-dongkrak.pilih-siswa', compact('kelas', 'siswa', 'tahunAjaranAktif'));
    }

    // Step 3: Input Nilai Dongkrak per Siswa
    public function showSiswa($siswaId)
    {
        // Hanya Admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $siswa = Siswa::with('kelas')->findOrFail($siswaId);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Tidak ada tahun ajaran aktif!');
        }

        // Ambil semua nilai siswa ini untuk tahun ajaran aktif
        $nilaiList = Nilai::where('siswa_id', $siswaId)
            ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->with('mataPelajaran')
            ->get()
            ->map(function ($nilai) {
                return [
                    'mapel' => $nilai->mataPelajaran,
                    'nilai' => $nilai,
                ];
            })
            ->filter(function ($item) {
                return $item['mapel'] !== null; // Filter yang mapel-nya ada
            })
            ->values();

        return view('nilai-dongkrak.input', compact('siswa', 'tahunAjaranAktif', 'nilaiList'));
    }

    // Save Nilai Dongkrak
    public function update(Request $request, $siswaId)
    {
        // Hanya Admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Hanya admin yang dapat melakukan ini.');
        }

        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.nilai_dongkrak' => 'nullable|numeric|min:0|max:100',
            'nilai.*.catatan_dongkrak' => 'nullable|string|max:500',
        ]);

        $siswa = Siswa::findOrFail($siswaId);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        foreach ($request->nilai as $nilaiId => $data) {
            $nilai = Nilai::findOrFail($nilaiId);

            // Pastikan nilai ini milik siswa yang benar
            if ($nilai->siswa_id != $siswaId) {
                continue;
            }

            $nilai->update([
                'nilai_dongkrak' => $data['nilai_dongkrak'] ?? null,
                'catatan_dongkrak' => $data['catatan_dongkrak'] ?? null,
            ]);
        }

        return redirect()->route('nilai-dongkrak.show-siswa', $siswaId)
            ->with('success', 'Nilai dongkrak berhasil disimpan!');
    }
}
