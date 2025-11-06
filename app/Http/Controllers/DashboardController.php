<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Nilai;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        /** @var User $user */

        // Dashboard untuk Admin
        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'totalSiswa' => Siswa::count(),
                'totalKelas' => Kelas::count(),
                'totalGuru' => User::where('role', 'guru')->count(),
                'totalOrtu' => User::where('role', 'ortu')->count(),
            ]);
        }

        // Dashboard untuk Guru
        if ($user->isGuru()) {
            return view('dashboard.guru', [
                'totalNilai' => Nilai::where('guru_id', $user->id)->count(),
                'recentNilai' => Nilai::where('guru_id', $user->id)
                    ->with(['siswa', 'mataPelajaran'])
                    ->latest()
                    ->take(10)
                    ->get(),
            ]);
        }

        // Dashboard untuk Orang Tua
        if ($user->isOrtu()) {
            $siswa = $user->siswa()->with(['kelas', 'nilai.mataPelajaran'])->get();

            return view('dashboard.ortu', [
                'siswa' => $siswa,
            ]);
        }

        abort(403);
    }
}
