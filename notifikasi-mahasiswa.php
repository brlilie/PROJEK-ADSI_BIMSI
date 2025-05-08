<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: /bimsi/index.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bimsi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="notifikasi-mahasiswa.css">
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<?php require_once('layout/navbar.php') ?>

<div class="wrapper">
    <div class="notification-card">
        <div class="notif-content">
            <p class="notif-message">
            Progress Bimbingan <strong>Penyusunan Kerangka Pemikiran dan Hipotesis</strong> pada tanggal <strong>28 Maret 2025</strong>
            telah diperbarui oleh <strong>Dosen Pembimbing 2</strong>
            </p>
            <div class="notif-meta">
            <span class="notif-time">14:00 WIB</span>
            <span class="notif-date">Sabtu, 28 Maret 2025</span>
            </div>
        </div>
    </div>

    <div class="notification-card">
        <div class="notif-content">
            <p class="notif-message">
            Progress Bimbingan <strong>Penyusunan Latar Belakang dan Rumusan Masalah pada Bab 1 </strong> pada tanggal <strong>26 Maret 2025</strong>
            telah diperbarui oleh <strong>Dosen Pembimbing 1</strong>
            </p>
            <div class="notif-meta">
            <span class="notif-time">14:00 WIB</span>
            <span class="notif-date">Kamis, 26 Maret 2025</span>
            </div>
        </div>
    </div>




</div>





   

<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
