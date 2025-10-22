<?php
// app/Http/Controllers/TahunAjaranController.php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::orderBy('tahun', 'desc')->orderBy('semester', 'desc')->get();
        return view('tahun-ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'semester' => 'required|in:1,2',
        ]);

        TahunAjaran::create($request->all());
        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function setActive($id)
    {
        // Set semua jadi tidak aktif
        TahunAjaran::query()->update(['is_active' => false]);

        // Set yang dipilih jadi aktif
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update(['is_active' => true]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran aktif berhasil diatur');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete();
        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus');
    }
}
