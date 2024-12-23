<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifikasi apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } else {
        // Hash password menggunakan password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data pengguna ke database
        $query = "INSERT INTO tb_user (username, password, level) VALUES ('$username', '$hashed_password', 'Admin')";
        
        if ($conn->query($query)) {
            $success = "Pendaftaran berhasil! Anda dapat login sekarang.";
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 25rem;">
            <h4 class="mb-3 text-center">Pendaftaran Pengguna</h4>
            
            <!-- Tampilkan pesan error jika ada -->
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>
            
            <!-- Tampilkan pesan sukses jika ada -->
            <?php if (!empty($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>
