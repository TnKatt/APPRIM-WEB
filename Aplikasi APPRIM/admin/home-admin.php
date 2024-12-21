<?php
// Menghubungkan ke database
include "../koneksi/koneksi.php";

// Mulai sesi di awal file
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php"); // Jika belum login, redirect ke login page
    exit();
}

// Query untuk mengambil semua data gedung
$sql = "SELECT * FROM gedung";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPRIM | HOME</title>
    <link rel="stylesheet" href="../front-end/css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="header">
        <!-- Kiri: Logo + Navigasi HOME, PROFIL, HISTORY -->
        <div class="header-left">
            <img src="../images/logo.jpg" alt="Logo" class="logo">
            <nav class="nav-left">
                <a href="../admin/home-admin.php">HOME</a>
                <a href="../admin/profile-admin.php">PROFIL</a>
                <a href="../admin/history-admin.php">HISTORY</a>
                <a href="../admin/kelola-user-admin.php">KELOLA USER</a>
            </nav>
        </div>

        <!-- Kanan: LOG OUT + Bell Icon -->
        <div class="header-right">
            <a href="../auth/logout.php" class="logout">LOG OUT</a>
            <a href="../admin/notifikasi-admin.php">
                <ion-icon name="notifications-outline" class="bell"></ion-icon>
            </a>
        </div>
    </div>

    <div class="content">
        <h1>Daftar Gedung</h1>
        <!-- Button untuk menambah gedung (di bawah daftar gedung) -->
        <div class="">
            <a href="../admin/tambah-gedung.php">
                <button class="button">Tambah Gedung</button>
            </a>
        </div>
        <!-- Menampilkan daftar gedung -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="box">
                    <img src="../images/<?php echo $row['foto_gedung']; ?>" alt="<?php echo $row['nama_gedung']; ?>">
                    <div class="detail-box">
                        <h2><?php echo $row['nama_gedung']; ?></h2>
                        <p><?php echo $row['deskripsi']; ?></p>
                        <button onclick="location.href='daftar-ruangan-admin.php?id=<?php echo $row['id_gedung']; ?>'">Pilih Ruang</button>
                        <!-- Button Hapus Gedung -->
                        <button onclick="deleteBuilding(<?php echo $row['id_gedung']; ?>)">Hapus Gedung</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada data gedung tersedia.</p>
        <?php endif; ?>

    </div>

    <script>
        // Fungsi untuk menghapus gedung
        function deleteBuilding(buildingId) {
            if (confirm('Apakah Anda yakin ingin menghapus gedung ini?')) {
                window.location.href = '../admin/hapus-gedung.php?id=' + buildingId;
            }
        }
    </script>
</body>
</html>
