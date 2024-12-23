<?php
session_start();
include 'koneksi.php';

//halaman ini untuk menambahkan data username dan pw utk pimpinan

// Proses pendaftaran pimpinan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan data pimpinan baru ke database
        $query = "INSERT INTO tb_user (username, password, level) VALUES ('$username', '$hashed_password', 'Pimpinan')";
        
        if ($conn->query($query)) {
            $success = "Pimpinan baru berhasil ditambahkan!";
        } else {
            $error = "Terjadi kesalahan saat menambahkan pimpinan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Tambah Pimpinan Baru</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h4>Tambah Pimpinan Baru</h4>

        <!-- Pesan error jika ada -->
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>
        
        <!-- Pesan sukses jika ada -->
        <?php if (!empty($success)) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>
        
        <!-- Form untuk menambah pimpinan -->
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
            <button type="submit" class="btn btn-primary">Tambah Pimpinan</button>
        </form>
    </div>

</body>
</html>
