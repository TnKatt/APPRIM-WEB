<!DOCTYPE html>
<html lang='id'>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #d3d3d3;
        }
        .header {
            background-color: #0077B5;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            justify-content: space-between; /* Elemen kiri & kanan berjauhan */
        }

        /* Kiri: Logo + Navigasi */
        .header-left {
            display: flex;
            align-items: center;
        }

        /* Gaya logo */
        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 20px;
        }

        /* Navigasi kiri */
        .nav-left {
            display: flex;
            gap: 20px; /* Jarak antar menu */
        }

        .nav-left a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Kanan: LOG OUT + Bell */
        .header-right {
            display: flex;
            align-items: center;
            gap: 10px; /* Jarak antara logout dan bell */
        }

        .header-right a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Icon bell */
        .header-right ion-icon {
            font-size: 20px;
            color: #fff;
        }

        /* Hover efek pada link */
        .header a:hover {
            text-decoration: underline;
        }

        .bell{
            margin-right: 40px;
        }
        .container {
            padding: 100px 20px;
            display: flex;
            justify-content: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: white;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th colspan="3">Database User</th>
                </tr>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Dosen</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>4342401070</td>
                    <td>100012</td>
                    <td>21211212</td>
                </tr>
                <tr>
                    <td>4342401071</td>
                    <td>100015</td>
                    <td>21211213</td>
                </tr>
                <tr>
                    <td>4342401072</td>
                    <td>100017</td>
                    <td>21211214</td>
                </tr>
                <tr>
                    <td>4342401073</td>
                    <td>102020</td>
                    <td>21211215</td>
                </tr>
                <tr>
                    <td>4342401074</td>
                    <td>103025</td>
                    <td>21211216</td>
                </tr>
                <tr>
                    <td>4342401075</td>
                    <td>105038</td>
                    <td>21211217</td>
                </tr>
                <tr>
                    <td>4342401076</td>
                    <td>106042</td>
                    <td>21211220</td>
                </tr>
                <tr>
                    <td>4342401077</td>
                    <td>106044</td>
                    <td>21211224</td>
                </tr>
                <tr>
                    <td>4342401078</td>
                    <td>107048</td>
                    <td>21211228</td>
                </tr>
                <tr>
                    <td>4342401079</td>
                    <td>107051</td>
                    <td>21211230</td>
                </tr>
                <tr>
                    <td>4342401080</td>
                    <td>107054</td>
                    <td>21211236</td>
                </tr>
                <tr>
                    <td>4342401081</td>
                    <td>109057</td>
                    <td>21211240</td>
                </tr>
                <tr>
                    <td>4342401082</td>
                    <td>109064</td>
                    <td>21211247</td>
                </tr>
                <tr>
                    <td>4342401083</td>
                    <td>112086</td>
                    <td>21211253</td>
                </tr>
                <tr>
                    <td>4342401084</td>
                    <td>112092</td>
                    <td>21211259</td>
                </tr>
                <tr>
                    <td>4342401085</td>
                    <td>112093</td>
                    <td>21211264</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>