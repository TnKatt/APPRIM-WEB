<?php
session_start();
require '../koneksi/koneksi.php'; // Memuat koneksi ke database

// Ambil data yang dikirim melalui POST
$nik = $_POST['nik'];
$password = $_POST['password'];

// Query untuk mengambil data pengguna berdasarkan NIK
$sql = "SELECT * FROM user WHERE nik = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nik); // Mengikat parameter nik
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah pengguna ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verifikasi password tanpa hashing
    if ($password == $user['password']) {
        // Password cocok, simpan data pengguna di session
        $_SESSION['nik'] = $nik;
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];
        
        // Cek role dan arahkan ke halaman yang sesuai
        switch ($user['role']) {
            case 'Admin':
                header("Location: ../admin/home-admin.php");  // Halaman dashboard admin
                break;
            case 'Dosen':
                header("Location: dosen_dashboard.php");  // Halaman dashboard dosen
                break;
            case 'Mahasiswa':
                header("Location: ../mahasiswa/home-mahasiswa.php");  // Halaman dashboard mahasiswa
                break;
            case 'Pic-ruangan':
                header("Location: pic_ruangan_dashboard.php");  // Halaman dashboard pic-ruangan
                break;
            default:
                header("Location: ../auth/login.php?error=Role tidak dikenali");
                break;
        }
        exit();
    } else {
        // Password tidak cocok
        header("Location: ../auth/login.php?error=Password salah");
        exit();
    }
} else {
    // Pengguna tidak ditemukan
    header("Location: ../auth/login.php?error=Pengguna tidak ditemukan");
    exit();
}
?>
