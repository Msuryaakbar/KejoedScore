<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')
            ->orderBy('nama')
            ->paginate(10); // 10 item per halaman

        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();

        if ($kelas->isEmpty()) {
            return redirect()->route('kelas.index')
                ->with('error', 'Silakan tambahkan kelas terlebih dahulu sebelum menambahkan siswa.');
        }

        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:siswa,nis',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama.required' => 'Nama siswa wajib diisi',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain',
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('kelas', 'nilai');
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:siswa,nis,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama.required' => 'Nama siswa wajib diisi',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain',
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Gagal menghapus siswa: ' . $e->getMessage());
        }
    }
}
