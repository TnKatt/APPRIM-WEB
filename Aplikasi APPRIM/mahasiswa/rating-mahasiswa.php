<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>
    <!-- ikon bell -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .left-side {
            display: flex;
            align-items: center;
        }

        .header img {
            height: 40px;
            vertical-align: middle;
            border-radius: 50%;
            margin-right: 20px;
        }

        .header nav {
            display: flex;
            gap: 30px;
        }

        .header nav a   {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .header .logout {
            display: flex;
            align-items: center;
        }

        .header .logout a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 40px;
        }

        .header .logout i {
            font-size: 20px;
            cursor: pointer;
        }

        .content {
            text-align: center;
            padding: 10px 5px;
        }

        .content h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .rating-box {
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 10px;
            text-align: left;
            width: 250%;
            max-width: 750px;
            border: 20px solid #ccc;
        }

        .rating-box .info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .rating-box .info .class {
            background-color: #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            margin-right: 50px;
            font-weight: bold;
        }

        .rating-box .info .details {
            flex-grow: 1;
        }

        .rating-box .info .details p {
            margin: 5px 0;
            color: black;
            font-weight: bold;

        }

        .rating-box .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rating-box .actions label {
            color: black;
            font-weight: bold;
            margin-left: 125px; 
            position: relative;
            top: -25px;
        }

        .rating-box .actions input {
            padding: 5px;
            border: 2px solid black;
            position: relative;
            top: -25px;
            margin-left: -110px;
            border-radius: 1px;
            width: 50%;
            max-width: 230px;
        }

        .rating-box .actions .buttons {
            display: flex;
            gap: 10px;
        }

        .rating-box .actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 7px;
            position: relative;
            top: -70px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100px;
        }

        .rating-box .actions .cancel {
            background-color: #ff0000;
            border: 2px solid #000;
        }

        .rating-box .actions .submit {
            background-color: #00b300;
            border: 2px solid #000;
        }

    </style>
</head>

<body>
    <div class="header">
        <div class="left-side">
            <img src="../images/logo.jpg" alt="Logo">
            <nav>
                <a href="../mahasiswa/home-mahasiswa.php">HOME</a>
                <a href="#">PROFILE</a>
                <a href="#">HISTORY</a>
            </nav>
        </div>
        <div class="logout">
            <a href="#">LOG OUT</a>
            <i class="fas fa-bell"></i>
        </div>
    </div>
    <div class="content">
        <h1>RATING</h1>
        <div class="rating-box">
            <div class="info">
                <div class="class">TA.22A</div>
                <div class="details">
                    <p>01 - 11 - 2024, 08:00 - 10:00 WIB</p>
                    <p>Bimbingan Mahasiswa</p>
                </div>
            </div>
            <div class="actions">
                <label for="rating">Rating:</label>
                <input id="rating" placeholder="Masukkan rating dari 1.0 - 10.0" type="text" />
                <div class="buttons">
                    <button class="cancel" onclick="resetRating()">Batalkan</button>
                    <a href="../mahasiswa/history-mahasiswa.php"><button class="submit" onclick="submitRating()">Rating</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>    