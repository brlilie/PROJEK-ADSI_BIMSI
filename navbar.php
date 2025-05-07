<?php
$namaUser = 'Nama Pengguna';
$npmUser = 'NPM123456';
$fotoUser = 'asset/icon/avatar_icon.png';

if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $csvFile = __DIR__ . '/../database/users.csv';

    if (file_exists($csvFile)) {
        $rows = file($csvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        array_shift($rows); // Skip header

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (trim($data[0]) === $email) {
                $namaUser = $data[3] ?? $namaUser;
                $npmUser = $data[4] ?? $npmUser;
                if (!empty($data[5])) {
                    $fotoUser = 'asset/files/' . $data[5];
                }
                break;
            }
        }
    }
}
?>

<!-- Navbar -->
<!-- Navbar -->
<!-- Navbar -->
<div class="navbar-custom">
  <div class="navbar-inner d-flex justify-content-between align-items-center container-fluid">
    
    <!-- Nav Tabs -->
    <div class="nav-tabs-custom d-flex">
      <!-- Beranda links to dashboard.php -->
      <a href="/bimsi/dashboard.php" class="tab <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">Beranda</a>

      <!-- Bimbingan triggers sidebar -->
      <button id="bimbinganTab" class="tab <?= basename($_SERVER['PHP_SELF']) === 'bimbingan.php' ? 'active' : '' ?>">Bimbingan</button>

      <!-- Admin links to message-mahasiswa.php -->
      <a href="/bimsi/admin_chat.php" class="tab <?= basename($_SERVER['PHP_SELF']) === 'admin_chat.php' ? 'active' : '' ?>">Admin</a>
    </div>

    <!-- User Info -->
    <div class="user-info d-flex align-items-center gap-3">
      <div class="text-end">
        <div id="namaUser" class="fw-bold"><?= htmlspecialchars($namaUser) ?></div>
        <div id="npmUser" class="small text-muted"><?= htmlspecialchars($npmUser) ?></div>
      </div>

      <!-- Profile Photo as link to profile page -->
      <a href="/bimsi/profile-mahasiswa.php">
        <img id="fotoUser" src="<?= htmlspecialchars($fotoUser) ?>" class="rounded-circle" alt="User Photo" style="width: 48px; height: 48px; object-fit: cover; margin-bottom: 4px;">
      </a>

      <!-- Dropdown icon -->
      <div class="dropdown">
        <button class="btn btn-link p-0 m-0 border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-three-dots-vertical fs-4 text-white"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="/bimsi/logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar (hidden by default) -->
<div id="sidebar">  
  <a href="/bimsi/dospem.php">Dosen Pembimbing</a><br>
  <a href="/bimsi/bimbingan-mahasiswa.php">Mengajukan Bimbingan</a><br>
  <a href="/bimsi/activity.php">Aktivitas Bimbinngan</a><br>
  <a href="/bimsi/notifikasi-mahasiswa.php">Notifikasi   </a><br>
  
  <!-- Add more submenu options as needed -->
</div>

<!-- JavaScript to toggle sidebar -->
<script>
  const bimbinganTab = document.getElementById('bimbinganTab');
  const sidebar = document.getElementById('sidebar');

  bimbinganTab.addEventListener('click', (e) => {
    e.stopPropagation(); // prevent closing immediately
    sidebar.classList.toggle('active');
  });

  // Close when clicking outside
  document.addEventListener('click', (event) => {
    if (!sidebar.contains(event.target) && !bimbinganTab.contains(event.target)) {
      sidebar.classList.remove('active');
    }
  });
</script>
