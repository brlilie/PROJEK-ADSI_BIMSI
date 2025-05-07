<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = 'mahasiswa';
    if (!empty($email) && !empty($password)) {
        $file = '../database/users.csv';
        $newLine = $email . ',' . $password.','.$role . PHP_EOL;

        // Check if file exists and load current data
        $existingEmails = [];
        if (file_exists($file)) {
            $rows = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            // Skip header
            foreach (array_slice($rows, 1) as $row) {
                list($savedEmail) = explode(',', $row);
                $existingEmails[] = trim($savedEmail);
            }

            // Check for duplicates
            if (in_array($email, $existingEmails)) {
                echo "Email sudah terdaftar.";
                exit();
            }
        } else {
            // Create file and add header if it doesn't exist
            file_put_contents($file, "email,password,role\n", LOCK_EX);
        }

        // Append the new unique email
        if (file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX)) {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            header("Location: /bimsi/Mahasiswa/biodata-mahasiswa.php");
            exit();
        } else {
            echo "Gagal menyimpan data. Periksa izin file.";
        }
    } else {
        echo "Email dan password tidak boleh kosong.";
    }
} else {
    echo "Metode tidak diperbolehkan.";
}
?>
