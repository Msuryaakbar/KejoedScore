@extends('layouts.app')

@section('title', 'Input Nilai Dongkrak')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="gradient-bg text-white py-6 px-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Input Nilai Dongkrak</h1>
                    <p class="text-blue-100 mt-1">Sistem Penyesuaian Nilai Siswa</p>
                </div>
                <div class="bg-white/20 p-2 rounded-full">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <!-- Navigation & Info -->
        <div class="mb-8">
            <a href="{{ route('nilai-dongkrak.show-kelas', $siswa->kelas_id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 mb-4">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Daftar Siswa</span>
            </a>
            
            <div class="bg-white rounded-xl shadow-md card-hover p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Input Nilai Dongkrak</h2>
                        <div class="flex flex-wrap gap-4 mt-3">
                            <div class="flex items-center">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                <span class="text-gray-700"><strong>Nama:</strong> {{ $siswa->nama }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-id-card text-blue-500 mr-2"></i>
                                <span class="text-gray-700"><strong>NIS:</strong> {{ $siswa->nis }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-500 mr-2"></i>
                                <span class="text-gray-700"><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($nilaiList->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-yellow-800 font-semibold">Belum ada nilai untuk siswa ini!</h3>
                        <p class="text-yellow-700 mt-1 text-sm">Nilai asli harus diinput terlebih dahulu oleh guru.</p>
                    </div>
                </div>
            </div>
        @else
        <form action="{{ route('nilai-dongkrak.update', $siswa->id) }}" method="POST">
            @csrf
            
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <div class="flex items-center">
                        <i class="fas fa-table mr-2 text-gray-600"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Nilai Mata Pelajaran</h3>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Asli</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Dongkrak</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($nilaiList as $index => $item)
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="pulse-dot bg-blue-500"></div>
                                        <span class="text-gray-700 font-medium">{{ $index + 1 }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                            <i class="fas fa-book text-blue-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $item['mapel']->nama_mapel }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="badge bg-blue-100 text-blue-800">
                                        {{ number_format($item['nilai']->nilai_akhir, 0) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <div class="relative">
                                            <input type="number" 
                                                name="nilai[{{ $item['nilai']->id }}][nilai_dongkrak]" 
                                                value="{{ old('nilai.'.$item['nilai']->id.'.nilai_dongkrak', $item['nilai']->nilai_dongkrak) }}"
                                                min="0" 
                                                max="100" 
                                                step="0.01"
                                                class="w-28 px-4 py-2 border border-gray-300 rounded-lg input-focus focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center font-medium"
                                                placeholder="0-100">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <i class="fas fa-edit text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <input type="text" 
                                            name="nilai[{{ $item['nilai']->id }}][catatan_dongkrak]" 
                                            value="{{ old('nilai.'.$item['nilai']->id.'.catatan_dongkrak', $item['nilai']->catatan_dongkrak) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Tambahkan catatan (opsional)"
                                            maxlength="500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-sticky-note text-gray-400"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons & Tips -->
            <div class="mt-8 flex flex-col lg:flex-row gap-6">
                <div class="lg:w-2/3">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-5 shadow-sm">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Tips Pengisian Nilai Dongkrak</h4>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                                        <span class="text-gray-700">Kosongkan nilai dongkrak jika tidak perlu disesuaikan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                                        <span class="text-gray-700">Nilai dongkrak biasanya diisi untuk siswa yang nilainya di bawah KKM</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                                        <span class="text-gray-700">Nilai asli akan tetap tersimpan dan tidak berubah</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-md p-5 border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h4>
                        <div class="flex flex-col space-y-3">
                            <a href="{{ route('nilai-dongkrak.show-kelas', $siswa->kelas_id) }}" 
                                class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 font-medium">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                            <button type="submit" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium shadow-md">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Nilai Dongkrak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .card-hover {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .input-focus:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .pulse-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { opacity: 0.6; }
        50% { opacity: 1; }
        100% { opacity: 0.6; }
    }
</style>
@endsection