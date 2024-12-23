<?php
//Function dengan parameter yang memiliki nilai default

function nominal($nominal = 10000) {
    echo "Nominal = $nominal" ;
};

nominal(12500);
echo "</br>" ;
nominal();

?>