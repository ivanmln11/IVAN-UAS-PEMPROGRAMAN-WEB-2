<?php
// Konfigurasi Database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'bismillah_rentalps';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Pencarian Data
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Hapus Data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tb_pelanggan WHERE id_pelanggan = $id");
    header("Location: pelanggan.php");
}

// Ambil Data Pelanggan
$query = "SELECT * FROM tb_pelanggan WHERE nama_pelanggan LIKE '%$search%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4>Data Pelanggan</h4>
    <!-- Pencarian -->
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari pelanggan..." value="<?= $search ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <a href="tambah_pelanggan.php" class="btn btn-success">Tambah Pelanggan</a> <!-- Link ke halaman tambah pelanggan -->
    </div>
    <!-- Tabel Data Pelanggan -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Foto KTP</th>
                <th>Durasi Sewa</th>
                <th>Tipe PS</th>
                <th>Tanggal Sewa</th>
                <th>Jenis Pembayaran</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['no_telepon'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><img src="uploads/<?= $row['foto_ktp'] ?>" width="50" alt="KTP"></td>
                    <td><?= $row['durasi_sewa'] ?> hari</td>
                    <td><?= $row['tipe_ps'] ?></td>
                    <td><?= $row['tanggal_sewa'] ?></td>
                    <td><?= $row['jenis_pembayaran'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td>
                        <a href="edit_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?action=delete&id=<?= $row['id_pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
