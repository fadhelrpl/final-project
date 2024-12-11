<?php
session_start();

// Redirect jika bukan admin
if ($_SESSION['roles'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../../config/connection.php';
require_once '../../process/crud.php';
$pendaftar = getPendaftar($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Data Pendaftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../asset/css/style.css">
</head>

<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-purple-700 text-white shadow-lg sticky top-0">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-3xl font-bold tracking-wide">Admin <br class="md:hidden"> Panel</h1>
            <nav>
                <a href="../dashboard.php"
                    class="bg-yellow-400 text-blue-900 px-5 py-2 rounded-lg hover:bg-yellow-300 shadow-lg transition-all">
                    Lihat Website Sekolah
                </a>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <main class="container mx-auto py-12 px-6 flex-grow">
    <div class="bg-white shadow-xl rounded-lg p-6">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Data Pendaftar</h2>
    
    <!-- Tabel Data -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse bg-white rounded-lg shadow-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-blue-600 to-purple-700 text-white">
                <tr>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">No</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Nama</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Email</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Telepon</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Alamat</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Akta Kelahiran</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Pas Foto</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Tanggal Pendaftaran</th>
                    <th class="py-2 px-4 sm:py-3 sm:px-6 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pendaftar) > 0): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($pendaftar as $data): ?>
                        <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-blue-100 transition-all">
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= $no++; ?></td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= htmlspecialchars($data['name']); ?></td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= htmlspecialchars($data['email']); ?></td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= htmlspecialchars($data['phone']); ?></td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= htmlspecialchars($data['address']); ?></td>
                            <?php $base_url = "http://localhost/ppdb/pages/crud/"; ?>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6">
                                <a href="<?= $base_url . htmlspecialchars($data['birth_certificate']); ?>"
                                    class="text-blue-600 underline hover:text-blue-800 transition" target="_blank">Lihat
                                    Akta</a>
                            </td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6">
                                <a href="<?= $base_url . htmlspecialchars($data['photo']); ?>"
                                    class="text-blue-600 underline hover:text-blue-800 transition" target="_blank">Lihat
                                    Foto</a>
                            </td>
                            <td class="border-r-2 border-gray-300 py-2 px-4 sm:py-3 sm:px-6"><?= htmlspecialchars($data['created_at']); ?></td>
                            <td class="py-2 px-4 sm:py-3 sm:px-6 space-y-2">
                                <form action="../crud/update.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                                        Edit
                                    </button>
                                </form>
                                <form action="../crud/delete.php" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg shadow-md hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-600">
                            Tidak ada data pendaftar yang tersedia.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'success'): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <span class="block sm:inline">Data berhasil diperbarui.</span>
    </div>
<?php endif; ?>
</div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sekolah Inspirasi. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script href="../../asset/js/script.js"></script>
</body>

</html>