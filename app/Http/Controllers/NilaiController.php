<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\KomponenNilai;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // Step 1: Pilih Mata Pelajaran
    public function index()
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses input nilai
        if (! $user) {
            abort(403, 'Akses ditolak. Silakan login.');
        }

        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mapel = MataPelajaran::with('komponenNilai')->get(); // Ubah menjadi $mapel
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Belum ada tahun ajaran aktif. Silakan set tahun ajaran aktif terlebih dahulu.');
        }

        return view('nilai.pilih-mapel', compact('mapel', 'tahunAjaranAktif')); // Ubah menjadi $mapel
    }
    // Step 2: Pilih Kelas
    public function pilihKelas($mapelId)
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mapel = MataPelajaran::with('komponenNilai')->findOrFail($mapelId);
        $kelas = Kelas::withCount('siswa')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        // Validasi komponen nilai
        $totalBobot = $mapel->komponenNilai->sum('bobot');
        if ($totalBobot != 100) {
            return redirect()->route('komponen-nilai.index', $mapelId)
                ->with('error', 'Total bobot komponen harus 100%. Saat ini: ' . $totalBobot . '%');
        }

        return view('nilai.pilih-kelas', compact('mapel', 'kelas', 'tahunAjaranAktif'));
    }

    // Step 3: Input Nilai (Batch)
    public function show($mapelId, $kelasId)
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mapel = MataPelajaran::with('komponenNilai')->findOrFail($mapelId);
        $kelas = Kelas::findOrFail($kelasId);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Tidak ada tahun ajaran aktif!');
        }

        $siswa = Siswa::where('kelas_id', $kelasId)
            ->orderBy('nama')
            ->get()
            ->map(function ($s) use ($mapelId, $tahunAjaranAktif) {
                // Ambil nilai untuk mapel dan tahun ajaran ini
                $s->nilai_mapel = Nilai::where('siswa_id', $s->id)
                    ->where('mata_pelajaran_id', $mapelId)
                    ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                    ->first();
                return $s;
            });

        return view('nilai.batch-input-mapel', compact('mapel', 'kelas', 'siswa', 'tahunAjaranAktif'));
    }

    // Save Batch Input
    public function batchUpdate(Request $request, $mapelId, $kelasId)
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses untuk melakukan ini.');
        }

        $request->validate([
            'siswa' => 'required|array',
            'siswa.*.catatan' => 'nullable|array',
            'siswa.*.nilai_komponen' => 'required|array',
            'siswa.*.hadir' => 'required|integer|min:0',
            'siswa.*.izin' => 'required|integer|min:0',
            'siswa.*.sakit' => 'required|integer|min:0',
            'siswa.*.alfa' => 'required|integer|min:0',
        ]);

        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $guruId = auth()->id(); // Simpan ID guru yang input

        foreach ($request->siswa as $siswaId => $data) {
            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'mata_pelajaran_id' => $mapelId,
                    'tahun_ajaran_id' => $tahunAjaranAktif->id,
                ],
                [
                    'guru_id' => $guruId, // Simpan guru yang input
                    'catatan' => $data['catatan'] ?? [],
                    'nilai_komponen' => $data['nilai_komponen'],
                    'hadir' => $data['hadir'],
                    'izin' => $data['izin'],
                    'sakit' => $data['sakit'],
                    'alfa' => $data['alfa'],
                ]
            );
        }

        return redirect()->route('nilai.show-mapel', [$mapelId, $kelasId])
            ->with('success', 'Semua nilai berhasil disimpan!');
    }

    // === REKAP ===
    public function rekapIndex()
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses rekap
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mataPelajaran = MataPelajaran::all();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('nilai.rekap-pilih-mapel', compact('mataPelajaran', 'tahunAjaranAktif'));
    }

    public function rekapPilihKelas($mapelId)
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mapel = MataPelajaran::findOrFail($mapelId);
        $kelas = Kelas::withCount('siswa')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('nilai.rekap-pilih-kelas', compact('mapel', 'kelas', 'tahunAjaranAktif'));
    }

    public function rekapShow($mapelId, $kelasId)
    {
        $user = auth()->user();
        /** @var User $user */
        // Orang Tua tidak boleh akses
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mapel = MataPelajaran::with('komponenNilai')->findOrFail($mapelId);
        $kelas = Kelas::findOrFail($kelasId);
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Tidak ada tahun ajaran aktif!');
        }

        // Ambil semua siswa di kelas ini
        $siswa = Siswa::where('kelas_id', $kelasId)
            ->orderBy('nama')
            ->get()
            ->map(function ($s) use ($mapelId, $tahunAjaranAktif) {
                // Ambil nilai untuk mapel dan tahun ajaran ini
                $nilaiMapel = Nilai::where('siswa_id', $s->id)
                    ->where('mata_pelajaran_id', $mapelId)
                    ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                    ->first();

                if ($nilaiMapel) {
                    $s->nilai_mapel = $nilaiMapel;
                    $s->nilai_akhir = $nilaiMapel->nilai_akhir;
                } else {
                    $s->nilai_mapel = null;
                    $s->nilai_akhir = 0;
                }

                return $s;
            })
            ->filter(function ($s) {
                // Hanya siswa yang punya nilai
                return $s->nilai_mapel !== null;
            })
            ->sortByDesc('nilai_akhir')
            ->values();

        return view('nilai.rekap-show-mapel', compact('mapel', 'kelas', 'siswa', 'tahunAjaranAktif'));
    }
}
