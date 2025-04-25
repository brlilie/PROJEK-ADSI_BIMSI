<!--9CB3F6 bg navbar
E5E0E0 shadow button
171515 teks hitam
426BE7 teks heading
F2F5FE bg pemilihan bimbingan dan teks putih (245, 247, 255)
003DF5 warna icon
554E4E teks desc input
9CB3F6 button
7291F0 layer gradient bg login sign up -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimsi_Pilih Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
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

    <div class="login-card">
        <h4 class="judul-login mb-4 text-center">Daftar Akun</h4>
        <form action="proses_daftar_mahasiswa.php" method="POST">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <img src="../asset/icon/email_icon.png" alt="Email Icon" style="width: 20px; height: 20px;">
                    </span>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <img src="../asset/icon/lock_icon.png" alt="Email Icon" style="width: 20px; height: 20px;">
                </span>
                </span>
                <input type="password" class="form-control" placeholder="Kata Sandi" name="password" required>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <img src="../asset/icon/lock_icon.png" alt="Email Icon" style="width: 20px; height: 20px;">
                </span>
                <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" name="confirm_password" required>
            </div>
            </div>


          <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="button">Masuk</button>
          </div> 
          
        </form>
      </div>
      </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>