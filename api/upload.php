<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['gambar_menu']) || $_FILES['gambar_menu']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => 'error', 'message' => 'Gambar tidak ditemukan atau gagal diunggah.']);
        exit();
    }

    $file = $_FILES['gambar_menu'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 2 * 1024 * 1024; 

    // Validasi tipe file
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['status' => 'error', 'message' => 'Format file tidak valid. Hanya JPG, JPEG, PNG diperbolehkan.']);
        exit();
    }

    // Validasi ukuran file
    if ($file['size'] > $maxSize) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB.']);
        exit();
    }

    $uploadDir = '../assets/img/foodMenu/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Nama file unik untuk menghindari konflik
    $fileName = uniqid() . '_' . basename($file['name']);
    $filePath = $uploadDir . $fileName;

    // Pindahkan file ke direktori
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo json_encode(['status' => 'success', 'message' => 'File berhasil diunggah.', 'url' => $filePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan file.']);
    }
}
?>
