<?php
function pangkat($angka, $pangkat) {
    return pow($angka, $pangkat); // Menggunakan fungsi bawaan pow() untuk menghitung pangkat
}

$angka = 5;
$pangkat = 4;
$hasil = pangkat($angka, $pangkat);

// Tampilkan hasil
echo "$angka pangkat $pangkat = $hasil";
?>
