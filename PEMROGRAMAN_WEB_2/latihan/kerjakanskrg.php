<?php
// Fungsi untuk menghitung luas persegi panjang
function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

// Contoh input: panjang dan lebar persegi panjang
$panjang = 10; // Contoh nilai panjang
$lebar = 5;    // Contoh nilai lebar

// Hitung luas menggunakan fungsi
$luas = hitungLuasPersegiPanjang($panjang, $lebar);

// Tampilkan hasil penyelesaian
echo "Penyelesaian masalah menghitung luas persegi panjang: <br>";
echo "Panjang = " . $panjang . " satuan<br>";
echo "Lebar = " . $lebar . " satuan<br>";
echo "Rumus luas persegi panjang: Panjang x Lebar<br>";
echo "Luas = " . $panjang . " x " . $lebar . " = " . $luas . " satuan persegi<br>";
?>