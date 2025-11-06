<?php
// app/Http/Controllers/MataPelajaranController.php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajaran = MataPelajaran::withCount('komponenNilai') // Ganti ke camelCase
            ->orderBy('nama_mapel')
            ->paginate(9);

        return view('mata-pelajaran.index', compact('mataPelajaran'));
    }

    public function create()
    {
        return view('mata-pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel',
            'deskripsi' => 'nullable|string',
        ]);

        MataPelajaran::create($request->all());
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('mata-pelajaran.edit', compact('mataPelajaran'));
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel,' . $mataPelajaran->id,
            'deskripsi' => 'nullable|string',
        ]);

        $mataPelajaran->update($request->all());
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
