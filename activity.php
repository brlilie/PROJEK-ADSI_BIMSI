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
  <link rel="stylesheet" href="activity.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<?php require_once('layout/navbar.php') ?>

<div class = "wrapper">
    <div class="bimbingan-card">
        <div class="date-section">
            <strong>Tanggal</strong>
            <small>2 April, 2025</small>
        </div>
        <div class="card-content">
            <div class="content-left">
            <i class="bi bi-file-text file-icon"></i>
            <div class="title-box">
                <div class="title">Penyusunan Kerangka Pemikiran dan Hipotesis pada Bab 1</div>
                <div class="subtitle">Online</div>
                <button class="btn btn-outline-dark btn-sm chapter-btn" disabled>Bab 1</button>
            </div>
            </div>
            <div class="status-tags">
            <span class="status status-validasi">Telah di Validasi</span>
            <span class="status status-lolos">Lolos</span>
            </div>
        </div>
    </div>

    <div class="bimbingan-card">
        <div class="date-section">
            <strong>Tanggal</strong>
            <small>2 April, 2025</small>
        </div>
        <div class="card-content">
            <div class="content-left">
            <i class="bi bi-file-text file-icon"></i>
            <div class="title-box">
                <div class="title">Penyusunan Kerangka Pemikiran dan Hipotesis pada Bab 1</div>
                <div class="subtitle">Online</div>
                <button class="btn btn-outline-dark btn-sm chapter-btn" disabled>Bab 1</button>
            </div>
            </div>
            <div class="status-tags">
            <span class="status status-validasi">Telah di Validasi</span>
            <span class="status status-lolos">Lolos</span>
            </div>
        </div>
    </div>
</div>



   

<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
