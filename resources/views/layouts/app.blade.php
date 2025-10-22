<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Aplikasi Nilai Siswa')</title>
  <link rel="icon" type="image/png" href="{{ asset('images/KEJOED.png') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-sans">

  <!-- HEADER -->
  <header class="bg-gradient-to-r from-blue-800 via-indigo-700 to-purple-700 text-white shadow-lg">
    <div class="flex items-center justify-between px-6 py-3">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('images/KEJOED.png') }}" alt="Logo" class="w-10 h-10 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold tracking-wide">Kejoed Score</h1>
      </div>
      <div>
        <span class="text-sm opacity-90">👤 Admin</span>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT AREA -->
  <div class="flex flex-1 h-[calc(100vh-64px)]">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-blue-800 to-indigo-800 text-white shadow-lg">
      <nav class="mt-6">
        <!-- MASTER DATA -->
        <div class="px-6 py-2 text-xs font-bold text-indigo-300 uppercase tracking-wide">Master Data</div>
        <a href="{{ route('tahun-ajaran.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('tahun-ajaran.*') ? 'bg-indigo-700' : '' }}">
          📅 Tahun Ajaran
        </a>
        <a href="{{ route('mata-pelajaran.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('mata-pelajaran.*') || request()->routeIs('komponen-nilai.*') ? 'bg-indigo-700' : '' }}">
          📖 Mata Pelajaran
        </a>
        <a href="{{ route('kelas.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('kelas.*') ? 'bg-indigo-700' : '' }}">
          🏫 Data Kelas
        </a>
        <a href="{{ route('siswa.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('siswa.*') ? 'bg-indigo-700' : '' }}">
          👥 Data Siswa
        </a>

        <!-- PENILAIAN -->
        <div class="px-6 py-2 mt-4 text-xs font-bold text-indigo-300 uppercase tracking-wide">Penilaian</div>
        <a href="{{ route('nilai.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('nilai.index') || request()->routeIs('nilai.show') ? 'bg-indigo-700' : '' }}">
          📝 Input Nilai
        </a>
        <a href="{{ route('nilai.rekap.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('nilai.rekap*') ? 'bg-indigo-700' : '' }}">
          📊 Rekap Nilai
        </a>

        <!-- LAPORAN -->
        <div class="px-6 py-2 mt-4 text-xs font-bold text-indigo-300 uppercase tracking-wide">Laporan</div>
        <a href="{{ route('rapor.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('rapor.*') ? 'bg-indigo-700' : '' }}">
          📄 Rapor Siswa
        </a>
        <a href="{{ route('export.index') }}" class="block py-3 px-6 hover:bg-indigo-700 rounded-r-full transition {{ request()->routeIs('export.*') ? 'bg-indigo-700' : '' }}">
          📥 Ekspor Excel
        </a>
      </nav>
    </aside>

    <!-- KONTEN -->
    <main class="flex-1 p-6 overflow-y-auto bg-gray-50">
      @yield('content')
    </main>
  </div>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-r from-blue-800 via-indigo-700 to-purple-700 text-white mt-auto shadow-inner">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
      <!-- Kiri -->
      <div class="flex items-center space-x-2">
        <img src="{{ asset('images/KEJOED.png') }}" alt="Logo" class="w-6 h-6 rounded-md shadow-sm">
        <span class="font-semibold text-sm tracking-wide">KEJOED_ID</span>
      </div>

      <!-- Tengah -->
      <p class="text-xs text-gray-300 mt-2 md:mt-0">
        © 2025 <span class="text-white font-medium">Kejoed Score</span> — Created with 💜 by 
        <span class="font-semibold">M. Surya Akbar Gaurifa</span>
      </p>

      <!-- Kanan -->
      <div class="flex items-center space-x-3 mt-2 md:mt-0">
        <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-github"></i></a>
        <a href="https://www.instagram.com/mhdsryaakbrr04_/" class="text-gray-300 hover:text-white transition"><i class="fab fa-instagram">Instagram</i></a>
        <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
  </footer>

</body>
</html>
