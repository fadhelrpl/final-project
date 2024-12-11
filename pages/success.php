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
  <title>Pendaftaran Berhasil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center text-white">
  <div class="text-center">
    <h1 class="text-3xl font-bold">Pendaftaran Berhasil!</h1>
    <p class="mt-4">Terima kasih telah mendaftar. Kami akan menghubungi Anda segera.</p>
    <p class="bg-white rounded-md py-1 mx-3 text-sm text-red-500 mt-1">Jika ada kesalahan data bisa hubungi sekolah@inspirasi.sch</p>
    <a href="dashboard.php" class="mt-6 inline-block px-4 py-2 bg-yellow-400 text-blue-900 rounded-full">Kembali Ke Beranda</a>
  </div>
</body>
</html>