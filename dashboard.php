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
  <link rel="stylesheet" href="dashboard.css">
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<?php require_once('layout/navbar.php') ?>

<div class="wrapper">
  <div class="container mt-4">
     <h5 class="fw-bold text-primary">Aktivitas Bimbingan</h5>
      <div class="news-card mx-auto">
            <div class="news-header d-flex justify-content-between align-items-start">
              <h5 class="news-title">
                Aktivitas bimbingan berhenti sementara pada hari senin, <strong>7 april 2025</strong>
              </h5>
              <small class="text-muted">dari Admin</small>
            </div>
              <p class="news-desc">
                  Website akan melakukan maintenance sehingga aktivitas bimbingan pada website diliburkan
              </p>
            <div class="news-footer d-flex justify-content-end align-items-center gap-2">
              <small class="text-muted fst-italic">Kamis, 3 April 2025</small>
              <i class="bi bi-clock"></i>
              <small class="text-muted fst-italic">07:00 WIB</small>
            </div>
      </div>
  </div>

  <div class="container2 mt-4">
    <h5 class="fw-bold text-primary">Aktivitas Bimbingan</h5>
    <table class="table bimbingan-table text-center align-middle">
      <thead>
        <tr>
          <th>Hari</th>
          <th>Nama</th>
          <th>Tipe Bimbingan</th>
          <th>Status</th>
          <th>Hasil</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Senin, 08-04-2025</td>
          <td>Ratu Berliana Rosfadia M</td>
          <td>Online</td>
          <td>Menunggu untuk divalidasi</td>
          <td>Belum ada hasil</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



   

<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
