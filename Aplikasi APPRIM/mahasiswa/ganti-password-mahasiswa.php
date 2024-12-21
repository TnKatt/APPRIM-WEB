<?php
// Sertakan koneksi database
include('../koneksi/koneksi.php');

// Mulai session untuk mendapatkan nik yang login
session_start();

// Cek apakah nik sudah diset di session (pastikan login)
if (!isset($_SESSION['nik'])) {
    die("Anda harus login terlebih dahulu.");
}

// Ambil nik dari session
$nik = $_SESSION['nik'];

// Inisialisasi pesan pemberitahuan
$message = '';

// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengecek jika tombol 'Simpan' ditekan
    if (isset($_POST['simpan'])) {
        // Ambil data password saat ini, password baru dan konfirmasi password
        $passwordLama = $_POST['password'];
        $passwordBaru = $_POST['new-password'];
        $konfirmasiPassword = $_POST['konfirmasi-password'];

        // Cek apakah password baru dan konfirmasi password cocok
        if ($passwordBaru !== $konfirmasiPassword) {
            $message = "Password baru dan konfirmasi password tidak cocok.";
        } else {
            // Ambil password yang ada di database untuk pengguna saat ini
            $query = "SELECT password FROM user WHERE nik = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $nik);  // Bind nik sebagai parameter
            $stmt->execute();
            $stmt->bind_result($passwordDb); // Ambil password dari database
            $stmt->fetch();
            $stmt->close();

            // Memeriksa apakah password lama yang dimasukkan sama dengan yang ada di database
            if ($passwordLama === $passwordDb) {
                // Jika password lama valid, hash password baru dan update
                $hashedPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);

                // Update password yang sudah di-hash di database
                $stmt = $conn->prepare("UPDATE user SET password = ? WHERE nik = ?");
                $stmt->bind_param("ss", $hashedPassword, $nik);  // Simpan hashed password
                $stmt->execute();
                $stmt->close();

                $message = "Password berhasil diubah!";
            } else {
                $message = "Password saat ini tidak valid.";
            }
        }
    }
}

$conn->close(); // Tutup koneksi
?>

<!doctype html>
<html lang="id">
    <head>
        <link rel="stylesheet" href="../front-end/css/style-auth.css">
        <script src="ganti_pw.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <img src="../images/logo.jpg" alt="Logo">
           
            <form name="ganti-password-mahasiswa.php" method='POST' action=''>
                <div class='form-group'>
                    <label for="password">Password Saat Ini :</label>
                    <input class='text' id="password" name="password" type="password">

                    <label for="new-password">Password Baru :</label>
                    <input class='text' id="new-password" name="new-password" type="password">

                    <label for="konfirmasi-password">Konfirmasi Password Baru :</label>
                    <input class='text' id="konfirmasi-password" name="konfirmasi-password" type="password">
                </div>

                <div class="button-group">
                    <a href="../mahasiswa/profile-mahasiswa.php"><button type="button" class="cancel">Batal</button></a>
                    <button type="submit" name="simpan" class="save">Simpan</button>
                </div>
            </form>

            <!-- Menampilkan pesan pemberitahuan di bawah tombol -->
            <?php if ($message): ?>
                <div class="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class='back-to-login'>
                <hr/>
            </div>

            <div class="footer">
                APPRIM<br/>
                Aplikasi Pengolahan Peminjaman Ruang Meeting
            </div>
        </div>
    </body>
</html>
