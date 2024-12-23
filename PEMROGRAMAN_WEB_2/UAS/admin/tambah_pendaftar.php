<?php
session_start();
include 'koneksi.php';



// Tambah Data Pelanggan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
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

    // Query INSERT ke dalam database
    $query = "INSERT INTO tb_pelanggan (nama_pelanggan, no_telepon, jenis_kelamin, foto_ktp, durasi_sewa, tipe_ps, tanggal_sewa, jenis_pembayaran, alamat)
            VALUES ('$nama', '$no_telepon', '$jenis_kelamin', '$foto_ktp', '$durasi_sewa', '$tipe_ps', '$tanggal_sewa', '$jenis_pembayaran', '$alamat')";
    
    if ($conn->query($query) === TRUE) {
        $success = "Pendaftaran berhasil!";
        header("Location: tambah_pendaftar.php");
    } else {
        $error = "Error: " . $conn->error;
    }
}











// Pencarian Data
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Hapus Data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tb_pelanggan WHERE id_pelanggan = $id");
    header("Location: ??");
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
        <!-- Tombol untuk membuka Modal Tambah Pelanggan -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">Tambah Pelanggan</button>
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

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Data Pelanggan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" required>
                </div>
                <div class="mb-3">
                    <label for="durasi_sewa" class="form-label">Durasi Sewa</label>
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
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
            </form>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
