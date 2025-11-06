<?php
// app/Http/Controllers/KomponenNilaiController.php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\KomponenNilai;
use Illuminate\Http\Request;

class KomponenNilaiController extends Controller
{
    public function index($mapelId) // Ubah parameter menjadi $mapelId
    {
        $mapel = MataPelajaran::findOrFail($mapelId);
        $komponen = KomponenNilai::where('mata_pelajaran_id', $mapel->id)->orderBy('urutan')->get();

        return view('komponen-nilai.index', compact('mapel', 'komponen'));
    }

    public function store(Request $request, $mapelId) // Ubah parameter menjadi $mapelId
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'bobot' => 'required|integer|min:0|max:100',
        ]);

        $urutan = KomponenNilai::where('mata_pelajaran_id', $mapelId)->max('urutan') + 1;

        KomponenNilai::create([
            'mata_pelajaran_id' => $mapelId,
            'nama_komponen' => $request->nama_komponen,
            'bobot' => $request->bobot,
            'urutan' => $urutan,
        ]);

        return redirect()->route('komponen-nilai.index', ['mapelId' => $mapelId]) // Sesuaikan parameter
            ->with('success', 'Komponen nilai berhasil ditambahkan');
    }

    public function update(Request $request, $mapelId, $id) // Ubah parameter menjadi $mapelId
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'bobot' => 'required|integer|min:0|max:100',
        ]);

        $komponen = KomponenNilai::findOrFail($id);
        $komponen->update($request->only(['nama_komponen', 'bobot']));

        return redirect()->route('komponen-nilai.index', ['mapelId' => $mapelId]) // Sesuaikan parameter
            ->with('success', 'Komponen nilai berhasil diperbarui');
    }

    public function destroy($mapelId, $id) // Ubah parameter menjadi $mapelId
    {
        $komponen = KomponenNilai::findOrFail($id);
        $komponen->delete();

        return redirect()->route('komponen-nilai.index', ['mapelId' => $mapelId]) // Sesuaikan parameter
            ->with('success', 'Komponen nilai berhasil dihapus');
    }
}
