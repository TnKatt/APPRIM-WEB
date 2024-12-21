<?php
include('../koneksi/koneksi.php');

// Inisialisasi variabel
$kodeRuangan = $kapasitas = $jenisRuangan = $lokasi = $status = $nik = $fotoLama = "";
$isUpdate = false;

// Ambil data gedung dan user untuk dropdown
$gedungQuery = $conn->query("SELECT id_gedung, nama_gedung FROM gedung");
$usersQuery = $conn->query("SELECT nik, nama_lengkap FROM user WHERE role IN ('PIC Ruangan')");

// Jika terdapat parameter kode_ruangan, ambil data ruangan untuk diupdate
if (isset($_GET['kode_ruangan'])) {
    $isUpdate = true;
    $kodeRuangan = $_GET['kode_ruangan'];
    $ruanganQuery = $conn->prepare("SELECT * FROM ruangan WHERE kode_ruangan = ?");
    $ruanganQuery->bind_param("s", $kodeRuangan);
    $ruanganQuery->execute();
    $result = $ruanganQuery->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $idGedung = $data['id_gedung'];
        $kapasitas = $data['kapasitas'];
        $jenisRuangan = $data['jenis_ruang'];
        $lokasi = $data['lokasi'];
        $status = $data['status'];
        $nik = $data['nik'];
        $fotoLama = $data['foto_ruang'];
    }
}

// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeRuangan = $_POST['kode_ruangan'];
    $idGedung = $_POST['id_gedung'];
    $kapasitas = (int)$_POST['kapasitas'];
    $jenisRuangan = $_POST['jenis_ruang'];
    $lokasi = $_POST['lokasi'];
    $status = $_POST['status'];
    $nik = $_POST['nik'];
    $fotoRuang = $_FILES['foto_ruang'];

    if ($kapasitas <= 1) {
        echo "<script>alert('Kapasitas harus lebih dari 1');</script>";
    } else {
        $uploadDir = '../images/';
        $fotoName = $fotoLama;

        // Upload file baru jika ada
        if ($fotoRuang['error'] === 0) {
            $fotoName = basename($fotoRuang['name']);
            $targetFile = $uploadDir . $fotoName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $validImageTypes)) {
                move_uploaded_file($fotoRuang['tmp_name'], $targetFile);
            }
        }

        if ($isUpdate) {
            // Update dengan 9 parameter
            $sql = "UPDATE ruangan SET id_gedung = ?, kapasitas = ?, jenis_ruang = ?, lokasi = ?, status = ?, nik = ?, foto_ruang = ? WHERE kode_ruangan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param( $idGedung, $kapasitas, $jenisRuang, $lokasi, $status, $nik, $fotoName, $kodeRuangan);
        } else {
            // Insert dengan 9 parameter
            $sql = "INSERT INTO ruangan (kode_ruangan, id_gedung, kapasitas, jenis_ruang, lokasi, status, nik, foto_ruang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param( $kodeRuangan, $idGedung, $kapasitas, $jenisRuang, $lokasi, $status, $nik, $fotoName);
        }
        

        if ($stmt->execute()) {
            echo "<script>alert('Data ruangan berhasil disimpan!'); window.location.href = 'home-admin.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isUpdate ? 'Edit' : 'Tambah'; ?> Ruangan || APPRIM</title>
    <link rel="stylesheet" href="../front-end/css/style-auth.css">
</head>
<body>
    <div class="container">
        <h2><?= $isUpdate ? 'Edit' : 'Tambah'; ?> Ruangan</h2>
        <form action="tambah-ruangan.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="kode_ruangan">Kode Ruangan</label>
                <input class="text" type="text" id="kode_ruangan" name="kode_ruangan" value="<?= $kodeRuangan; ?>" required <?= $isUpdate ? 'readonly' : ''; ?>>

                <label for="id_gedung">Gedung</label>
                <select class="text" id="id_gedung" name="id_gedung" required>
                    <?php while ($gedung = $gedungQuery->fetch_assoc()) : ?>
                        <option value="<?= $gedung['id_gedung']; ?>" <?= isset($idGedung) && $idGedung == $gedung['id_gedung'] ? 'selected' : ''; ?>>
                            <?= $gedung['nama_gedung']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="kapasitas">Kapasitas</label>
                <input class="text" type="number" id="kapasitas" name="kapasitas" value="<?= $kapasitas; ?>" min="2" required>

                <label for="jenis_ruang">Jenis Ruangan</label>
                <select class="text" id="jenis_ruang" name="jenis_ruang" required>
                    <option value="ruang rapat" <?= $jenisRuangan === 'ruang rapat' ? 'selected' : ''; ?>>Ruang Rapat</option>
                    <option value="ruang diskusi" <?= $jenisRuangan === 'ruang diskusi' ? 'selected' : ''; ?>>Ruang Diskusi</option>
                </select>

                <label for="lokasi">Lokasi</label>
                <input class="text" type="text" id="lokasi" name="lokasi" value="<?= $lokasi ?: 'Lantai'; ?>" required>

                <label for="status">Status Ruangan</label>
                <select class="text" id="status" name="status" required>
                    <option value="tertutup" <?= $status === 'tertutup' ? 'selected' : ''; ?>>Tertutup</option>
                    <option value="terbuka" <?= $status === 'terbuka' ? 'selected' : ''; ?>>Terbuka</option>
                </select>

                <label for="nik">PIC Ruangan</label>
                <select class="text" id="nik" name="nik" required>
                    <?php while ($user = $usersQuery->fetch_assoc()) : ?>
                        <option value="<?= $user['nik']; ?>" <?= isset($nik) && $nik == $user['nik'] ? 'selected' : ''; ?>>
                            <?= $user['nama_lengkap']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label for="foto_ruang">Foto Ruangan</label>
                <input class="text" type="file" id="foto_ruang" name="foto_ruang" accept="image/*" <?= !$isUpdate ? 'required' : ''; ?>>
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
