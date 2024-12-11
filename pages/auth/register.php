<?php
// Pastikan koneksi database sudah disertakan
include '../../config/connection.php';
include '../../process/auth.php';

// Inisialisasi pesan error
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Panggil fungsi registerUser untuk memproses pendaftaran
    $error_message = registerUser($conn, $name, $email, $password, $confirm_password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sekolah Inspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../asset/css/style.css">
</head>

<body
    class="bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center text-gray-800">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg mx-3 fade-in- bounce-in">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-600">Register</h2>
            <p class="text-gray-600 text-sm">Buat akun baru untuk bergabung bersama kami</p>
        </div>

        <!-- Tampilkan pesan error jika ada -->
        <?php if ($error_message): ?>
            <div class="bg-red-500 text-white text-center py-2 mb-4 rounded">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST">
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>
            <div>
                <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="confirm_password" id="confirm_password"
                    placeholder="Konfirmasi password Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>
            <button type="submit"
                class="w-full py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition duration-300">
                Daftar
            </button>
        </form>
        <p class="text-sm text-gray-600 text-center mt-4">
            Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Login Sekarang</a>
        </p>
    </div>

</body>

</html>