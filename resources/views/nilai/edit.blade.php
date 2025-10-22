{{-- resources/views/nilai/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Input Nilai - ' . $siswa->nama)

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-3xl font-bold mb-2">Input Nilai</h2>
    <p class="text-gray-600 mb-6">{{ $siswa->nama }} - {{ $siswa->nis }} - {{ $siswa->kelas->nama_kelas }}</p>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('nilai.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase">Komponen</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase">Input Nilai</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Catatan (Checkbox) -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Catatan (Paraf)</td>
                        <td class="px-6 py-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @php
                                    $totalParaf = 20; // Jumlah maksimal paraf
                                    $catatanList = old('catatan', $nilai->catatan ?? []);
                                    $catatanList = is_array($catatanList) ? $catatanList : [];
                                @endphp
                                
                                @for($i = 1; $i <= $totalParaf; $i++)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-blue-50 p-2 rounded">
                                    <input type="checkbox" name="catatan[]" value="Paraf {{ $i }}" 
                                        {{ in_array("Paraf {$i}", $catatanList) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 catatan-checkbox">
                                    <span class="text-sm text-gray-700">Paraf {{ $i }}</span>
                                </label>
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div>1 poin per paraf • Bobot 10%</div>
                            <div class="font-semibold text-blue-600 mt-1">
                                Total Dicentang: <span id="total-catatan">{{ count($catatanList) }}</span> paraf
                            </div>
                        </td>
                    </tr>

                    <!-- Nilai Tugas -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Nilai Tugas</td>
                        <td class="px-6 py-4">
                            <input type="number" name="nilai_tugas" step="0.01" min="0" max="100" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('nilai_tugas', $nilai->nilai_tugas ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Bobot 20% • Skala 0-100</td>
                    </tr>

                    <!-- Nilai Mid -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Nilai Mid Semester</td>
                        <td class="px-6 py-4">
                            <input type="number" name="nilai_mid" step="0.01" min="0" max="100" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('nilai_mid', $nilai->nilai_mid ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Bobot 30% • Skala 0-100</td>
                    </tr>

                    <!-- Nilai UAS -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Nilai UAS</td>
                        <td class="px-6 py-4">
                            <input type="number" name="nilai_uas" step="0.01" min="0" max="100" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('nilai_uas', $nilai->nilai_uas ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Bobot 40% • Skala 0-100</td>
                    </tr>

                    <!-- Kehadiran Header -->
                    <tr class="bg-blue-50">
                        <td colspan="3" class="px-6 py-3 font-bold text-gray-900 uppercase text-sm">
                            Data Kehadiran
                        </td>
                    </tr>

                    <!-- Hadir -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Hadir</td>
                        <td class="px-6 py-4">
                            <input type="number" name="hadir" min="0" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('hadir', $nilai->hadir ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Jumlah hari kehadiran</td>
                    </tr>

                    <!-- Izin -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Izin</td>
                        <td class="px-6 py-4">
                            <input type="number" name="izin" min="0" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('izin', $nilai->izin ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Tidak mengurangi nilai</td>
                    </tr>

                    <!-- Sakit -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Sakit</td>
                        <td class="px-6 py-4">
                            <input type="number" name="sakit" min="0" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('sakit', $nilai->sakit ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Tidak mengurangi nilai</td>
                    </tr>

                    <!-- Alfa -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">Alfa</td>
                        <td class="px-6 py-4">
                            <input type="number" name="alfa" min="0" 
                                class="w-32 border border-gray-300 rounded px-3 py-2" 
                                value="{{ old('alfa', $nilai->alfa ?? 0) }}" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-red-600 font-semibold">⚠️ Mengurangi 2 poin per alfa</td>
                    </tr>
                </tbody>
            </table>

            <!-- Submit Button -->
            <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end border-t border-gray-200">
                <a href="{{ route('nilai.show', $siswa->kelas_id) }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                    💾 Simpan Semua Nilai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Update counter saat checkbox dicentang/dilepas
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.catatan-checkbox');
    const counter = document.getElementById('total-catatan');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.catatan-checkbox:checked').length;
            counter.textContent = checkedCount;
        });
    });
});
</script>
@endsection