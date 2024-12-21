<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>APPRIM | LOGIN</title>
        <link rel="stylesheet" href="../front-end/css/style-auth.css">
    </head>
    
    <body>
        <div class="container">
            <form action="validasi-login.php" method="POST">
                <div class="form-group">
                    <label for="username">Tanggal Pemakaian:</label>
                    <input class ="text" type="date" id="nik" name="nik" placeholder='Masukkan Tanggal' required >

                    <label for="username">Jam Mulai:</label>
                    <input class ="text" type="text" id="nik" name="nik" placeholder='Mulai' required >

                    <label for="username">Jam Selesai:</label>
                    <input class ="text" type="text" id="nik" name="nik" placeholder='Selesai' required >

                    <label for="password">Tujuan Pemesanan:</label>
                    <input class ="text" type="text" id="text" name="password" placeholder='Masukkan Tujuan Anda' required>
                </div>

                <div class="button-group">
                    <a href="../mahasiswa/verifikasi-pesanan-mahasiswa.php"><button type="submit" value="submit" id="button">Pesan</button></a>
                </div>
            </form>

            <div class="back-to-login">
                <hr/>
                    <span><a href='../mahasiswa/home-mahasiswa.php'>Back to Home</a></span>
                <hr/>
            </div>

            <div class="footer">
                APPRIM</br>
                Aplikasi Pengolahan Peminjaman Ruang Meeting
            </div>
        </div>
    </body>
</html>