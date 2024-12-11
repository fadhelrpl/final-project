<?php
require_once '../../process/crud.php';
require_once '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    // Validasi data
    if (!$id || !$name || !$email || !$phone || !$address) {
        die('Semua data wajib diisi!');
    }

    // Pastikan ada parameter $maxFileSize (default 2MB = 2 * 1024 * 1024)
    $maxFileSize = 2 * 1024 * 1024; // Maksimal ukuran file: 2MB

    // Proses upload file (jika ada file baru yang diunggah)
    $birthCertificateResult = uploadFileForUpdate($_FILES['birth_certificate'], $data['birth_certificate'], ['jpg', 'jpeg', 'png', 'pdf'], $maxFileSize);
    $photoResult = uploadFileForUpdate($_FILES['photo'], $data['photo'], ['jpg', 'jpeg', 'png'], $maxFileSize);

    if (!$birthCertificateResult['status']) {
        die($birthCertificateResult['message']);
    }

    if (!$photoResult['status']) {
        die($photoResult['message']);
    }

    // Update data ke database
    $result = updateData($id, $name, $email, $phone, $address, $birthCertificateResult['path'], $photoResult['path'], $conn);
    if ($result) {
        header('Location: ../admin/dashboard.php?message=success');
        exit;
    } else {
        die('Gagal memperbarui data.');
    }
} else {
    die('Metode tidak diizinkan.');
}