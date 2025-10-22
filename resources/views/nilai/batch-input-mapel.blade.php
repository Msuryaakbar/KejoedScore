@extends('layouts.app')

@section('title', 'Input Nilai - ' . $mapel->nama_mapel . ' - ' . $kelas->nama_kelas)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Input Nilai - {{ $mapel->nama_mapel }} - {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('nilai.pilih-kelas', $mapel->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
    
    <div class="mt-3 inline-block px-4 py-2 bg-green-100 text-green-800 rounded-lg ml-4">
        {{ $tahunAjaranAktif->nama_lengkap }}
    </div>
</div>

<!-- Info Komponen -->
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
    <h3 class="font-bold text-blue-900 mb-2">📋 Komponen Penilaian:</h3>
    <div class="flex flex-wrap gap-2 mb-3">
        @foreach($mapel->komponenNilai as $komponen)
        <span class="px-3 py-1 bg-blue-200 text-blue-900 rounded-full text-sm font-semibold">
            {{ $komponen->nama_komponen }} ({{ $komponen->bobot }}%)
        </span>
        @endforeach
    </div>
    <div class="text-sm text-blue-800 bg-white rounded p-3">
        <p class="font-semibold mb-2">📌 Catatan Tambahan:</p>
        <ul class="list-disc list-inside ml-2 space-y-1">
            <li><span class="text-purple-700 font-semibold">Catatan/Paraf:</span> Bonus <span class="font-bold">+1 poin per paraf</span> (maksimal +10 poin)</li>
            <li><span class="text-red-700 font-semibold">Alfa:</span> Pengurangan <span class="font-bold">-2 poin per kejadian</span></li>
            <li><span class="text-gray-700 font-semibold">Nilai Akhir:</span> Maksimal 100, minimal 0</li>
        </ul>
    </div>
</div>

<form action="{{ route('nilai.batch.update-mapel', [$mapel->id, $kelas->id]) }}" method="POST" id="formNilai">
    @csrf
    
    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-600">Total Siswa: <span class="font-bold text-blue-600">{{ $siswa->count() }}</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300">No</th>
                    <th rowspan="2" class="px-4 py-3 text-center border border-gray-300 min-w-[200px]">Nama Siswa</th>
                    <th rowspan="2" class="px-4 py-3 text-center border border-gray-300">NIS</th>
                    <th colspan="6" class="px-2 py-2 text-center border border-gray-300 bg-purple-100">Catatan/Paraf (Bonus)</th>
                    
                    @foreach($mapel->komponenNilai as $komponen)
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-blue-50">
                        {{ $komponen->nama_komponen }}<br>
                        <small class="text-xs">({{ $komponen->bobot }}%)</small>
                    </th>
                    @endforeach
                    
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-green-50">Hadir</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-yellow-50">Izin</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-cyan-50">Sakit</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-red-50">Alfa</th>
                </tr>
                <tr>
                    @for($i = 1; $i <= 6; $i++)
                    <th class="px-2 py-2 text-center border border-gray-300 bg-purple-50 text-xs">C{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $index => $s)
                @php
                    $nilaiSiswa = $s->nilai_mapel;
                    $catatan = ($nilaiSiswa && is_array($nilaiSiswa->catatan)) ? $nilaiSiswa->catatan : [];
                    $nilaiKomponen = ($nilaiSiswa && is_array($nilaiSiswa->nilai_komponen)) ? $nilaiSiswa->nilai_komponen : [];
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-3 text-center border border-gray-300">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 border border-gray-300">{{ $s->nama }}</td>
                    <td class="px-4 py-3 text-center border border-gray-300">{{ $s->nis }}</td>
                    
                    @for($i = 1; $i <= 6; $i++)
                    <td class="px-2 py-3 text-center border border-gray-300">
                        <input type="checkbox" 
                            name="siswa[{{ $s->id }}][catatan][]" 
                            value="Catatan {{ $i }}"
                            {{ in_array("Catatan {$i}", $catatan) ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 rounded cursor-pointer">
                    </td>
                    @endfor
                    
                    @foreach($mapel->komponenNilai as $komponen)
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][nilai_komponen][{{ $komponen->id }}]" 
                            value="{{ isset($nilaiKomponen[$komponen->id]) ? $nilaiKomponen[$komponen->id] : 0 }}"
                            min="0" max="100" step="0.01"
                            class="w-20 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    @endforeach
                    
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" name="siswa[{{ $s->id }}][hadir]" 
                            value="{{ $nilaiSiswa ? $nilaiSiswa->hadir : 0 }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" name="siswa[{{ $s->id }}][izin]" 
                            value="{{ $nilaiSiswa ? $nilaiSiswa->izin : 0 }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" name="siswa[{{ $s->id }}][sakit]" 
                            value="{{ $nilaiSiswa ? $nilaiSiswa->sakit : 0 }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" name="siswa[{{ $s->id }}][alfa]" 
                            value="{{ $nilaiSiswa ? $nilaiSiswa->alfa : 0 }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('nilai.pilih-kelas', $mapel->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded font-semibold">
            Batal
        </a>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-semibold">
            💾 Simpan Nilai ({{ $siswa->count() }} siswa)
        </button>
    </div>
</form>

<script>
document.getElementById('formNilai').addEventListener('submit', function(e) {
    if (!confirm('Yakin ingin menyimpan semua nilai?')) {
        e.preventDefault();
    }
});
</script>
@endsection