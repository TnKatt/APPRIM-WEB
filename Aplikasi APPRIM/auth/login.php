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
            <img src="../images/logo.jpg" alt="logo">
            <!-- Error message -->
            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <form action="validasi-login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class ="text" type="text" id="nik" name="nik" placeholder='Masukkan NIM / NIDN / NIK' required >
                
                    <label for="password">Password:</label>
                    <input class ="text" type="password" id="text" name="password" placeholder='Masukkan Password' required>
                </div>

                <div class="button-group">
                    <button type="submit" value="submit" id="button">Login</button>
                </div>
            </form>

            <div class="back-to-login">
                <hr/>
                    <span><a href='../auth/lupa-password.php'>Lupa Password</a></span>
                <hr/>
            </div>

            <div class="footer">
                APPRIM</br>
                Aplikasi Pengolahan Peminjaman Ruang Meeting
            </div>
        </div>
    </body>
</html>