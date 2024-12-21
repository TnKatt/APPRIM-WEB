<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../front-end/css/style-auth.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan library jQuery -->
</head>
<body>
    <div class="container">
        <img src="../images/logo.jpg" alt="logo">
        <!-- Error message -->
        <div id="error-message" class="error" style="display: none;"></div>

        <form id="forgot-password-form" method="POST" action="validasi-lupa-password.php">
            <div class='form-group'>
                <label for="nik">NIK :</label>
                <input class="text" type="text" name="nik" id="nik" placeholder="Masukkan NIM / NIDN / NIK" required>

                <label for="nama">Nama Lengkap :</label>
                <input class="text" type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required>

                <label for="email">Email :</label>
                <input class="text" type="text" name="email" id="email" placeholder="Masukkan Email" required>
            </div>

            <div class='button-group'>
                <button type="button" id="validate-button">Submit</button>
            </div>
        </form>

        <div class="back-to-login">
            <hr/>
                <span><a href='../auth/login.php'>Back to Login</a></span>
            <hr/>
        </div>

        <div class="footer">
            APPRIM</br>
            Aplikasi Pengolahan Peminjaman Ruang Meeting
        </div>
    </div>

    <script>
        // AJAX untuk validasi data
        $('#validate-button').on('click', function () {
            const nik = $('#nik').val();
            const nama = $('#nama').val();
            const email = $('#email').val();

            // Validasi input kosong
            if (!nik || !nama || !email) {
                $('#error-message').text('Semua kolom harus diisi.').show();
                return;
            }

            // Kirim data ke server untuk validasi
            $.ajax({
                url: 'validasi-lupa-password.php',
                type: 'POST',
                data: { nik, nama, email },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        // Jika validasi sukses, kirim form
                        $('#error-message').hide();
                        $('#forgot-password-form').submit();
                    } else {
                        // Jika data tidak cocok, tampilkan pesan error
                        $('#error-message').text(result.message).show();
                    }
                },
                error: function () {
                    $('#error-message').text('Terjadi kesalahan saat memproses data.').show();
                }
            });
        });
    </script>
</body>
</html>
