<?php
session_start();
include 'koneksi.php';

// Check if the user has the correct role to access this page
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'Pimpinan') {
    header('Location: login.php');
    exit;
}

// Ambil data pelanggan, aktivitas, transaksi, dan tipe PS
$query = "
    SELECT 
        p.id_pelanggan, 
        p.nama_pelanggan, 
        p.no_telepon, 
        p.jenis_kelamin, 
        IFNULL(p.durasi_sewa, 'N/A') AS durasi_sewa, 
        IFNULL(tp.nama_tipe, 'N/A') AS tipe_ps,
        IFNULL(tp.harga_sewa_per_hari, 0) AS harga_sewa_per_hari, 
        IFNULL(t.total_bayar, 0) AS total_bayar, 
        IFNULL(t.status_pembayaran, 'N/A') AS status_pembayaran,
        IFNULL(t.tanggal_transaksi, 'N/A') AS tanggal_transaksi,
        IFNULL(p.alamat, 'N/A') AS alamat
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsPDF@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
</head>
<body class="bg-light">

    <!-- Navbar -->
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

        <!-- Buttons for downloading and printing -->
        <div class="mb-3">
            <button class="btn btn-success" id="downloadPDF">Download PDF</button>
            <button class="btn btn-secondary" onclick="window.print()">Cetak</button>
        </div>

        <!-- Data Table -->
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Durasi Sewa</th>
                    <th>Tipe PS</th>
                    <th>Harga/Hari</th>
                    <th>Total Bayar</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_pelanggan'] ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['no_telepon'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['durasi_sewa'] ?></td>
                        <td><?= $row['tipe_ps'] ?></td>
                        <td>Rp<?= number_format($row['durasi_sewa'], 2, ',', '.') ?></td>
                        <td>Rp<?= number_format($row['total_bayar'], 2, ',', '.') ?></td>
                        <td><?= $row['status_pembayaran'] ?></td>
                        <td><?= $row['tanggal_transaksi'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        // Function to download table data as a PDF
        document.getElementById('downloadPDF').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Use autoTable to format table in PDF
            doc.autoTable({
                html: '#dataTable',
                headStyles: { fillColor: [0, 123, 255] }, // Bootstrap primary color
                margin: { top: 20 },
                didDrawPage: function (data) {
                    doc.text("Laporan Data Pelanggan", data.settings.margin.left, 10);
                }
            });

            doc.save('laporan_pelanggan.pdf'); // Save the PDF
        });
    </script>

</body>
</html>
