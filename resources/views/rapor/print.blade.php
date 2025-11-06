<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor {{ $siswa->nama }} - {{ $tahunAjaranAktif->nama_lengkap }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            position: relative;
        }

        /* Watermark Logo */
        body::before {
            content: "";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            background-image: url('{{ asset('images/smp.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.05;
            z-index: -1;
        }

        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 10mm;
            position: relative;
            z-index: 1;
        }
        
        /* Header */
        .header-identity {
            margin-bottom: 15px;
        }
        .header-identity table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-identity td {
            padding: 3px 0;
            vertical-align: top;
        }
        .header-identity .label {
            width: 150px;
            padding-right: 10px;
        }
        .header-identity .separator {
            width: 10px;
            text-align: center;
        }
        .header-identity .value {
            font-weight: normal;
        }
        
        /* Section Title */
        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin: 20px 0 15px 0;
            text-transform: uppercase;
        }
        
        /* Main Table */
        table.main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.main-table th,
        table.main-table td {
            border: 1px solid #000;
            padding: 8px 6px;
            vertical-align: top;
        }
        table.main-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }
        table.main-table .col-no { width: 30px; text-align: center; }
        table.main-table .col-mapel { width: 140px; }
        table.main-table .col-nilai { width: 60px; text-align: center; }
        table.main-table .col-predikat { width: 60px; text-align: center; font-weight: bold; font-size: 12pt; }
        table.main-table .col-deskripsi { }
        
        /* Ekskul Table */
        table.ekskul-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.ekskul-table th,
        table.ekskul-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        table.ekskul-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }
        
        /* Attendance Table */
        table.attendance-table {
            width: 350px;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.attendance-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        table.attendance-table .label {
            width: 200px;
            font-weight: normal;
        }
        table.attendance-table .separator {
            width: 10px;
            text-align: center;
        }
        table.attendance-table .value {
            width: 140px;
            text-align: left;
        }
        
        /* Notes Box */
        .notes-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 80px;
            margin-bottom: 15px;
            font-style: italic;
        }
        
        /* Signature Area */
        .signature-area {
            margin-top: 30px;
            display: table;
            width: 100%;
        }
        .signature-box {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }
        .signature-box .title {
            margin-bottom: 5px;
        }
        .signature-box .date {
            margin-bottom: 60px;
        }
        .signature-box .name {
            border-top: 1px solid #000;
            padding-top: 5px;
            display: inline-block;
            min-width: 150px;
        }
        .signature-box .nip {
            font-size: 9pt;
            margin-top: 3px;
        }
        
        /* Print Styles */
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
            .container { padding: 0; }
            body::before {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
        
        /* Predikat Colors */
        .predikat-A { background-color: #d4edda; }
        .predikat-B { background-color: #cce5ff; }
        .predikat-C { background-color: #fff3cd; }
        .predikat-D { background-color: #f8d7da; }
        .predikat-E { background-color: #f5c6cb; }
    </style>
</head>
<body>
    <!-- Print Button -->
    <div class="no-print" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
        <button onclick="window.print()" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 12pt; margin-right: 5px;">
            🖨️ Print / PDF
        </button>
        <button onclick="window.close()" style="background: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 12pt;">
            ✖ Tutup
        </button>
    </div>

    <div class="container">
        <!-- Header Identity -->
        <div class="header-identity">
            <table>
                <tr>
                    <td class="label">Nama</td>
                    <td class="separator">:</td>
                    <td class="value">{{ strtoupper($siswa->nama) }}</td>
                    <td class="label" style="width: 150px;">Kelas</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $siswa->kelas->nama_kelas }}</td>
                </tr>
                <tr>
                    <td class="label">NIS/NISN</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $siswa->nis }}</td>
                    <td class="label">Fase</td>
                    <td class="separator">:</td>
                    <td class="value">{{ substr($siswa->kelas->nama_kelas, 0, 1) <= 7 ? 'D' : 'E' }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Sekolah</td>
                    <td class="separator">:</td>
                    <td class="value">SMP Muhammadiyah 16 Lubuk Pakam</td>
                    <td class="label">Semester</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $tahunAjaranAktif->semester }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat</td>
                    <td class="separator">:</td>
                    <td class="value">Jl.R.A. Kartini No.1 Lubuk Pakam</td>
                    <td class="label">Tahun Pelajaran</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $tahunAjaranAktif->tahun }}</td>
                </tr>
            </table>
        </div>

        <!-- Main Content -->
        <div class="section-title">LAPORAN HASIL BELAJAR</div>

        <!-- Main Table -->
        <table class="main-table">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-mapel">Mata Pelajaran</th>
                    <th class="col-nilai">Nilai Akhir</th>
                    <th class="col-predikat">Predikat</th>
                    <th class="col-deskripsi">Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiPerMapel as $index => $data)
                @php
                    $nilai = $data['nilai'];
                    $mapel = $data['mapel'];
                    $nilaiAkhir = $data['nilai_akhir'];
                    
                    // Predikat
                    if ($nilaiAkhir >= 90) {
                        $predikat = 'A';
                        $predikatClass = 'predikat-A';
                        $deskripsiAwal = 'Mencapai Kompetensi dengan sangat baik';
                    } elseif ($nilaiAkhir >= 80) {
                        $predikat = 'B';
                        $predikatClass = 'predikat-B';
                        $deskripsiAwal = 'Mencapai Kompetensi dengan baik';
                    } elseif ($nilaiAkhir >= 70) {
                        $predikat = 'C';
                        $predikatClass = 'predikat-C';
                        $deskripsiAwal = 'Mencapai Kompetensi dengan cukup baik';
                    } elseif ($nilaiAkhir >= 60) {
                        $predikat = 'D';
                        $predikatClass = 'predikat-D';
                        $deskripsiAwal = 'Belum mencapai kompetensi secara optimal';
                    } else {
                        $predikat = 'E';
                        $predikatClass = 'predikat-E';
                        $deskripsiAwal = 'Perlu bimbingan intensif untuk mencapai kompetensi';
                    }
                    
                    // Generate deskripsi detail berdasarkan komponen
                    $komponenTertinggi = '';
                    $komponenTerendah = '';
                    $nilaiTertinggi = 0;
                    $nilaiTerendah = 100;
                    
                    if ($nilai->nilai_komponen) {
                        foreach ($mapel->komponenNilai as $komp) {
                            if (isset($nilai->nilai_komponen[$komp->id])) {
                                $nilaiKomp = $nilai->nilai_komponen[$komp->id];
                                if ($nilaiKomp > $nilaiTertinggi) {
                                    $nilaiTertinggi = $nilaiKomp;
                                    $komponenTertinggi = $komp->nama_komponen;
                                }
                                if ($nilaiKomp < $nilaiTerendah) {
                                    $nilaiTerendah = $nilaiKomp;
                                    $komponenTerendah = $komp->nama_komponen;
                                }
                            }
                        }
                    }
                @endphp
                <tr>
                    <td class="col-no">{{ $index + 1 }}</td>
                    <td class="col-mapel"><strong>{{ $mapel->nama_mapel }}</strong></td>
                    <td class="col-nilai"><strong>{{ number_format($nilaiAkhir, 0) }}</strong></td>
                    <td class="col-predikat {{ $predikatClass }}">{{ $predikat }}</td>
                    <td class="col-deskripsi">
                        {{ $deskripsiAwal }} dalam hal {{ strtolower($mapel->nama_mapel) }}.
                        @if($komponenTertinggi)
                        Menunjukkan pemahaman yang baik dalam {{ strtolower($komponenTertinggi) }} dengan nilai {{ number_format($nilaiTertinggi, 0) }}.
                        @endif
                        @if($komponenTerendah && $komponenTerendah != $komponenTertinggi)
                        Perlu peningkatan dalam hal {{ strtolower($komponenTerendah) }}.
                        @endif
                        @if($nilai->total_catatan >= 8)
                        Menunjukkan keaktifan dan partisipasi yang sangat baik dalam pembelajaran dengan {{ $nilai->total_catatan }} catatan.
                        @elseif($nilai->total_catatan >= 5)
                        Memiliki keaktifan yang baik dalam pembelajaran.
                        @else
                        Perlu meningkatkan keaktifan dan partisipasi dalam pembelajaran.
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Ekstrakurikuler -->
        <div class="section-title" style="font-size: 11pt; text-align: left; margin-top: 20px; margin-bottom: 10px;">
            Kegiatan Ekstrakurikuler
        </div>
        <table class="ekskul-table">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th style="width: 250px;">Kegiatan Ekstrakurikuler</th>
                    <th style="width: 120px;">Predikat</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="height: 30px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 30px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 30px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Kehadiran -->
        @php
            $nilaiKehadiran = !empty($nilaiPerMapel) ? $nilaiPerMapel[array_key_first($nilaiPerMapel)]['nilai'] : null;
        @endphp

        <table class="attendance-table">
            <tr>
                <td class="label">Hadir</td>
                <td class="separator">:</td>
                <td class="value">{{ $nilaiKehadiran->hadir ?? 0 }} hari</td>
            </tr>
            <tr>
                <td class="label">Izin</td>
                <td class="separator">:</td>
                <td class="value">{{ $nilaiKehadiran->izin ?? 0 }} hari</td>
            </tr>
            <tr>
                <td class="label">Sakit</td>
                <td class="separator">:</td>
                <td class="value">{{ $nilaiKehadiran->sakit ?? 0 }} hari</td>
            </tr>
            <tr>
                <td class="label">Tanpa Keterangan</td>
                <td class="separator">:</td>
                <td class="value">{{ $nilaiKehadiran->alfa ?? 0 }} hari</td>
            </tr>
        </table>

        <!-- Catatan Wali Kelas -->
        <div style="margin-bottom: 5px; font-weight: bold;">Catatan Wali Kelas</div>
        <div class="notes-box">
            {{-- @if($rataRata >= 85)
            Alhamdulillah, prestasi yang sangat baik. Pertahankan dan tingkatkan terus semangat belajarmu!
            @elseif($rataRata >= 75)
            Prestasi yang baik, tingkatkan lagi usaha dan semangat belajarmu untuk mencapai hasil yang lebih maksimal.
            @else
            Tingkatkan lagi usaha dan semangat belajarmu. Jangan ragu untuk bertanya kepada guru jika ada kesulitan.
            @endif --}}
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <div class="title">Mengetahui,</div>
                <div class="title">Orang Tua/Wali,</div>
                <div class="date">&nbsp;</div>
                <div class="name">__________________</div>
            </div>
            <div class="signature-box">
                <div class="title">Lubuk Pakam, _______________</div>
                <div class="title">Wali Kelas,</div>
                <div class="date">&nbsp;</div>
                <div class="name">__________________</div>
                <div class="nip">NBM. ___________________</div>
            </div>
            <div class="signature-box">
                <div class="title">Mengetahui,</div>
                <div class="title">Kepala Sekolah,</div>
                <div class="date">&nbsp;</div>
                <div class="name">Ujang Suhandi, S.Pd.</div>
                <div class="nip">NBM. ___________________</div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; font-size: 9pt; color: #666;">
            <hr style="border: none; border-top: 1px solid #ccc; margin-bottom: 5px;">
            {{ strtoupper($siswa->nama) }} | {{ $siswa->nis }} | Halaman 1
        </div>
    </div>
</body>
</html>