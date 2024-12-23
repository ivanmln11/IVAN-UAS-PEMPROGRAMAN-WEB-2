<?php
function faktorial($a) {
    $result = 1;
    for ($i = 1; $i <= $a; $i++) {
        $result *= $i;
    }
    return $result;
}

$number = 5;
echo "Faktorial dari " . $number . " = " . faktorial($number);
?>