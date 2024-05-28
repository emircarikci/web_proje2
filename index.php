<?php
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "dbusr21360859060";
$password = "klbiztIyygYN";
$dbname = "dbstorage21360859060";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Sayfa belirleme
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

function loadPage($page, $conn) {
    include $page . '.php';
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Projesi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
        }
        .bg {
            background-image: url('bcpage.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-top: 10%;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .footer-link {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }
    </style>
</head>
<body>
    <?php loadPage($page, $conn); ?>
    <div class="footer-link">
        <a href="https://github.com/emircarikci/web_proje2.git" class="btn btn-custom" target="_blank">GitHub Proje Linki</a>
        <br>
        <a href="https://github.com/emircarikci/web_proje2.git" target="_blank">https://github.com/emircarikci/web_proje2.git</a>
    </div>
</body>
</html>
