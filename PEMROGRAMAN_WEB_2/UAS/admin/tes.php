<?php
session_start();
include 'koneksi.php';



// Ambil data pelanggan, aktivitas, transaksi, dan tipe PS
$query = "
    SELECT 
        p.id_pelanggan, 
        p.nama_pelanggan, 
        p.no_telepon, 
        p.jenis_kelamin, 
        p.durasi_sewa AS durasi_sewa_pelanggan, 
        a.durasi_sewa AS durasi_sewa_aktivitas,
        tp.nama_tipe AS tipe_ps,
        tp.harga_sewa_per_hari, 
        a.status_pembayaran AS status_pembayaran_aktivitas,
        t.total_bayar, 
        t.status_pembayaran AS status_pembayaran_transaksi,
        t.tanggal_transaksi
    FROM tb_pelanggan p
    LEFT JOIN tb_aktivitas a ON p.id_pelanggan = a.id_pelanggan
    LEFT JOIN tb_transaksi t ON p.id_pelanggan = t.id_pelanggan
    LEFT JOIN tb_tipe_ps tp ON a.id_ps = tp.id_tipe
    ORDER BY p.id_pelanggan ASC;
";

$result = $conn->query($query);

if (!$result) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Dashboard Pimpinan</a>
            <div class="ml-auto">
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4>Laporan Data Pelanggan</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Durasi Sewa Pelanggan</th>
                    <th>Durasi Sewa Aktivitas</th>
                    <th>Tipe PS</th>
                    <th>Harga/Hari</th>
                    <th>Status Pembayaran Aktivitas</th>
                    <th>Total Bayar</th>
                    <th>Status Pembayaran Transaksi</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_pelanggan'] ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['no_telepon'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['durasi_sewa_pelanggan'] ?> hari</td>
                        <td><?= $row['durasi_sewa_aktivitas'] ?> hari</td>
                        <td><?= $row['tipe_ps'] ?></td>
                        <td>Rp<?= number_format($row['harga_sewa_per_hari'], 2, ',', '.') ?></td>
                        <td><?= $row['status_pembayaran_aktivitas'] ?></td>
                        <td>Rp<?= number_format($row['total_bayar'], 2, ',', '.') ?></td>
                        <td><?= $row['status_pembayaran_transaksi'] ?></td>
                        <td><?= $row['tanggal_transaksi'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
