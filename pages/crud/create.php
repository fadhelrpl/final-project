<?php
session_start();

// Redirect jika belum login
if (!isset($_SESSION['roles'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../../config/connection.php'; // File koneksi database
require_once '../../process/crud.php'; // File fungsi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $birthCertificate = $_FILES['birth_certificate'];
    $photo = $_FILES['photo'];

    $result = registerPPDB($conn, $name, $email, $phone, $address, $birthCertificate, $photo);

    if ($result === "success") {
        header("Location: ../success.php");
        exit();
    } else {
        echo "<script>alert('$result'); window.location.href = 'create.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPDB - Sekolah Inspirasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="stylesheet" href="../../asset/css/style.css">
</head>

<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center text-gray-800">

  <div class="w-full max-w-2xl bg-white pt-7 pl-4 mx-3 rounded-lg shadow-lg my-9">
    <div class="fade-in">
    <div class="mb-5">
    <a href="../ppdb.php" class="bg-yellow-400 text-blue-900 px-5 py-2 rounded-lg hover:bg-yellow-300 shadow-lg transition-all">Kembali</a>
    </div>
    <h2 class="text-3xl font-extrabold text-blue-600 text-center mb-6">Pendaftaran PPDB</h2>
    <p class="text-gray-600 text-sm text-center mb-5">Silakan lengkapi formulir di bawah untuk mendaftar ke Sekolah Inspirasi.</p>
    <div class="p-8 items-center">
    <form class="space-y-6" method="POST" enctype="multipart/form-data">
      <div>
        <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label for="phone" class="block text-gray-700 font-medium mb-1">Nomor Telepon</label>
        <input type="number" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label for="address" class="block text-gray-700 font-medium mb-1">Alamat</label>
        <textarea id="address" name="address" rows="4" placeholder="Masukkan alamat lengkap Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
      </div>
      <div>
        <label for="birth_certificate" class="block text-gray-700 font-medium mb-1">Upload Akta Kelahiran</label>
        <input type="file" id="birth_certificate" name="birth_certificate" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" accept=".jpg,.jpeg,.png,.pdf" required>
        <p class="text-sm text-gray-500 mt-1">File harus dalam format JPG, PNG, atau PDF. Maksimal 2MB.</p>
      </div>
      <div>
        <label for="photo" class="block text-gray-700 font-medium mb-1">Upload Pas Foto</label>
        <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" accept=".jpg,.jpeg,.png" required>
        <p class="text-sm text-gray-500 mt-1">File harus dalam format JPG atau PNG. Maksimal 2MB.</p>
      </div>
      <div>
        <p class="text-sm text-red-500 mt-1">Pastikan data Anda sudah benar sebelum mendaftar.</p>
      </div>
      <button type="submit" onclick="return confirm('Apakah Anda yakin data sudah benar?')" class="w-full py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition duration-300">
        Daftar Sekarang
      </button>
    </form>
    </div>
    </div>
  </div>

</body>
</html>