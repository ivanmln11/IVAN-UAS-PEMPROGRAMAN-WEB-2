<?php
// Define the array with color elements
$colors = array("hijau", "kuning", "kelabu", "merah muda");

// Display each color in the array
echo "Balonku ada lima.<br>";
echo "Rupa-rupa warnanya: ";

foreach ($colors as $color) {
    echo $color . ", ";
}
echo "dan biru.<br>";
echo "Meletus balon " . $colors[0] . " DOR!!!<br>";
echo "Hatiku sangat kacau.";
?>
