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
session_start();




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_SESSION['email'] ?? '';
    $role = $_SESSION['role'] ?? 'mahasiswa';

    if (!empty($email) && isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../asset/files/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $photoName = uniqid('foto_') . '_' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $photoName);

        // Update CSV
        $csvFile = __DIR__ . '/../database/users.csv';
        $rows = file($csvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $header = array_shift($rows);
        $updatedRows = [];

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (trim($data[0]) === trim($email)) {
                $data[5] = $photoName; // Set photo_profile field
            }
            $updatedRows[] = implode(',', $data);
        }

        file_put_contents($csvFile, $header . PHP_EOL . implode(PHP_EOL, $updatedRows) . PHP_EOL);

        // Redirect to homepage
        header("Location: /bimsi/dashboard.php");
        exit();
    } else {
        echo "Gagal unggah foto. Pastikan file valid dan kamu sudah login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimsi</title>
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

                    <!-- Upload Foto Profil -->
<!-- Upload Foto Profil -->
            <div class="foto-profile-container text-center">
                <h4 class="judul-login mb-4 text-center">Upload Foto Profil</h4>
                <p class="text-muted small mb-4">
                    Pastikan foto yang diunggah adalah wajah asli kamu untuk keperluan verifikasi.
                </p>

                <form method="POST" enctype="multipart/form-data">
                    <!-- Centered profile preview -->
                    <div class="d-flex justify-content-center mb-3">
                        <label for="fotoInput" class="profile-preview-wrapper">
                            <img id="profilePreview" src="../asset/icon/avatar_icon.png" class="profile-preview">
                        </label>
                    </div>

                    <!-- Hidden file input -->
                    <input type="file" accept="image/*" name="foto" id="fotoInput" onchange="previewFoto()" required style="display: none;">

                    <!-- Submit button centered -->
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="button">Kirim</button>
                    </div>
                </form>

            </div>

    </div>


     <script>
        function previewFoto() {
        const input = document.getElementById('fotoInput');
        const preview = document.getElementById('profilePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
        }



     </script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>