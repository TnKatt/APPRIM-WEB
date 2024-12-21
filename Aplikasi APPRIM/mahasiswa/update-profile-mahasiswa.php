<?php
session_start();
include '../koneksi/koneksi.php'; // Menghubungkan dengan database

// Pastikan user sudah login dan NIK tersedia di sesi
if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit();
}

$nik = $_SESSION['nik']; // Ambil NIK dari sesi yang sudah disimpan setelah login

// Ambil data profil dari database berdasarkan NIK
$query = "SELECT role, nik, nama_lengkap, email, foto_user FROM user WHERE nik = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nik);
$stmt->execute();
$stmt->bind_result($role, $nik, $nama_lengkap, $email, $foto_user);
$stmt->fetch();
$stmt->close();

// Proses update data profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'] ?? ''; // Ambil email yang diinput oleh pengguna
    $foto_user = $_FILES['foto_user']['name'] ?? ''; // Ambil foto yang diupload

    // Validasi untuk foto profil
    if ($foto_user) {
        $target_dir = "../images/foto_user/";
        $target_file = $target_dir . basename($_FILES["foto_user"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowedTypes)) {
            // Pindahkan file ke folder foto_user
            if (move_uploaded_file($_FILES["foto_user"]["tmp_name"], $target_file)) {
                // Jika berhasil upload foto
                $foto_user = basename($_FILES["foto_user"]["name"]);
            } else {
                echo "Terjadi kesalahan saat mengupload foto.";
                exit();
            }
        } else {
            echo "Hanya file gambar dengan ekstensi jpg, jpeg, png, atau gif yang diperbolehkan.";
            exit();
        }
    }

    // Jika email kosong, set menjadi NULL
    if (empty($email)) {
        $email = null; // Email akan dihapus atau dikosongkan
    }

    // Query untuk update email dan foto profil
    $query = "UPDATE user SET email = ?, foto_user = ? WHERE nik = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $foto_user, $nik);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect kembali ke halaman profil
        header("Location: ../mahasiswa/profile-mahasiswa.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui data profil.";
    }
}

// Menghapus foto profil dan mengosongkan email
if (isset($_GET['delete'])) {
    $query = "UPDATE user SET foto_user = NULL, email = NULL WHERE nik = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nik);

    // Eksekusi query untuk hapus
    if ($stmt->execute()) {
        header("Location: ../mahasiswa/edit-profile-mahasiswa.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat mereset data profil.";
    }
}

// Tutup koneksi
$conn->close();
?>