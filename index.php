<!--9CB3F6 bg navbar
E5E0E0 shadow button
171515 teks hitam
426BE7 teks heading
F2F5FE bg pemilihan bimbingan dan teks putih (245, 247, 255)
003DF5 warna icon
554E4E teks desc input
9CB3F6 button
7291F0 layer gradient bg login sign up -->

<?php
session_start(); // Start the session

if (isset($_SESSION['email'])) {
  header("Location: /bimsi/dashboard.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $file = 'database/users.csv';

        if (!file_exists($file)) {
            echo "Database tidak ditemukan.";
            exit();
        }

        $found = false;
        $rows = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Skip header
        foreach (array_slice($rows, 1) as $row) {
            $columns = explode(',', $row);

            // Adjust for cases where role may not exist
            $savedEmail = $columns[0] ?? '';
            $savedPassword = $columns[1] ?? '';
            $role = $columns[2] ?? 'mahasiswa'; // Default to mahasiswa if role not given

            if (trim($email) === trim($savedEmail) && trim($password) === trim($savedPassword)) {
                $_SESSION['email'] = $savedEmail;
                $_SESSION['role'] = $role;
                $found = true;
                break;
            }
        }

        if ($found) {
            header("Location: /bimsi/dashboard.php");
            exit();
        } else {
            echo "Email atau password salah.";
        }
    } else {
        echo "Semua field wajib diisi.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimsi Masuk Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-image"></div>
    <div class="bg-overlay"></div>


  <div class="container-fluid login-container">
      <div class="left-text">
        <div class="judulbimsi">
            BIMSI
        </div>
        <p>Ngebantu kamu, <em><b>segera lulus!</b></em></p>
      </div>


      <div class="signup-card">
        <h4 class="judul-login mb-4 text-center">Masuk Akun</h4>
        <form action="/bimsi/" method="POST" >
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <img src="asset/icon/email_icon.png" alt="Email Icon" style="width: 20px; height: 20px;">
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
        </div>
        <div class="mb-3">
          <div class="input-group">
              <span class="input-group-text">
                  <img src="asset/icon/lock_icon.png" alt="Email Icon" style="width: 20px; height: 20px;">
              </span>
              </span>
              <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
          </div>
          </div>

          <div class="d-flex justify-content-center mt-3">
            <button class="button" type="submit">Masuk</button>
          </div> 
          <div class="register-link text-center mt-3">
            Belum memiliki akun? <a href="daftar.php">Daftar Akun</a>
          </div>
        </form>
      </div>
    </div>
  
    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>

