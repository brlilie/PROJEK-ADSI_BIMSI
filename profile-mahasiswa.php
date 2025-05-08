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
  <link rel="stylesheet" href="profile-mahasiswa.css">
  

  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<?php require_once('layout/navbar.php') ?>

<div class="profile-section">
  <!-- Mahasiswa Card -->
  <div class="prof-card">
    <img src="asset/ratu.jpg" alt="Mahasiswa" class="profile-img" />
    <div class="info-block">
      <label>Nama</label>
      <div class="info-row">
        <span>Ratu Berliana Rosfadila Machendra</span>
        <i class="edit-icon">✎</i>
      </div>
    </div>

    <div class="info-block">
      <label>NPM</label>
      <div class="info-row"><span>2317051078</span></div>
    </div>

    <div class="info-block">
      <label>Semester</label>
      <span class="pill">Semester 7</span>
    </div>

    <div class="info-block">
      <label>Email</label>
      <div class="info-row">
        <span>RatuBerliana@gmail.com</span>
        <i class="edit-icon">✎</i>
      </div>
    </div>

    <div class="info-block">
      <label>Kata Sandi</label>
      <div class="info-row">
        <span>*** ***</span>
        <i class="edit-icon">✎</i>
      </div>
    </div>

    <div class="info-block">
      <label>Nomor HP</label>
      <div class="info-row">
        <span>08789770515</span>
        <i class="edit-icon">✎</i>
      </div>
    </div>
  </div>

  <!-- Dosen Pembimbing 1 & 2 -->
  <div class="wrapper">
    <h3>Dosen Pembimbing 1</h3>
    <div class="prof-card">
      <img src="asset/anindita.jpg" alt="Dosen 1" class="profile-img" />
      <div class="info-block">
        <label>Nama</label>
        <span>Anindita Tri Mulia</span>
      </div>
      <div class="info-block">
        <label>NIP</label>
        <span>238991984</span>
      </div>
      <div class="info-block">
        <label>Nomor HP</label>
        <span>08123456789</span>
      </div>
    </div>

    <h3>Dosen Pembimbing 2</h3>
    <div class="prof-card">
      <img src="asset/dosen2.jpeg" alt="Dosen 2" class="profile-img" />
      <div class="info-block">
        <label>Nama</label>
        <span>Didik Kurniawan, S.Si., M.T.</span>
      </div>
      <div class="info-block">
        <label>NIP</label>
        <span>196010292005011004</span>
      </div>
      <div class="info-block">
        <label>Nomor HP</label>
        <span>087726443109</span>
      </div>
    </div>
  </div>
</div>


   

<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
