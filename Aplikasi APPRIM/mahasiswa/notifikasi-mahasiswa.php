<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notifikasi</title>
        <link href="../front-end/css/style-auth.css" rel="stylesheet"/>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </head>
    
    <body>
    <div class="header">
        <!-- Kiri: Logo + Navigasi HOME, PROFIL, HISTORY -->
        <div class="header-left">
            <img src="../images/logo.jpg" alt="Logo" class="logo">
            <nav class="nav-left">
                <a href="../mahasiswa/home-mahasiswa.php">HOME</a>
                <a href="../mahasiswa/profile-mahasiswa.php">PROFIL</a>
                <a href="../mahasiswa/history-mahasiswa.php">HISTORY</a>
            </nav>
        </div>

        <!-- Kanan: LOG OUT + Bell Icon -->
        <div class="header-right">
            <a href="../auth/logout.php" class="logout">LOG OUT</a>
            <a href="../mahasiswa/notifikasi-mahasiswa.php"> <!-- Gantilah URL ini sesuai kebutuhan -->
                <ion-icon name="notifications-outline" class="bell"></ion-icon>
            </a>
        </div>
    </div>

    <div class="content">
        <h2>Notifikasi</h2>

        <div class="notification">
            <div class="left">
            <div class="code">
            TA.22A
            </div>
            <div class="details">
            <div>
            01-11-2024, 08:00 - 10:00 WIB
            </div>
            <div>
            Bimbingan Mahasiswa
            </div>
            </div>
            </div>
            <div class="right">
            1 Hari 2 Jam 30 Menit 20 Detik
            </div>
        </div>
    <div class="notification">
        <div class="left">
        <div class="code">
        TA.61
        </div>
        <div class="details">
        <div>
        01-11-2024, 08:00 - 10:00 WIB
        </div>
        <div>
        PBL Mentoring
        </div>
        </div>
        </div>
        <div class="right">
        Selesai
        </div>
    </div>
    </div>
  
</body>
</html>