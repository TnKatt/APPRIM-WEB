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

// Inisialisasi variabel
$uploadDir = '../images/foto_user/';  // Direktori upload gambar
$defaultPhoto = $uploadDir . 'foto_default.jpg';  // Foto default
$profileImage = $defaultPhoto;  // Foto profil default jika belum ada
$email = '';  // Menyimpan email

// Ambil userId berdasarkan nik yang login
$query = "SELECT nik, email, foto_user FROM user WHERE nik = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nik);  // Bind nik sebagai parameter
$stmt->execute();
$stmt->bind_result($userId, $email, $profileImageFromDb);
$stmt->fetch();
$stmt->close();

// Jika ada foto profil yang disimpan, gunakan itu. Jika tidak, gunakan foto default
if ($profileImageFromDb) {
    $profileImage = $profileImageFromDb;
} else {
    $profileImage = $defaultPhoto;
}

// Menyimpan nilai foto profil lama untuk batal
$originalProfileImage = $profileImage;

// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengecek jika tombol 'Simpan' ditekan
    if (isset($_POST['simpan'])) {
        // Mengecek jika ada file yang diupload untuk foto profil
        if (isset($_FILES['foto_user']) && $_FILES['foto_user']['error'] == 0) {
            $fileName = basename($_FILES['foto_user']['name']);  // Nama file yang diupload
            $targetFile = $uploadDir . $fileName;  // Path lengkap untuk menyimpan file
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));  // Mendapatkan tipe file

            // Mengecek apakah tipe file yang diupload sesuai (hanya gambar yang diperbolehkan)
            $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $validImageTypes)) {
                // Jika file valid, pindahkan file ke folder tujuan
                if (move_uploaded_file($_FILES['foto_user']['tmp_name'], $targetFile)) {
                    $profileImage = $targetFile;  // Menyimpan path file gambar yang berhasil diupload

                    // Update foto profil di database
                    $stmt = $conn->prepare("UPDATE user SET foto_user = ? WHERE nik = ?");
                    $stmt->bind_param("ss", $profileImage, $nik);  // Bind parameter path gambar dan nik user
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";  // Pesan jika gagal upload
                }
            } else {
                echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";  // Pesan jika tipe file tidak sesuai
            }
        }

        // Mengecek apakah ada perubahan pada email
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];  // Menyimpan email baru

            // Update email di database
            $stmt = $conn->prepare("UPDATE user SET email = ? WHERE nik = ?");
            $stmt->bind_param("ss", $email, $nik);  // Bind parameter email dan nik user
            $stmt->execute();
            $stmt->close();
        }

        // Redirect ke halaman profile-mahasiswa.php setelah perubahan disimpan
        header("Location: profile-mahasiswa.php");
        exit();
    }

    // Mengecek jika tombol 'Hapus' ditekan
    if (isset($_POST['hapus'])) {
        // Mengubah foto profil ke foto default
        $profileImage = $defaultPhoto;

        // Update foto profil di database menjadi default
        $stmt = $conn->prepare("UPDATE user SET foto_user = ? WHERE nik = ?");
        $stmt->bind_param("ss", $profileImage, $nik);  // Bind parameter foto profil dan nik user
        $stmt->execute();
        $stmt->close();
    }

    // Mengecek jika tombol batal ditekan
    if (isset($_POST['batal'])) {
        // Kembalikan foto profil ke foto yang sebelumnya
        $profileImage = $originalProfileImage;

        // Arahkan kembali ke halaman profile-mahasiswa.php tanpa ada perubahan
        header("Location: ../mahasiswa/profile-mahasiswa.php");
        exit();
    }
}

$conn->close(); // Tutup koneksi
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PROFILE || APPRIM</title>
    <link rel="stylesheet" href="../front-end/css/style-auth.css">
</head>
<body>
    <div class="container">
        <!-- Menampilkan foto profil, jika ada -->
        <img id="preview" src="<?php echo $profileImage; ?>" alt="Foto Profil" />

        <!-- Form untuk upload foto profil dan email -->
        <form action="edit-profile-mahasiswa.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foto_user">Foto Profil:</label>
                <input class="text" type="file" name="foto_user" id="foto_user" onchange="previewImage(event)">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input class="text" id="email" type="text" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="button-group">
                <!-- Tombol Simpan: Menyimpan foto profil dan email -->
                <button type="submit" name="hapus">Hapus Foto</button>                 
                <button type="submit" name="simpan">Simpan</button>

            </div>
        </form>
        
        <div class="back-to-login">
            <hr/>
            <hr/>
        </div>

        <div class="footer">
            APPRIM</br>
            Aplikasi Pengolahan Peminjaman Ruang Meeting
        </div>
    </div>

    <script>
        // Preview image sebelum diupload
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
