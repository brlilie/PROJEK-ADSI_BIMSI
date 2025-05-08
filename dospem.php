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
  <link rel="stylesheet" href="dospem.css?v=2">
  <link rel =" stylesheet" href="button.css"
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


</head>
<body>
<?php require_once('layout/navbar.php') ?>
<div class="card-container">
    <div class="card">
      <img src="asset/anindita.jpg" alt="Anindita" class="profile-pic">
      <h5>Anindita</h5>
      <p>2317051064</p>
      <button onclick="openOverlay('Anindita', '2317051064', 'https://i.imgur.com/jfL6gxh.png', this)">Ajukan Bimbingan</button>
      </div>
    <div class="card">
      <img src="asset/dosen2.jpeg" alt="Muhaqiqin"  class="profile-pic">
      <h5>Muhaqiqin</h5>
      <p>NIP</p>
      <button onclick="openOverlay('Muhaqiqin', '2317051078', 'https://i.imgur.com/g1s9Y5g.png', this)">Ajukan Bimbingan</button>
      </div>
</div>

  
<div class="overlay" id="overlay">
  <div class="popup">
    <button class="close" onclick="closeOverlay()">&times;</button>
    <img id="popup-img" src="asset/anindita.jpg" alt="Foto Dosen">
    <p class="nip-label">Nama:</p>
    <p id="popup-name" class="nip-value">-</p>

    <p class="nip-label">NIP:</p>
    <p id="popup-nip" class="nip-value">-</p>

    <label for="dosen" class="select-label">Dosen Pembimbing:</label>
    <select id="dosen" class="custom-select">
      <option>Dosen Pembimbing 1</option>
      <option>Dosen Pembimbing 2</option>
    </select>

    <label for="file-upload" class="custom-file-label d-flex align-items-center">
      <i class="bi bi-file-earmark-text-fill" style="font-size: 2rem; color: #0d6efd; margin-right: 10px;"></i>
      Lampirkan Surat Keterangan Dosen Pembimbing
    </label>
    <input type="file" id="file-upload" style="display: none;">

    <label class="checkbox-label">
    <input type="checkbox" onchange="handleCheckboxToggle()">
    Apakah kamu yakin surat keterangan yang dilampirkan adalah valid?
    </label>

    <div class="d-flex justify-content-center mt-3">
    <button class="button" type="button" onclick="handleSubmit()" disabled>Kirim</button>
    </div> 
  </div>
</div>
   

<script>
  let lastClickedButton = null;
  const fileInput = document.getElementById('file-upload');
  const fileLabel = document.querySelector('.custom-file-label');
  const checkbox = document.querySelector('.checkbox-label input[type="checkbox"]');
  const checkboxContainer = document.querySelector('.checkbox-label');
  const submitBtn = document.querySelector('.popup .button');
  const selectInput = document.getElementById('dosen');

  let fileUploaded = false;

  // Maps to remember state per button
  const validatedButtons = new WeakMap();
  const uploadedFiles = new WeakMap();
  const selectedOptions = new WeakMap();

  function openOverlay(name, nip, imgUrl, button) {
    lastClickedButton = button;

    document.getElementById('popup-name').innerText = name;
    document.getElementById('popup-nip').innerText = nip;
    document.getElementById('popup-img').src = imgUrl;

    const alreadyValidated = validatedButtons.get(button);
    const alreadyUploaded = uploadedFiles.get(button);
    const previousSelect = selectedOptions.get(button);

    // Set file state
    if (alreadyUploaded) {
      fileUploaded = true;
      updateFileLabel(true);
    } else {
      fileUploaded = false;
      fileInput.value = '';
      updateFileLabel(false);
    }

    // Restore select state
    if (previousSelect) {
      selectInput.value = previousSelect;
    } else {
      selectInput.selectedIndex = 0;
    }

    // Handle locked state
    if (alreadyValidated) {
      submitBtn.textContent = "Menunggu Validasi";
      submitBtn.disabled = true;
      checkboxContainer.style.display = 'none';
      fileInput.disabled = true;
      selectInput.disabled = true;
    } else {
      submitBtn.textContent = "Kirim";
      submitBtn.disabled = true;
      checkbox.checked = false;
      checkboxContainer.style.display = 'block';
      fileInput.disabled = false;
      selectInput.disabled = false;
    }

    document.getElementById('overlay').style.display = 'flex';
  }

  function closeOverlay() {
    document.getElementById('overlay').style.display = 'none';
  }

  function updateFileLabel(active = false) {
    if (active) {
      fileLabel.style.backgroundColor = '#d0d0d0';
      fileLabel.style.border = '1px solid #999';
    } else {
      fileLabel.style.backgroundColor = '';
      fileLabel.style.border = '';
    }
  }

  function updateSubmitState() {
    if (validatedButtons.get(lastClickedButton)) {
      submitBtn.disabled = true;
    } else {
      submitBtn.disabled = !(checkbox.checked && fileUploaded);
    }
  }

  fileInput.addEventListener('change', function () {
    fileUploaded = this.files.length > 0;
    updateFileLabel(fileUploaded);
    updateSubmitState();
  });

  checkbox.addEventListener('change', function () {
    updateSubmitState();
  });

  submitBtn.addEventListener('click', function (e) {
    e.preventDefault();

    if (!fileUploaded) {
      alert("Harap lampirkan dokumen terlebih dahulu.");
      return;
    }

    if (!checkbox.checked) {
      alert("Harap centang pernyataan validitas.");
      return;
    }

    // Save state
    validatedButtons.set(lastClickedButton, true);
    uploadedFiles.set(lastClickedButton, true);
    selectedOptions.set(lastClickedButton, selectInput.value);

    // Disable fields
    fileInput.disabled = true;
    selectInput.disabled = true;

    // Close overlay
    document.getElementById('overlay').style.display = 'none';

    // Change button text
    setTimeout(() => {
      if (lastClickedButton) {
        lastClickedButton.textContent = "Menunggu Validasi";
      }
    }, 300);
  });
</script>






   

<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
