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
    $id = $_POST['id'];

    $result = deletePPDB($conn, $id);

    if ($result === "success") {
        header('Location: ../admin/dashboard.php?delete=success');
        exit;
    } else {
        echo "Error: " . $result;
    }
}
