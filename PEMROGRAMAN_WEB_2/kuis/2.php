<?php
// Inisialisasi variabel
$a = 1;

// Loop menggunakan while
while ($a <= 16) {
    echo $a . " ";
    $a += 5; // Tambah 5 setiap iterasi
}
echo "</br></br>";


// Inisialisasi variabel
$b = 10;

// Loop menggunakan while
while ($b >= 0) {
    echo $b . " ";
    $b--; // Kurangi 1 setiap iterasi
}
echo "</br></br>";


// Inisialisasi variabel
$c = 30;

do {
    echo $c . " ";
    $c -= 3; // Kurangi 3 setiap iterasi
} while ($c >= 0);
echo "</br></br>";

// Inisialisasi variabel
$d = 10;

do {
    echo $d . " ";
    $d -= 2; // Kurangi 2 setiap iterasi
} while ($d >= 0);

?>