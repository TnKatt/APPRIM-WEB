<?php
include('../koneksi/koneksi.php');

// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaGedung = $_POST['nama_gedung'];
    $deskripsi = $_POST['deskripsi'];
    $fotoGedung = $_FILES['foto_gedung'];

    $uploadDir = '../images/';
    $targetFile = $uploadDir . basename($fotoGedung['name']);
    $uploadOk = false;

    if ($fotoGedung['error'] === 0) {
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $validImageTypes)) {
            $uploadOk = move_uploaded_file($fotoGedung['tmp_name'], $targetFile);

            if ($uploadOk) {
                $sql = "INSERT INTO gedung (nama_gedung, deskripsi, foto_gedung) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $namaGedung, $deskripsi, $fotoGedung['name']);

                if ($stmt->execute()) {
                    echo "<script>alert('Gedung berhasil ditambahkan!'); window.location.href = 'home-admin.php';</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan data.');</script>";
                }
            }
        } else {
            echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.');</script>";
        }
    } else {
        echo "<script>alert('Harap unggah file gambar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH GEDUNG || APPRIM</title>
    <link rel="stylesheet" href="../front-end/css/style-auth.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Gedung</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_gedung">Nama Gedung</label>
                <input class="text"type="text" id="nama_gedung" name="nama_gedung" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="text"id="deskripsi" name="deskripsi" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="foto_gedung">Foto Gedung</label>
                <input class="text"type="file" id="foto_gedung" name="foto_gedung" accept="image/*" required>
            </div>
            <div class="button-group">
                <button type="button" onclick="window.location.href='home-admin.php';">Batal</button>                
                <button type="submit" name="simpan">Simpan</button>

            </div>
        </form>

        <div class="footer">
            APPRIM<br/>
            Aplikasi Pengolahan Peminjaman Ruang Meeting
        </div>
    </div>
</body>
</html>
