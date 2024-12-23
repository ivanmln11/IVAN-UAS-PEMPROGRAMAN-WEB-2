<?php

$GLOBALS['vsrGlobsl'] = 18; //variabel global

function testVar()
{
    $varLokal = 1; variabel lokal 
    echo "<p> test variabel didalam function.<p>" ;
    //mengakses variabel Global didalam function 
    echo "Variabel global : " .$GLOBALS['varGlobal'] 
    echo "<br>" ;
    echo "Variabel lokal : $varLokal " ;
    echo "<br>" ;
}

testVar() ;

    echo "<p> test variabel didalam function. <p>" ;
    echo "Variabel global : $varGlobal" ;
    echo "<br>" ;
    //mengakses variabel lokal didalam function
    echo "variabel lokal : $varLokal " ;
    echo "<br>" ;


?>