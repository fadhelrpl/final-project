<?php
// Pastikan koneksi database sudah disertakan
include '../../config/connection.php';
include '../../process/auth.php';

$error_message = '';

if (isset($_GET['success']) && $_GET['success'] == '1') {
  $message = "Akun berhasil dibuat! Silakan login.";
}

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Panggil fungsi loginUser untuk memverifikasi login
    $error_message = loginUser($conn, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sekolah Inspirasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../asset/css/style.css">
</head>
<body class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center text-gray-800">

  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg mx-3 fade-in- bounce-in">
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold text-blue-600">Login</h2>
      <p class="text-gray-600 text-sm">Masuk untuk melanjutkan ke akun Anda</p>
    </div>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (!empty($message)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 py-2 px-3 mb-4">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>

    <!-- Tampilkan pesan error jika ada -->
    <?php if ($error_message): ?>
      <div class="bg-red-500 text-white text-center py-2 mb-4 rounded">
        <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <form class="space-y-6" method="POST">
      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" id="email" placeholder="Masukkan email Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password Anda" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>
      <button type="submit" class="w-full py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition duration-300">
        Login
      </button>
    </form>

    <p class="text-sm text-gray-600 text-center mt-4">
      Belum punya akun? <a href="register.php" class="text-blue-500 hover:underline">Daftar Sekarang</a>
    </p>
  </div>

</body>
</html>