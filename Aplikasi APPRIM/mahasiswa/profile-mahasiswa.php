<?php
session_start();
include '../koneksi/koneksi.php'; // Menghubungkan dengan database

// Pastikan user sudah login dan NIK tersedia di sesi
if (!isset($_SESSION['nik'])) {
    header("Location: ..auth/login.php"); // Jika belum login, redirect ke login page
    exit();
}

$nik = $_SESSION['nik']; // Ambil NIK dari sesi yang sudah disimpan setelah login

// Query untuk mengambil data profil berdasarkan NIK, termasuk foto_user
$query = "SELECT role, nik, nama_lengkap, email, foto_user FROM user WHERE nik = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nik); // Bind parameter NIK ke query
$stmt->execute();
$stmt->bind_result($role, $nik, $nama_lengkap, $email, $foto_user); // Menyimpan hasil query ke variabel
$stmt->fetch(); // Ambil data

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PROFILE || APPRIM</title>
        <link rel='stylesheet' href='../front-end/css/style-auth.css'>
    </head>

    <body>
        <div class="container">
            <div>
                <!-- Menampilkan gambar profil jika ada, jika tidak tampilkan gambar default -->
                <?php if (!empty($foto_user)): ?>
                    <img src="<?php echo htmlspecialchars($foto_user); ?>" alt="Profile Image" class="profile-img">
                <?php else: ?>
                    <img src="../images/foto_user/foto_default.jpg" alt="foto_default" class="profil-img">
                <?php endif; ?>
            </div> <!-- Gambar lingkaran profil -->

            <div class="form-group">
                <label>Peran :</label>
                <input class="text" type="text" value="<?php echo htmlspecialchars($role); ?>" readonly>

                <label>NIK :</label>
                <input class="text" type="text" value="<?php echo htmlspecialchars($nik); ?>" readonly>

                <label>Nama Lengkap :</label>
                <input class="text" type="text" value="<?php echo htmlspecialchars($nama_lengkap); ?>" readonly>

                <label>Email :</label>
                <input class="text" type="text" value="<?php echo htmlspecialchars($email); ?>" placeholder="Tekan &quot;Edit Profile&quot; untuk mengisi email" readonly>
            </div>
            <div class="button-group">
                <a href="../mahasiswa/ganti-password-mahasiswa.php"><ganti-pw-btn type='button' class="btn">Ganti Password</ganti-pw-btn></a>
                <a href="../mahasiswa/edit-profile-mahasiswa.php"><button type='button' class="btn">Edit Profile</button></a>
            </div>

            <div class="back-to-home">
                <hr/>
                    <span><a href='../mahasiswa/home-mahasiswa.php'>Back to Home</a></span>
                <hr/>   
            </div>

            <div class="footer">
                APPRIM</br>
                Aplikasi Pengolahan Peminjaman Ruang Meeting
            </div>
        </div>
    </body>
</html>
