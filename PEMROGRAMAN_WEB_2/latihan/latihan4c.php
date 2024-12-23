<?php
// Define an associative array with ASEAN countries and their capitals
$asean_countries = array(
    "Indonesia" => "D.K.I. Jakarta",
    "Singapura" => "Singapura",
    "Malaysia" => "Kuala Lumpur",
    "Brunei" => "Bandar Seri Begawan",
    "Thailand" => "Bangkok",
    "Laos" => "Vientiane",
    "Filipina" => "Manila",
    "Myanmar" => "Naypyidaw"
);

// Display the list of ASEAN countries and their capitals
echo "<h3>Daftar Negara ASEAN dan Ibukota :</h3>";
echo "<ul>";
foreach ($asean_countries as $country => $capital) {
    echo "<li>$country : $capital</li>";
}
echo "</ul>";
?>
