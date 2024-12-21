<?php
require '../koneksi/koneksi.php'; // Memuat koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim melalui AJAX
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Query untuk memvalidasi data
    $sql = "SELECT * FROM user WHERE nik = ? AND nama_lengkap = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nik, $nama, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah data cocok
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak cocok. Pastikan NIK, Nama Lengkap, dan Email sesuai.']);
    }
} else {
    // Jika akses langsung tanpa POST, tolak akses
    echo json_encode(['status' => 'error', 'message' => 'Akses tidak diizinkan.']);
}
?>
