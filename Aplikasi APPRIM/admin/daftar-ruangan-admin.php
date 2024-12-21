<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_apprim";

$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

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
                <a href="../admin/home-admin.php">HOME</a>
                <a href="../admin/profile-admin.php">PROFIL</a>
                <a href="../admin/history-admin.php">HISTORY</a>
            </nav>
        </div>
        <div class="header-right">
            <a href="../auth/logout.php">LOG OUT</a>
            <a href="../admin/notifikasi-admin.php">
                <ion-icon name="notifications-outline" class="bell"></ion-icon>
            </a>
        </div>
    </div>

    <div class="content">
        <h2 class="title">Daftar Ruangan</h2>
        <div>
            <a href="../admin/tambah-ruangan.php">Tambah Ruang</a>
        </div>
        <div class="box-ruangan">
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
                            <span class="' . ($row['status'] == 'Terbuka' ? 'open' : 'closed') . '">' . htmlspecialchars($row['status']) . '</span>';
                    if ($row['status'] == 'Terbuka') {
                        echo '<a href="../admin/formulir-pesanan-admin.php"><button>Pilih</button></a>';
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
            