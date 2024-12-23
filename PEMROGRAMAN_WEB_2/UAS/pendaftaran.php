<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $durasi_sewa = $_POST['durasi_sewa'];
    $tipe_ps = $_POST['tipe_ps'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $jenis_pembayaran = $_POST['jenis_pembayaran'];
    $alamat = $_POST['alamat'];

    // Upload Foto KTP
    $foto_ktp = $_FILES['foto_ktp']['name'];
    $target = "uploads/" . basename($foto_ktp);
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $target);

    $query = "INSERT INTO tb_pelanggan (nama_pelanggan, no_telepon, jenis_kelamin, foto_ktp, durasi_sewa, tipe_ps, tanggal_sewa, jenis_pembayaran, alamat)
            VALUES ('$nama', '$no_telepon', '$jenis_kelamin', '$foto_ktp', '$durasi_sewa', '$tipe_ps', '$tanggal_sewa', '$jenis_pembayaran', '$alamat')";
    
    if ($conn->query($query) === TRUE) {
        $success = "Pendaftaran berhasil!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h4>Pendaftaran Pelanggan</h4>
        <?php if (!empty($success)) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto_ktp" class="form-label">Foto KTP</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" required>
            </div>
            <div class="mb-3">
                <label for="durasi_sewa" class="form-label">Durasi Sewa (perhari)</label>
                <input type="text" class="form-control" id="durasi_sewa" name="durasi_sewa" required>
            </div>
            <div class="mb-3">
                <label for="tipe_ps" class="form-label">Tipe PS</label>
                <select class="form-select" id="tipe_ps" name="tipe_ps">
                    <option value="PS3">PS3</option>
                    <option value="PS4">PS4</option>
                    <option value="PS5">PS5</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" required>
            </div>
            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran">
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
</body>
</html>
