@extends('layouts.app')

@section('title', 'Input Nilai ' . $kelas->nama_kelas)

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Input Nilai - {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('nilai.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">← Kembali</a>
</div>

<form action="{{ route('nilai.batch.update', $kelas->id) }}" method="POST" id="formNilai">
    @csrf
    
    <!-- Filter/Info -->
    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="font-semibold">Jumlah Catatan:</label>
                <input type="number" id="jumlah-catatan" value="6" min="1" max="20" 
                    class="w-20 border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex items-center gap-2">
                <label class="font-semibold">Jumlah Tugas:</label>
                <input type="number" id="jumlah-tugas" value="1" min="1" max="10" 
                    class="w-20 border border-gray-300 rounded px-3 py-2">
            </div>
            <button type="button" id="btnUpdate" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-semibold">
                🔄 Update Tabel
            </button>
            <div class="ml-auto text-gray-600">
                <span class="font-semibold">Total: {{ $siswa->count() }} siswa</span>
            </div>
        </div>
    </div>

    <!-- Tabel Input -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm border-collapse" id="tabelNilai">
            <thead class="bg-gray-100">
                <tr>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-gray-200">No</th>
                    <th rowspan="2" class="px-4 py-3 text-center border border-gray-300 bg-gray-200 min-w-[200px]">Nama Siswa</th>
                    <th rowspan="2" class="px-4 py-3 text-center border border-gray-300 bg-gray-200">NIS</th>
                    
                    <th colspan="6" class="px-2 py-2 text-center border border-gray-300 bg-purple-100" id="headerCatatan">Catatan</th>
                    <th colspan="1" class="px-2 py-2 text-center border border-gray-300 bg-green-100" id="headerTugas">Tugas</th>
                    
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-orange-100">MID</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-pink-100">UAS</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-blue-100">Hadir</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-yellow-100">Izin</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-cyan-100">Sakit</th>
                    <th rowspan="2" class="px-3 py-3 text-center border border-gray-300 bg-red-100">Alfa</th>
                </tr>
                <tr id="headerDetail">
                    @for($i = 1; $i <= 6; $i++)
                    <th class="px-2 py-2 text-center border border-gray-300 bg-purple-50 text-xs catatan-subheader">C{{ $i }}</th>
                    @endfor
                    <th class="px-2 py-2 text-center border border-gray-300 bg-green-50 text-xs tugas-subheader">T1</th>
                </tr>
            </thead>
            <tbody id="bodyTabel">
                @foreach($siswa as $index => $s)
                @php
                    $nilai = $s->nilai;
                    $catatan = $nilai ? $nilai->catatan : [];
                @endphp
                <tr class="hover:bg-gray-50" data-siswa-id="{{ $s->id }}">
                    <td class="px-3 py-3 text-center border border-gray-300">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 border border-gray-300">{{ $s->nama }}</td>
                    <td class="px-4 py-3 text-center border border-gray-300">{{ $s->nis }}</td>
                    
                    @for($i = 1; $i <= 6; $i++)
                    <td class="px-2 py-3 text-center border border-gray-300 catatan-cell" data-index="{{ $i }}">
                        <input type="checkbox" 
                            name="siswa[{{ $s->id }}][catatan][]" 
                            value="Catatan {{ $i }}"
                            {{ in_array("Catatan {$i}", $catatan) ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 rounded cursor-pointer">
                    </td>
                    @endfor
                    
                    <td class="px-2 py-3 border border-gray-300 tugas-cell" data-index="1">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][tugas][1]" 
                            value="{{ old("siswa.{$s->id}.tugas.1", $nilai ? $nilai->nilai_tugas : 0) }}"
                            min="0" max="100" step="0.01"
                            class="w-20 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][nilai_mid]" 
                            value="{{ old("siswa.{$s->id}.nilai_mid", $nilai ? $nilai->nilai_mid : 0) }}"
                            min="0" max="100" step="0.01"
                            class="w-20 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][nilai_uas]" 
                            value="{{ old("siswa.{$s->id}.nilai_uas", $nilai ? $nilai->nilai_uas : 0) }}"
                            min="0" max="100" step="0.01"
                            class="w-20 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][hadir]" 
                            value="{{ old("siswa.{$s->id}.hadir", $nilai ? $nilai->hadir : 0) }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][izin]" 
                            value="{{ old("siswa.{$s->id}.izin", $nilai ? $nilai->izin : 0) }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][sakit]" 
                            value="{{ old("siswa.{$s->id}.sakit", $nilai ? $nilai->sakit : 0) }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                    <td class="px-2 py-3 border border-gray-300">
                        <input type="number" 
                            name="siswa[{{ $s->id }}][alfa]" 
                            value="{{ old("siswa.{$s->id}.alfa", $nilai ? $nilai->alfa : 0) }}"
                            min="0" class="w-16 border border-gray-300 rounded px-2 py-2 text-center" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('nilai.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded font-semibold">
            Batal
        </a>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-semibold">
            💾 Simpan Nilai ({{ $siswa->count() }} siswa)
        </button>
    </div>
</form>

<script>
document.getElementById('btnUpdate').addEventListener('click', updateTabel);

function updateTabel() {
    const jumlahCatatan = parseInt(document.getElementById('jumlah-catatan').value);
    const jumlahTugas = parseInt(document.getElementById('jumlah-tugas').value);
    
    if (jumlahCatatan < 1 || jumlahCatatan > 20) {
        alert('Jumlah catatan harus antara 1-20');
        return;
    }
    
    if (jumlahTugas < 1 || jumlahTugas > 10) {
        alert('Jumlah tugas harus antara 1-10');
        return;
    }
    
    // Update colspan
    document.getElementById('headerCatatan').setAttribute('colspan', jumlahCatatan);
    document.getElementById('headerTugas').setAttribute('colspan', jumlahTugas);
    
    // Update sub-headers
    updateSubHeaders(jumlahCatatan, jumlahTugas);
    
    // Update body cells
    updateBodyCells(jumlahCatatan, jumlahTugas);
    
    alert('Tabel berhasil diupdate!\nCatatan: ' + jumlahCatatan + ' kolom\nTugas: ' + jumlahTugas + ' kolom');
}

function updateSubHeaders(jumlahCatatan, jumlahTugas) {
    const headerDetail = document.getElementById('headerDetail');
    
    // Remove old headers
    headerDetail.querySelectorAll('.catatan-subheader, .tugas-subheader').forEach(el => el.remove());
    
    // Add catatan headers
    for (let i = 1; i <= jumlahCatatan; i++) {
        const th = document.createElement('th');
        th.className = 'px-2 py-2 text-center border border-gray-300 bg-purple-50 text-xs catatan-subheader';
        th.textContent = 'C' + i;
        headerDetail.appendChild(th);
    }
    
    // Add tugas headers
    for (let i = 1; i <= jumlahTugas; i++) {
        const th = document.createElement('th');
        th.className = 'px-2 py-2 text-center border border-gray-300 bg-green-50 text-xs tugas-subheader';
        th.textContent = 'T' + i;
        headerDetail.appendChild(th);
    }
}

function updateBodyCells(jumlahCatatan, jumlahTugas) {
    document.querySelectorAll('#bodyTabel tr').forEach(row => {
        const siswaId = row.getAttribute('data-siswa-id');
        
        // Save old values
        const catatanChecked = [];
        row.querySelectorAll('.catatan-cell input:checked').forEach(cb => {
            const idx = parseInt(cb.closest('td').getAttribute('data-index'));
            catatanChecked.push(idx);
        });
        
        const tugasValues = [];
        row.querySelectorAll('.tugas-cell input').forEach(inp => {
            tugasValues.push(inp.value);
        });
        
        // Remove old cells
        row.querySelectorAll('.catatan-cell, .tugas-cell').forEach(el => el.remove());
        
        // Get reference cell (NIS)
        const nisCell = row.children[2];
        
        // Add catatan cells
        for (let i = jumlahCatatan; i >= 1; i--) {
            const td = document.createElement('td');
            td.className = 'px-2 py-3 text-center border border-gray-300 catatan-cell';
            td.setAttribute('data-index', i);
            
            const cb = document.createElement('input');
            cb.type = 'checkbox';
            cb.name = 'siswa[' + siswaId + '][catatan][]';
            cb.value = 'Catatan ' + i;
            cb.className = 'w-5 h-5 text-purple-600 rounded cursor-pointer';
            if (catatanChecked.includes(i)) cb.checked = true;
            
            td.appendChild(cb);
            nisCell.insertAdjacentElement('afterend', td);
        }
        
        // Add tugas cells after last catatan
        const lastCatatan = row.querySelector('.catatan-cell:last-of-type');
        for (let i = 1; i <= jumlahTugas; i++) {
            const td = document.createElement('td');
            td.className = 'px-2 py-3 border border-gray-300 tugas-cell';
            td.setAttribute('data-index', i);
            
            const inp = document.createElement('input');
            inp.type = 'number';
            inp.name = 'siswa[' + siswaId + '][tugas][' + i + ']';
            inp.value = tugasValues[i-1] || 0;
            inp.min = 0;
            inp.max = 100;
            inp.step = 0.01;
            inp.required = true;
            inp.className = 'w-20 border border-gray-300 rounded px-2 py-2 text-center';
            
            td.appendChild(inp);
            lastCatatan.insertAdjacentElement('afterend', td);
        }
    });
}

document.getElementById('formNilai').addEventListener('submit', function(e) {
    if (!confirm('Yakin ingin menyimpan semua nilai?')) {
        e.preventDefault();
    }
});
</script>
@endsection