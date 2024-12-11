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
    <title>PPDB - Sekolah Inspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-purple-50 text-gray-800">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-purple-700 text-white shadow-lg">
  <div class="container mx-auto flex items-center justify-between py-4 px-6">
    <!-- Logo atau Teks -->
    <h1 class="text-2xl font-extrabold tracking-wide hover:text-yellow-300 transition duration-300">
      Sekolah <br class="md:hidden"> Inspirasi
    </h1>
    <!-- Tombol untuk ukuran layar besar -->
    <nav class="flex space-x-6">
      <a href="dashboard.php" class="bg-yellow-400 text-blue-900 px-5 py-2 rounded-lg hover:bg-yellow-300 shadow-lg transition-all">
        Kembali Ke Beranda
      </a>
    </nav>
  </div>

  <!-- Menu Mobile -->
  <div id="mobile-menu" class="hidden bg-gradient-to-r from-blue-600 to-purple-700">
    <nav class="space-y-4 py-4 px-6">
      <a href="../index.php" class="bg-yellow-400 text-blue-900 px-4 py-2 rounded-full hover:text-white transition duration-300">
        Kembali Ke Beranda
      </a>
    </nav>
  </div>
</header>

    <!-- Hero Section -->
    <section id="hero" class="bg-gradient-to-br from-purple-500 to-blue-600 text-white py-16 text-center">
        <div class="container mx-auto px-6 fade-in">
            <h2 class="text-4xl font-bold mb-4">Penerimaan Peserta Didik Baru (PPDB)</h2>
            <p class="text-lg mb-8">Bergabunglah bersama kami untuk masa depan yang cerah dan penuh inspirasi.</p>
            <a href="crud/create.php"
                class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-yellow-300 hover:shadow-2xl transform hover:scale-105 transition duration-300">
                Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- PPDB Information Section -->
    <section class="py-16 bg-white text-center">
        <div class="container mx-auto px-6 fade-in">
            <h3 class="text-3xl font-bold text-gray-800 mb-6">Informasi PPDB</h3>
            <p class="text-gray-600 mb-8">Sekolah Inspirasi membuka pendaftaran peserta didik baru untuk tahun ajaran
                2024/2025. Kami menerima siswa dari berbagai latar belakang <br> dengan komitmen untuk memberikan
                pendidikan berkualitas.</p>
            <div class="grid gap-8 md:grid-cols-3">
                <div
                    class="p-6 bg-gradient-to-r from-green-400 to-teal-500 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h4 class="text-xl font-bold mb-2">Persyaratan</h4>
                    <p>Fotokopi KK, Akta Kelahiran, dan pas foto ukuran 3x4 (3 lembar).</p>
                </div>
                <div
                    class="p-6 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h4 class="text-xl font-bold mb-2">Jadwal</h4>
                    <p>Pendaftaran dibuka dari 1 Januari hingga 31 Maret 2024.</p>
                </div>
                <div
                    class="p-6 bg-gradient-to-r from-blue-400 to-purple-500 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <h4 class="text-xl font-bold mb-2">Lokasi</h4>
                    <p>Sekolah Inspirasi, Jl. Pendidikan No. 123, Kota Inspirasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sekolah Inspirasi. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script script="asset/js/script.js"></script>
</body>

</html>