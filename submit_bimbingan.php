<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: /bimsi/index.php");
    exit();
}

// Only process form if it's submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajukan_bimbingan'])) {
    // Grab values from form
    $email = $_SESSION['email'];
    $judul = $_POST['judul'] ?? '';
    $dosen = $_POST['dosen'] ?? '';
    $progress = $_POST['progress'] ?? '';
    $tipe_bimbingan = $_POST['tipe_bimbingan'] ?? '';
    $pesan = $_POST['pesan'] ?? '';
    $link = $_POST['link'] ?? '';
    $offline_date = $_POST['offline_date'] ?? '';
    $timestamp = date("Y-m-d H:i:s");

    // CSV file path
    $file = 'database/bimbingan_data.csv';

    // Create data array
    $data = [$timestamp, $email, $judul, $dosen, $progress, $tipe_bimbingan, $offline_date, $pesan, $link];

    // Make sure directory exists
    if (!file_exists('data')) {
        mkdir('data', 0777, true);
    }

    // Save to CSV
    $fp = fopen($file, 'a');
    if ($fp) {
        fputcsv($fp, $data);
        fclose($fp);
        // Redirect to activity page
        header("Location: activity.php");
        exit();
    } else {
        echo "Gagal menyimpan data. Coba lagi.";
    }
} else {
    echo "Akses tidak sah.";
}
?>
