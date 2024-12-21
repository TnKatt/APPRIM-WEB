<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History</title>
        <link rel='stylesheet' href='../front-end/css/style-auth.css'>
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
            <h1>HISTORY</h1>
            <div class="history-item">
                <div class="inner-border">
                    <div class="left">
                        <div class="code">
                            TA.22A
                        </div>  
                    <div class="details">
                        <p>01-11-2024, 08:00 - 10:00 WIB</p>
                        <p>Bimbingan Mahasiswa</p>
                    </div>
                </div>

                <div class="right">
                    <div class="status">Berlangsung</div>

                <div class="buttons">
                    <a href="../mahasiswa/batal-pesanan-mahasiswa.php"><button class="cancel">Batalkan</button></a>
                    <a href="../mahasiswa/detail-history-mahasiswa.php"><button class="detail">Detail</button></a>
                </div>

                    </div>
                </div>
            </div>
            <div class="history-item">
                <div class="inner-border">
                    <div class="left">
                        <div class="code">TA.61</div>

                    <div class="details">
                        <p>01-11-2024, 08:00 - 10:00 WIB</p>
                        <p>PBL Mentoring</p>
                    </div>
                </div>

                <div class="right">
                    <div class="status">Selesai</div>
                
                        <div class="buttons">
                            <a href="../mahasiswa/rating-mahasiswa.php"><button class="rating">Rating</button></a>
                            <button class="detail">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
