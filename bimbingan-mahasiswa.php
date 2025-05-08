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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bimsi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/navbar.css"/>
  <link rel="stylesheet" href="bimbingan-mahasiswa.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body>
<?php require_once('layout/navbar.php'); ?>

<form method="POST" action="submit_bimbingan.php">
  <div class="mb-2 d-flex justify-content-between align-items-end bimbingan-title-container">
    <div style="flex-grow: 1;">
      <label for="judulBimbingan" class="bimbingan-label fw-semibold mb-1">Judul</label>
      <input type="text" name="judul" id="judulBimbingan" class="form-control form-control-lg fw-semibold border-0 ps-0"
             placeholder="Masukkan Judul Bimbingan"
             value="Penyusunan Kerangka Pemikiran dan Hipotesis pada Bab 1"
             style="font-size: 24px;">
    </div>
    <div style="width: 140px; text-align: right;">
      <span class="text-muted small" id="timestamp"></span>
    </div>
  </div>

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
      <div><strong>to:</strong> <span id="recipientName">Anindita Tri Mulia</span></div>
      <input type="hidden" name="dosen" id="dosenValue" value="Anindita Tri Mulia">

      <div class="dropdown custom-dropdown">
        <button class="btn dosen-pill" type="button" id="dropdownDosen" data-bs-toggle="dropdown" aria-expanded="false">
          <span id="dosenLabel">Dosen Pembimbing 1</span>
          <i class="bi bi-chevron-down ms-2"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownDosen">
          <li><a class="dropdown-item" href="#" data-name="Anindita Tri Mulia" data-role="Dosen Pembimbing 1">Dosen Pembimbing 1</a></li>
          <li><a class="dropdown-item" href="#" data-name="Didik Kurniawan" data-role="Dosen Pembimbing 2">Dosen Pembimbing 2</a></li>
        </ul>
      </div>
    </div>

    <div class="mb-3">
      <label class="bimbingan-label">Tipe Progress</label>
      <div class="dropdown dropdown-underline custom-progress-dropdown">
        <button class="dropdown-btn-plain d-flex justify-content-between align-items-center" type="button" id="dropdownProgress" data-bs-toggle="dropdown" aria-expanded="false">
          <span id="progressLabel">Pilih Progress</span>
          <i class="bi bi-chevron-down"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownProgress">
          <li><a class="dropdown-item" href="#" data-value="Progress 1">Progress 1</a></li>
          <li><a class="dropdown-item" href="#" data-value="Progress 2">Progress 2</a></li>
        </ul>
      </div>
      <input type="hidden" name="progress" id="progressValue">
    </div>

    <div class="mb-3">
      <label class="bimbingan-label fw-bold text-primary">Tipe Bimbingan</label>
      <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn bimbingan-btn active" data-type="online">Online</button>
        <button type="button" class="btn bimbingan-btn" data-type="offline">Offline
          <i class="bi bi-calendar ms-2" id="calendarIcon" style="display: none;"></i>
        </button>
        <input type="date" class="form-control form-control-sm ms-2" id="offlineDate" name="offline_date" style="max-width: 160px; display: none;">
        <input type="hidden" name="tipe_bimbingan" id="tipeBimbingan" value="online">
      </div>
    </div>

    <div class="mb-3">
      <label class="bimbingan-label">Isi Teks di sini</label>
      <textarea class="form-control" name="pesan" rows="4" placeholder="Tulis pesan bimbingan di sini..."></textarea>
    </div>

    <div class="mb-3">
      <label class="bimbingan-label">Link Google Document</label>
      <textarea class="form-control" name="link" rows="1" placeholder="Paste file di sini.."></textarea>
    </div>

    <div class="d-flex justify-content-center mt-3">
      <button class="button" type="submit" name="ajukan_bimbingan">Ajukan Bimbingan</button>
    </div>
  </div>
</form>

<script>
  // Timestamp
  function updateDateOnly() {
    const options = {
      timeZone: 'Asia/Jakarta',
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    };
    const formatter = new Intl.DateTimeFormat('en-GB', options);
    document.getElementById('timestamp').innerText = formatter.format(new Date());
  }
  updateDateOnly();

  // Dosen dropdown
  document.querySelectorAll('#dropdownDosen + .dropdown-menu .dropdown-item').forEach(item => {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      const name = this.getAttribute('data-name');
      const role = this.getAttribute('data-role');
      document.getElementById('recipientName').innerText = name;
      document.getElementById('dosenLabel').innerText = role;
      document.getElementById('dosenValue').value = name;
      bootstrap.Dropdown.getOrCreateInstance(document.getElementById('dropdownDosen')).hide();
    });
  });

  // Progress dropdown
  document.querySelectorAll('#dropdownProgress + .dropdown-menu .dropdown-item').forEach(item => {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      const value = this.getAttribute('data-value');
      document.getElementById('progressLabel').innerText = value;
      document.getElementById('progressValue').value = value;
      bootstrap.Dropdown.getOrCreateInstance(document.getElementById('dropdownProgress')).hide();
    });
  });

  // Tipe bimbingan toggle
  const calendarIcon = document.getElementById('calendarIcon');
  const offlineDate = document.getElementById('offlineDate');
  document.querySelectorAll('.bimbingan-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.bimbingan-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const type = btn.getAttribute('data-type');
      document.getElementById('tipeBimbingan').value = type;
      if (type === 'offline') {
        calendarIcon.style.display = 'inline';
        offlineDate.style.display = 'inline-block';
      } else {
        calendarIcon.style.display = 'none';
        offlineDate.style.display = 'none';
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
