<?php
include "../koneksi/koneksi.php";

// Ambil data dari tabel
$sql = "SELECT * FROM ruangan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPRIM | Daftar Ruangan</title>
    <link rel="stylesheet" href="../front-end/css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="../images/logo.jpg" alt="Logo" class="logo">
            <nav class="nav-left">
                <a href="../mahasiswa/home-mahasiswa.php">HOME</a>
                <a href="../mahasiswa/profile-mahasiswa.php">PROFIL</a>
                <a href="../mahasiswa/history-mahasiswa.php">HISTORY</a>
            </nav>
        </div>
        <div class="header-right">
            <a href="../auth/logout.php">LOG OUT</a>
            <a href="../mahasiswa/notifikasi-mahasiswa.php">
                <ion-icon name="notifications-outline" class="bell"></ion-icon></a>
        </div>
    </div>

    <div class="content">
        <h2 class="title">Daftar Ruangan</h2>
        <a href="../mahasiswa/home-mahasiswa.php" class="back">Kembali ke daftar gedung</a>

        <div class="room-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="room-body">
                        <img src="../images/' . $row['foto_ruang'] . '" alt="Gambar Ruangan">
                        <h3>' . htmlspecialchars($row['jenis_ruang']) .'</h3>
                        <p>Nama Ruangan: ' . htmlspecialchars($row['kode_ruangan']) . '</p>
                        <p>Lokasi: ' . htmlspecialchars($row['lokasi']) . '</p>
                        <p>Kapasitas: ' . htmlspecialchars($row['kapasitas']) . '</p>
                        <p>Rating: ' . htmlspecialchars($row['rating']) . ' / 10</p>
                        <p>Fasilitas: ' . htmlspecialchars($row['fasilitas']) . '</p>
                        <div class="status">
                            <span class="' . ($row['status'] == 'Tertutup'? 'open' : 'closed') . '">' . htmlspecialchars($row['status']) . '</span>';
                    if ($row['status'] == 'Terbuka') {
                        echo '<a href="../mahasiswa/formulir-pesanan-mahasiswa.php"><button>Pilih</button></a>';
                    }
                    echo '
                        </div>
                    </div>';
                }
            } else {
                echo "<p>Tidak ada ruangan tersedia.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
