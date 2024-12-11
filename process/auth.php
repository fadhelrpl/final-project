<?php
// Fungsi untuk login
function loginUser($conn, $email, $password) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email tidak valid!";
    }

    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Start session dan simpan informasi pengguna
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['roles'] = $user['roles']; // Tambahkan roles ke session

            // Redirect berdasarkan roles
            if ($user['roles'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../dashboard.php");
            }
            exit();
        } else {
            return "Password salah!";
        }
    } else {
        return "Email tidak ditemukan!";
    }
}

function registerUser($conn, $name, $email, $password, $confirm_password) {
    if (strlen($password) < 6) return "Password harus minimal 6 karakter.";
    if ($password !== $confirm_password) return "Konfirmasi password tidak sesuai.";

    // Tentukan roles berdasarkan email
    $roles = (str_ends_with($email, '@admin.library')) ? 'admin' : 'user';

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO users (name, email, password, roles) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $hashedPassword, $roles);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?success=1");
        exit();
    } else {
        return "Terjadi kesalahan saat menyimpan data.";
    }
}