<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('export.index', compact('kelas'));
    }

    public function export($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $fileName = 'Nilai_' . $kelas->nama_kelas . '_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new NilaiExport($kelasId), $fileName);
    }
}
