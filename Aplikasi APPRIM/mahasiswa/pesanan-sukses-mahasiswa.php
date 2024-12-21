<html>
    <head>
        <title>Pesanan Berhasil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <div class="content-pesanan">
            <h1>
                Pesanan berhasil di Pesan
            </h1>
            <div class="outer-card">
                <div class="card">
                <div style="display: flex; align-items: center;">
                <div style="text-align: center;">
                <img alt="ruang" height="100" src="../images/22A.jpg" width="100"/>
                <div class="room-code">TA.22A</div>
            </div>
            <div class="details">
                <h2>Ruang Rapat</h2>
                <p>Nama Ruangan : TA. 22A</p>
                <p>Lokasi : Lantai 2</p>
                <p>PIC Ruangan : -</p>
                <p>Kapasitas : -</p>
                <p>Rating : 8.3 / 10</p>
                <p>Fasilitas : Whiteboard, AC, TV, Injector, Mic & amp, Sound System</p>
            </div>
        </div>

        <div class="info">
            <p>NIK Pemesan :</p>
            <p>Nama Pemesan :</p>
            <p>Tanggal Memesan : 16:00 WIB, 29 Oktober 2024</p>
            <p>Tanggal Pemakaian : 01 November 2024</p>
            <p>Jam Pemakaian : 08:00 - 10:00 WIB</p>
            <p>Keperluan : Bimbingan Mahasiswa</p>
            
        </div>
        
        <div class="buttons">
            <a href="../mahasiswa/home-mahasiswa.php"><button>Kembali home</button></a>
            <button>Email PIC</button>
        </div>
    </body>
</html>