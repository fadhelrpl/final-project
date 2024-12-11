<?php
session_start();
// Redirect jika belum login
if (!isset($_SESSION['roles'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sekolah Inspirasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="asset/css/style.css">
</head>

<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-purple-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-gradient-to-r from-blue-600 to-purple-700 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
      <h1 class="text-2xl font-extrabold tracking-wide hover:text-yellow-300 transition duration-300">
        Sekolah Inspirasi
      </h1>

      <!-- Menu Desktop -->
      <nav class="hidden md:flex space-x-6 items-center">
        
          <a href="#home" class="hover:text-yellow-300 transition duration-300">Home</a>
          <a href="#about" class="hover:text-yellow-300 transition duration-300">Tentang</a>
          <a href="#facilities" class="hover:text-yellow-300 transition duration-300">Fasilitas</a>
          <a href="../process/logout.php" class="bg-red-400 text-white-900 px-3 py-2 rounded-lg font-semibold shadow-lg hover:bg-red-300 hover:shadow-2xl transform hover:scale-105 transition duration-300">Logout</a>
      </nav>

      <!-- Toggle Menu (Mobile) -->
      <button id="menu-toggle" class="block md:hidden focus:outline-none">
        <!-- Default Hamburger Icon -->
        <svg id="icon-hamburger" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
        <!-- Close Icon (hidden by default) -->
        <svg id="icon-close" class="w-6 h-6 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Dropdown Menu Mobile -->
    <div id="mobile-menu" class="hidden bg-gradient-to-r from-blue-600 to-purple-700 md:hidden">
      <nav class="space-y-4 py-4 px-6">
        <a href="#home" class="block text-white hover:text-yellow-300 transition duration-300 nav-link">Home</a>
        <a href="#about" class="block text-white hover:text-yellow-300 transition duration-300 nav-link">Tentang</a>
        <a href="#facilities" class="block text-white hover:text-yellow-300 transition duration-300 nav-link">Fasilitas</a>
        <div>
          <a href="../process/logout.php" class="bg-red-400 text-white-900 px-3 py-2 rounded-lg font-semibold shadow-lg hover:bg-red-300 hover:shadow-2xl transform hover:scale-105 transition duration-300">Logout</a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="bg-gradient-to-r from-purple-500 to-blue-600 text-white py-24 text-center">
    <div class="container mx-auto px-6 fade-in">
      <h2 class="text-5xl font-bold mb-4">Selamat Datang di Sekolah Inspirasi</h2>
      <p class="text-lg mb-8">Menciptakan Generasi Cerdas, Kreatif, dan Berprestasi</p>
      <a href="ppdb.php"
        class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-yellow-300 hover:shadow-2xl transform hover:scale-105 transition duration-300">
        Lihat PPDB
      </a>
      <!-- Tombol Hanya untuk Admin -->
      <?php $roles = $_SESSION['roles'] ?? ''; ?>
      <?php if ($roles === 'admin'): ?>
        <p class="text-md mt-5 mb-5">Atau</p>
      <a href="admin/dashboard.php"
        class="bg-red-400 text-white-900 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-red-500 hover:shadow-2xl transform hover:scale-105 transition duration-300">
        Lihat Data PPDB
      </a>
        <?php endif; ?>
      
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center fade-in">
      <h2 class="text-4xl font-bold mb-6 text-gray-800">Tentang Kami</h2>
      <p class="text-gray-600 max-w-3xl mx-auto mb-10">Sekolah Inspirasi memberikan pendidikan berkualitas yang fokus
        pada pembentukan karakter, kreativitas, dan kemampuan siswa.</p>
      <div class="grid md:grid-cols-3 gap-8">
        <div
          class="p-6 bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-lg shadow-lg transform hover:scale-110 transition duration-300">
          <h3 class="text-xl font-semibold mb-2">Guru Berkualitas</h3>
          <p>Pengajar profesional dengan pengalaman bertahun-tahun. <br><br> </p>
        </div>
        <div
          class="p-6 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-lg shadow-lg transform hover:scale-110 transition duration-300">
          <h3 class="text-xl font-semibold mb-2">Fasilitas Modern</h3>
          <p>Laboratorium, perpustakaan, dan teknologi terkini.</p>
        </div>
        <div
          class="p-6 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-lg shadow-lg transform hover:scale-110 transition duration-300">
          <h3 class="text-xl font-semibold mb-2">Lingkungan Positif</h3>
          <p>Lingkungan mendukung pengembangan diri siswa.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Facilities Section -->
  <section id="facilities" class="py-16 bg-gradient-to-r from-blue-100 to-purple-100">
    <div class="container mx-auto px-6 text-center fade-in">
      <h2 class="text-4xl font-bold text-gray-800 mb-8">Fasilitas Kami</h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          class="p-6 bg-white rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg transition duration-300">
          <h3 class="text-xl font-semibold text-blue-600 mb-2">Laboratorium</h3>
          <p class="text-gray-600">Fasilitas lengkap untuk mendukung pembelajaran eksperimen siswa.</p>
        </div>
        <div
          class="p-6 bg-white rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg transition duration-300">
          <h3 class="text-xl font-semibold text-blue-600 mb-2">Perpustakaan</h3>
          <p class="text-gray-600">Ruang baca nyaman dengan koleksi buku lengkap.</p>
        </div>
        <div
          class="p-6 bg-white rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg transition duration-300">
          <h3 class="text-xl font-semibold text-blue-600 mb-2">Lapangan Olahraga</h3>
          <p class="text-gray-600">Fasilitas olahraga untuk kegiatan ekstrakurikuler siswa.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-4">
    <div class="container mx-auto px-6 text-center">
      <p>&copy; 2024 Sekolah Inspirasi. Semua Hak Dilindungi.</p>
    </div>
  </footer>

  <script src="../asset/js/script.js"></script>
</body>

</html>