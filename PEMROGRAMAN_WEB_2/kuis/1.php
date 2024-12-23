<?php
function hitungDiskon($jumlahPembayaran) {
    if ($jumlahPembayaran >= 50000) {
        $diskon = 5;
    } elseif ($jumlahPembayaran >= 100000) {
        $diskon = 10;
    } elseif ($jumlahPembayaran >= 250000) {
        $diskon = 15;
    } else {
        $diskon = 0;
    }

    $jumlahDiskon = $jumlahPembayaran * ($diskon / 100);

    $totalBayar = $jumlahPembayaran - $jumlahDiskon;

    return array(
        'diskon' => $diskon,
        'jumlahDiskon' => $jumlahDiskon,
        'totalBayar' => $totalBayar
    );
}

$jumlahPembayaran = 90000;
$hasil = hitungDiskon($jumlahPembayaran);

echo "Jumlah pembayaran: Rp " . number_format($jumlahPembayaran) . "<br>";
echo "Diskon: " . $hasil['diskon'] . "%<br>";
echo "Jumlah diskon: Rp " . number_format($hasil['jumlahDiskon']) . "<br>";
echo "Total pembayaran setelah diskon: Rp " . number_format($hasil['totalBayar']);

echo "</br></br>";

function hitungDiskon($jumlahPembayaran) {
    if ($jumlahPembayaran >= 50000) {
        $diskon = 5;
    } elseif ($jumlahPembayaran >= 100000) {
        $diskon = 10;
    } elseif ($jumlahPembayaran >= 250000) {
        $diskon = 15;
    } else {
        $diskon = 0;
    }

    $jumlahDiskon = $jumlahPembayaran * ($diskon / 100);

    $totalBayar = $jumlahPembayaran - $jumlahDiskon;

    return array(
        'diskon' => $diskon,
        'jumlahDiskon' => $jumlahDiskon,
        'totalBayar' => $totalBayar
    );
}

$jumlahPembayaran = 55000;
$hasil = hitungDiskon($jumlahPembayaran);

echo "Jumlah pembayaran: Rp " . number_format($jumlahPembayaran) . "<br>";
echo "Diskon: " . $hasil['diskon'] . "%<br>";
echo "Jumlah diskon: Rp " . number_format($hasil['jumlahDiskon']) . "<br>";
echo "Total pembayaran setelah diskon: Rp " . number_format($hasil['totalBayar']);

?>