<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: /bimsi/index.php");
    exit();
  }

 // Admin static data
$adminName = "Mira Sephira";
$adminNim = "Admin";
$adminProfilePic = "https://i.pravatar.cc/100?img=12"; // You can replace with your actual path

// Logged-in user info (fallbacks added)
$userName = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';
$nim = isset($_SESSION['npm']) ? $_SESSION['npm'] : '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bimsi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="message.css">
  

  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


</head>
<body>
<?php require_once('layout/navbar.php') ?>

<div class="chat-container">
  <div class="sidebar">
    <div class="admin-contact">
      <img src="<?= htmlspecialchars($adminProfilePic) ?>" alt="Admin" style="width: 40px; height: 40px; border-radius: 50%;">
      <div>
        <strong><?= htmlspecialchars($adminName) ?></strong><br>
        <small><?= htmlspecialchars($adminNim) ?></small>
      </div>
    </div>
  </div>

<div class="chat-main">
  <div class="chat-box" id="chat-box"></div>
  
  <div class="chat-footer p-2 bg-white">
  <form id="chat-form" class="d-flex align-items-center gap-2">
    <input type="text" id="message" class="form-control" placeholder="Ketik Pesan..." autocomplete="off">
    <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center"
            style="width: 42px; height: 42px; border-radius: 50%;">
      <i class="bi bi-send-fill" style="font-size: 1.2rem;"></i>
    </button>
  </form>


  </div>
</div>


<script>
  const form = document.getElementById('chat-form');
  const messageBox = document.getElementById('message');
  const chatBox = document.getElementById('chat-box');

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const message = messageBox.value.trim();
    if (message === '') return;

    fetch('send_message.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `message=${encodeURIComponent(message)}`
    }).then(res => res.text()).then(() => {
      messageBox.value = '';
      loadMessages();
    });
  });

  function loadMessages() {
  fetch('get_messages.php')
    .then(response => response.json())
    .then(data => {
      chatBox.innerHTML = '';
      data.forEach(msg => {
        const div = document.createElement('div');
        div.className = 'message my-message';

        div.innerHTML = `
          <div>${msg.text}</div>
          <div class="timestamp">${msg.time}</div>
        `;

        chatBox.appendChild(div);
      });
      chatBox.scrollTop = chatBox.scrollHeight;
    });
}


  setInterval(loadMessages, 2000);
  loadMessages();
</script>



<!-- Your main content here -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
