<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Nilai;
use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Belum ada tahun ajaran aktif.');
        }

        // Orang Tua: hanya bisa lihat rapor anak mereka
        if ($user->isOrtu()) {
            $siswaList = $user->siswa()->with('kelas')->get();
            return view('rapor.index-ortu', compact('siswaList', 'tahunAjaranAktif'));
        }

        // Admin & Guru: bisa lihat semua kelas
        $kelas = Kelas::withCount('siswa')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('rapor.index', compact('kelas', 'tahunAjaranAktif'));
    }

    public function showKelas($kelasId)
    {
        $user = auth()->user();

        // Orang Tua tidak boleh akses halaman per kelas
        if ($user->isOrtu()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kelas = Kelas::findOrFail($kelasId);
        $siswa = Siswa::where('kelas_id', $kelasId)->orderBy('nama')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('rapor.kelas', compact('kelas', 'siswa', 'tahunAjaranAktif'));
    }

    public function showSiswa($siswaId)
    {
        $user = auth()->user();
        $siswa = Siswa::with('kelas')->findOrFail($siswaId);

        // Orang Tua: hanya bisa lihat rapor anak mereka sendiri
        if ($user->isOrtu()) {
            if ($siswa->user_id !== $user->id) {
                abort(403, 'Anda tidak memiliki akses untuk melihat rapor siswa ini.');
            }
        }

        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        // Ambil semua mapel
        $mataPelajaran = MataPelajaran::with('komponenNilai')->get();

        // Ambil nilai siswa untuk semua mapel
        $nilaiPerMapel = [];
        $totalNilai = 0;
        $jumlahMapel = 0;

        foreach ($mataPelajaran as $mapel) {
            $nilai = Nilai::where('siswa_id', $siswaId)
                ->where('mata_pelajaran_id', $mapel->id)
                ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                ->first();

            if ($nilai) {
                $nilaiPerMapel[$mapel->id] = [
                    'mapel' => $mapel,
                    'nilai' => $nilai,
                    'nilai_akhir' => $nilai->nilai_akhir
                ];
                $totalNilai += $nilai->nilai_akhir;
                $jumlahMapel++;
            }
        }

        $rataRata = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;

        // Hitung ranking di kelas
        $siswaKelas = Siswa::where('kelas_id', $siswa->kelas_id)->get();
        $rankingData = [];

        foreach ($siswaKelas as $s) {
            $totalNilaiSiswa = 0;
            $jumlahMapelSiswa = 0;

            foreach ($mataPelajaran as $mapel) {
                $nilaiSiswa = Nilai::where('siswa_id', $s->id)
                    ->where('mata_pelajaran_id', $mapel->id)
                    ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                    ->first();

                if ($nilaiSiswa) {
                    $totalNilaiSiswa += $nilaiSiswa->nilai_akhir;
                    $jumlahMapelSiswa++;
                }
            }

            if ($jumlahMapelSiswa > 0) {
                $rankingData[$s->id] = $totalNilaiSiswa / $jumlahMapelSiswa;
            }
        }

        arsort($rankingData);
        $ranking = array_search($siswaId, array_keys($rankingData)) + 1;

        return view('rapor.siswa', compact('siswa', 'tahunAjaranAktif', 'nilaiPerMapel', 'rataRata', 'ranking', 'jumlahMapel'));
    }

    public function printSiswa($siswaId)
    {
        $user = auth()->user();
        $siswa = Siswa::with('kelas')->findOrFail($siswaId);

        // Orang Tua: hanya bisa print rapor anak mereka sendiri
        if ($user->isOrtu()) {
            if ($siswa->user_id !== $user->id) {
                abort(403, 'Anda tidak memiliki akses untuk mencetak rapor siswa ini.');
            }
        }

        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $mataPelajaran = MataPelajaran::with('komponenNilai')->get();

        $nilaiPerMapel = [];
        $totalNilai = 0;
        $jumlahMapel = 0;

        // Hitung total kehadiran dari semua mapel
        $totalSakit = 0;
        $totalIzin = 0;
        $totalAlfa = 0;

        foreach ($mataPelajaran as $mapel) {
            $nilai = Nilai::where('siswa_id', $siswaId)
                ->where('mata_pelajaran_id', $mapel->id)
                ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                ->first();

            if ($nilai) {
                $nilaiPerMapel[] = [
                    'mapel' => $mapel,
                    'nilai' => $nilai,
                    'nilai_akhir' => $nilai->nilai_akhir
                ];
                $totalNilai += $nilai->nilai_akhir;
                $jumlahMapel++;

                // Akumulasi kehadiran
                $totalSakit += $nilai->sakit;
                $totalIzin += $nilai->izin;
                $totalAlfa += $nilai->alfa;
            }
        }

        $rataRata = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;

        // Tambahkan data kehadiran ke siswa
        $siswa->totalSakit = $totalSakit;
        $siswa->totalIzin = $totalIzin;
        $siswa->totalAlfa = $totalAlfa;

        return view('rapor.print', compact('siswa', 'tahunAjaranAktif', 'nilaiPerMapel', 'rataRata', 'jumlahMapel'));
    }

    public function printSiswaDongkrak($siswaId)
    {
        $user = auth()->user();
        $siswa = Siswa::with('kelas')->findOrFail($siswaId);

        // HANYA Admin & Guru yang bisa print dongkrak
        if ($user->isOrtu()) {
            abort(403, 'Orang tua tidak memiliki akses untuk mencetak rapor nilai dongkrak.');
        }

        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $mataPelajaran = MataPelajaran::with('komponenNilai')->get();

        $nilaiPerMapel = [];
        $totalNilai = 0;
        $jumlahMapel = 0;

        // Hitung total kehadiran dari semua mapel
        $totalSakit = 0;
        $totalIzin = 0;
        $totalAlfa = 0;

        foreach ($mataPelajaran as $mapel) {
            $nilai = Nilai::where('siswa_id', $siswaId)
                ->where('mata_pelajaran_id', $mapel->id)
                ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
                ->first();

            if ($nilai) {
                // Gunakan nilai dongkrak jika ada, jika tidak pakai nilai asli
                $nilaiAkhir = $nilai->nilai_dongkrak ?? $nilai->nilai_akhir;

                $nilaiPerMapel[] = [
                    'mapel' => $mapel,
                    'nilai' => $nilai,
                    'nilai_akhir' => $nilaiAkhir
                ];
                $totalNilai += $nilaiAkhir;
                $jumlahMapel++;

                // Akumulasi kehadiran
                $totalSakit += $nilai->sakit;
                $totalIzin += $nilai->izin;
                $totalAlfa += $nilai->alfa;
            }
        }

        $rataRata = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;

        // Tambahkan data kehadiran ke siswa
        $siswa->totalSakit = $totalSakit;
        $siswa->totalIzin = $totalIzin;
        $siswa->totalAlfa = $totalAlfa;

        return view('rapor.print-dongkrak', compact('siswa', 'tahunAjaranAktif', 'nilaiPerMapel', 'rataRata', 'jumlahMapel'));
    }
}
