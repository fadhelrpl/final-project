<?php
// Fungsi untuk memproses data pendaftaran
function registerPPDB($conn, $name, $email, $phone, $address, $birthCertificate, $photo) {
    // Validasi dan upload Akta Kelahiran
    $birthCertUpload = uploadFile($birthCertificate, ['jpg', 'jpeg', 'png', 'pdf'], 2 * 1024 * 1024);
    if (!$birthCertUpload['status']) {
        return $birthCertUpload['message']; // Return error jika gagal upload
    }
    $birthCertPath = $birthCertUpload['path'];

    // Validasi dan upload Pas Foto
    $photoUpload = uploadFile($photo, ['jpg', 'jpeg', 'png'], 2 * 1024 * 1024);
    if (!$photoUpload['status']) {
        return $photoUpload['message']; // Return error jika gagal upload
    }
    $photoPath = $photoUpload['path'];

    // Simpan data ke database
    $query = "INSERT INTO ppdb (name, email, phone, address, birth_certificate, photo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $phone, $address, $birthCertPath, $photoPath);

    if (mysqli_stmt_execute($stmt)) {
        return "success";
    } else {
        return "Terjadi kesalahan saat menyimpan data.";
    }
}

function getDataById($id, $conn) {
    $query = "SELECT * FROM ppdb WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function updateData($id, $name, $email, $phone, $address, $birthCertificate, $photo, $conn) {
    $query = "UPDATE ppdb 
              SET name = ?, email = ?, phone = ?, address = ?, 
                  birth_certificate = COALESCE(?, birth_certificate), 
                  photo = COALESCE(?, photo), 
                  created_at = NOW()
              WHERE id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssi', $name, $email, $phone, $address, $birthCertificate, $photo, $id);
    return $stmt->execute();
}

function getPendaftar($conn) {
    $query = "SELECT id, name, email, phone, address, birth_certificate, photo, created_at FROM ppdb";
    $result = mysqli_query($conn, $query);

    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    return $data;
}

function deletePPDB($conn, $id) {
    // Ambil data lama untuk mendapatkan path file
    $query = "SELECT birth_certificate, photo FROM ppdb WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $oldData = mysqli_fetch_assoc($result);

    // Hapus file jika ada
    if (!empty($oldData['birth_certificate']) && file_exists($oldData['birth_certificate'])) {
        unlink($oldData['birth_certificate']); // Hapus file akta kelahiran
    }
    if (!empty($oldData['photo']) && file_exists($oldData['photo'])) {
        unlink($oldData['photo']); // Hapus file foto
    }

    // Hapus data dari database
    $query = "DELETE FROM ppdb WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        return "success";
    } else {
        return "Terjadi kesalahan saat menghapus data.";
    }
}


function uploadFile($file, $allowedExtensions = ['jpg', 'jpeg', 'png'], $maxFileSize = 2 * 1024 * 1024, $uploadDir = 'uploads/') {
    // Buat direktori jika tidak ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Ambil informasi file
    $fileName = $file['name'] ?? ''; // Default ke string kosong jika tidak ada
    $fileTmp = $file['tmp_name'] ?? null; // Default ke null
    $fileSize = $file['size'] ?? 0; // Default ke 0
    $fileError = $file['error'] ?? UPLOAD_ERR_NO_FILE; // Default error jika tidak ada file
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi error upload
    if ($fileError !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'Terjadi kesalahan saat mengupload file: ' . $fileError];
    }

    // Validasi jenis file
    if (!in_array($fileExtension, $allowedExtensions)) {
        return ['status' => false, 'message' => 'Format file tidak diperbolehkan. Hanya ' . implode(', ', $allowedExtensions) . ' yang diperbolehkan.'];
    }

    // Validasi ukuran file
    if ($fileSize > $maxFileSize) {
        return ['status' => false, 'message' => 'Ukuran file terlalu besar. Maksimal ' . ($maxFileSize / (1024 * 1024)) . ' MB.'];
    }

    // Penamaan file unik
    $newFileName = uniqid() . '_' . $fileName;
    $filePath = $uploadDir . $newFileName;

    // Proses upload file
    if (move_uploaded_file($fileTmp, $filePath)) {
        return ['status' => true, 'path' => $filePath];
    } else {
        return ['status' => false, 'message' => 'Gagal menyimpan file ke direktori tujuan.'];
    }
}

function uploadFileForUpdate($file, $currentFilePath, $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'], $maxFileSize = 2 * 1024 * 1024, $uploadDir = 'uploads/') {
    // Jika tidak ada file baru yang diunggah, pertahankan file lama
    if (empty($file['name'])) {
        return ['status' => true, 'path' => $currentFilePath]; // Tidak ada perubahan
    }

    // Buat direktori jika tidak ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Ambil informasi file
    $fileName = $file['name'] ?? ''; // Default ke string kosong jika tidak ada
    $fileTmp = $file['tmp_name'] ?? null; // Default ke null
    $fileSize = $file['size'] ?? 0; // Default ke 0
    $fileError = $file['error'] ?? UPLOAD_ERR_NO_FILE; // Default error jika tidak ada file
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi error upload
    if ($fileError !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'Terjadi kesalahan saat mengupload file: ' . $fileError];
    }

    // Validasi jenis file
    if (!in_array($fileExtension, $allowedExtensions)) {
        return ['status' => false, 'message' => 'Format file tidak diperbolehkan. Hanya ' . implode(', ', $allowedExtensions) . ' yang diperbolehkan.'];
    }

    // Validasi ukuran file
    if ($fileSize > $maxFileSize) {
        return ['status' => false, 'message' => 'Ukuran file terlalu besar. Maksimal ' . ($maxFileSize / (1024 * 1024)) . ' MB.'];
    }

    // Penamaan file unik
    $newFileName = uniqid() . '_' . $fileName;
    $filePath = $uploadDir . $newFileName;

    // Proses upload file
    if (move_uploaded_file($fileTmp, $filePath)) {
        // Hapus file lama jika ada dan baru di-upload
        if ($currentFilePath && file_exists($currentFilePath)) {
            unlink($currentFilePath);
        }

        return ['status' => true, 'path' => $filePath];
    } else {
        return ['status' => false, 'message' => 'Gagal menyimpan file ke direktori tujuan.'];
    }
}