<?php
session_start();
include 'koneksi.php';

// Check if the admin is logged in, if not redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php?role=admin');
    exit;
}

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Handle Add or Edit Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
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
    if (!empty($foto_ktp)) {
        move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $target);
    }

    if ($id) {
        // Update existing data
        $query = "UPDATE tb_pelanggan SET 
            nama_pelanggan = '$nama', 
            no_telepon = '$no_telepon', 
            jenis_kelamin = '$jenis_kelamin', 
            foto_ktp = IF('$foto_ktp' != '', '$foto_ktp', foto_ktp), 
            durasi_sewa = '$durasi_sewa', 
            tipe_ps = '$tipe_ps', 
            tanggal_sewa = '$tanggal_sewa', 
            jenis_pembayaran = '$jenis_pembayaran', 
            alamat = '$alamat'
            WHERE id_pelanggan = $id";
    } else {
        // Add new data
        $query = "INSERT INTO tb_pelanggan (nama_pelanggan, no_telepon, jenis_kelamin, foto_ktp, durasi_sewa, tipe_ps, tanggal_sewa, jenis_pembayaran, alamat)
            VALUES ('$nama', '$no_telepon', '$jenis_kelamin', '$foto_ktp', '$durasi_sewa', '$tipe_ps', '$tanggal_sewa', '$jenis_pembayaran', '$alamat')";
    }

    if ($conn->query($query) === TRUE) {
        header("Location: admin_dashboard.php"); // Redirect to avoid resubmission
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $conn->error;
    }
}

// Pencarian Data
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Hapus Data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tb_pelanggan WHERE id_pelanggan = $id");
    header("Location: admin_dashboard.php"); // Redirect after delete
    exit;
}

// Ambil Data Pelanggan
$query = "SELECT * FROM tb_pelanggan WHERE nama_pelanggan LIKE '%$search%' ORDER BY id_pelanggan ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Admin Rental PS Dashboard</a>
            <div class="ml-auto">
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4>Data Pelanggan</h4>

        <!-- Pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari pelanggan..." value="<?= $search ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEditModal">Tambah Pelanggan</button>
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
                            <button class="btn btn-warning btn-sm edit-button" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addEditModal"
                                data-id="<?= $row['id_pelanggan'] ?>"
                                data-nama="<?= $row['nama_pelanggan'] ?>"
                                data-telepon="<?= $row['no_telepon'] ?>"
                                data-jenis_kelamin="<?= $row['jenis_kelamin'] ?>"
                                data-durasi_sewa="<?= $row['durasi_sewa'] ?>"
                                data-tipe_ps="<?= $row['tipe_ps'] ?>"
                                data-tanggal_sewa="<?= $row['tanggal_sewa'] ?>"
                                data-jenis_pembayaran="<?= $row['jenis_pembayaran'] ?>"
                                data-alamat="<?= $row['alamat'] ?>">Edit</button>
                            <a href="?action=delete&id=<?= $row['id_pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Add/Edit -->
    <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditModalLabel">Tambah/Edit Data Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
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
                            <label for="durasi_sewa" class="form-label">Durasi Sewa</label>
                            <input type="text" class="form-control" id="durasi_sewa" name="durasi_sewa" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_ps" class="form-label">Tipe PS</label>
                                <select class="form-select" id="tipe_ps" name="tipe_ps" required>
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
                            <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto_ktp" class="form-label">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktp" name="foto_ktp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Populate modal for editing
            $('.edit-button').click(function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var telepon = $(this).data('telepon');
                var jenis_kelamin = $(this).data('jenis_kelamin');
                var durasi_sewa = $(this).data('durasi_sewa');
                var tipe_ps = $(this).data('tipe_ps');
                var tanggal_sewa = $(this).data('tanggal_sewa');
                var jenis_pembayaran = $(this).data('jenis_pembayaran');
                var alamat = $(this).data('alamat');

                // Set values in the modal
                $('#id').val(id);
                $('#nama_pelanggan').val(nama);
                $('#no_telepon').val(telepon);
                $('#jenis_kelamin').val(jenis_kelamin);
                $('#durasi_sewa').val(durasi_sewa);
                $('#tipe_ps').val(tipe_ps);
                $('#tanggal_sewa').val(tanggal_sewa);
                $('#jenis_pembayaran').val(jenis_pembayaran);
                $('#alamat').val(alamat);
            });
        });
    </script>

</body>
</html>