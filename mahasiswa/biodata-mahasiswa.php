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
    $nama = $_POST['nama'] ?? '';
    $npm = $_POST['npm'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $role = $_SESSION['role'] ?? 'mahasiswa';

    // Directory for uploads
    $uploadDir = __DIR__ . '/../asset/files/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle transcript upload
    $transkripName = '';
    if (isset($_FILES['transkrip']) && $_FILES['transkrip']['error'] === UPLOAD_ERR_OK) {
        $transkripName = uniqid('transkrip_') . '_' . basename($_FILES['transkrip']['name']);
        move_uploaded_file($_FILES['transkrip']['tmp_name'], $uploadDir . $transkripName);
    }

    if (!empty($email) && !empty($nama) && !empty($npm)) {
        $csvFile = __DIR__ . '/../database/users.csv';

        $rows = file($csvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $header = array_shift($rows); // Save header
        $updatedRows = [];
        $found = false;

        foreach ($rows as $row) {
            $data = str_getcsv($row);

            if (trim($data[0]) === trim($email)) {
                // Update only the matching user
                $data[2] = $role;
                $data[3] = $nama;
                $data[4] = $npm;
                $data[5] = ''; // placeholder for photo
                $data[6] = $transkripName;
                $found = true;
            }

            $updatedRows[] = implode(',', $data);
        }

        // If user not found, add a new line with empty password
        if (!$found) {
            $newLine = [$email, '', $role, $nama, $npm, '', $transkripName];
            $updatedRows[] = implode(',', $newLine);
        }

        // Write header + all rows back to the CSV
        file_put_contents($csvFile, $header . PHP_EOL . implode(PHP_EOL, $updatedRows) . PHP_EOL);

        // Redirect to next step
        header("Location: add_photo-mahasiswa.php");
        exit();
    } else {
        echo "Data tidak lengkap.";
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

          <div class="biodata-card">
            <h4 class="judul-login mb-4 text-center">Biodata</h4>
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" id="nama" name="nama" class="form-control custom-input" placeholder="Nama" required>
              </div>
          
              <div class="mb-3">
                <input type="text" id="npm" name="npm" class="form-control custom-input" placeholder="NPM" required>
              </div>
          
              <div class="mb-3">
                <select class="form-control custom-input"  name="semester" required>
                  <option value="" disabled selected>Semester</option>
                  <option value="6">Semester 6</option>
                  <option value="7">Semester 7</option>
                  <option value="8">Semester 8</option>
                </select>
              </div>
          
              <div class="mb-3">
                <input type="text" name="no_hp" class="form-control custom-input" placeholder="No HP" required>
              </div>
          
              <!-- Upload Box -->
              <div class="mb-3 position-relative">
                <div class="upload-box d-flex align-items-center" onclick="toggleOptions()">
                  <img src="../asset/icon/doc_icon.png" alt="Upload Icon" class="upload-icon">
                  <span class="upload-text">Lampirkan bukti transkrip pembayaran UKT</span>
                </div>
              
                <div class="options-box" id="uploadOptions">
                  <label class="option">
                    📁 Upload dari File
                    <input type="file" name="transkrip" onchange="handleFileUpload(event)">
                  </label>
                  <div class="option" onclick="handleDriveUpload()">
                    ☁️ Upload dari Drive
                  </div>
                </div>
              </div>
          
              <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="button">Kirim</button>
              </div> 
            </form>
          </div>
          
      </div>
  


      <script>

          
        function toggleOptions() {
          const box = document.getElementById("uploadOptions");
          box.style.display = box.style.display === "block" ? "none" : "block";
        }
      
        function handleFileUpload(event) {
          const file = event.target.files[0];
          if (file) {
            alert("File terpilih: " + file.name);
            // lanjut upload ke server kalau mau
          }
        }
      
        function handleDriveUpload() {
          alert("Fitur upload dari Drive belum aktif ya 😅");
          // nanti bisa pakai Google Picker API
        }
      
        // Auto close dropdown kalau klik di luar
        document.addEventListener("click", function(e) {
          const uploadBox = document.querySelector(".upload-box");
          if (!uploadBox.contains(e.target)) {
            document.getElementById("uploadOptions").style.display = "none";
          }
        });
      </script>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
