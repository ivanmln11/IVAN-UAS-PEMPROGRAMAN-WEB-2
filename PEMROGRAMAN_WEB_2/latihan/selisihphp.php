<?php function selisih($a, $b) {
    if ($a>=$b) {
        return $a-$b;
    } else {
        return $b-$a;
    }
}

echo selisih(10,7);

//Function dengan return dan parameter
?>