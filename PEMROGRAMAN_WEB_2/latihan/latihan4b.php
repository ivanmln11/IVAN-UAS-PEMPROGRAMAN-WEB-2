<?php
// Define the initial array with 5 ASEAN countries
$asean_countries = array("Indonesia", "Singapura", "Malaysia", "Brunei", "Thailand");

// Display the initial list of ASEAN countries
echo "<h3>Daftar Negara ASEAN awal :</h3>";
echo "<ul>";
foreach ($asean_countries as $country) {
    echo "<li>$country</li>";
}
echo "</ul>";

// Add 3 more countries to the array
array_push($asean_countries, "Laos", "Filipina", "Myanmar");

// Display the updated list of ASEAN countries
echo "<h3>Daftar Negara ASEAN baru :</h3>";
echo "<ul>";
foreach ($asean_countries as $country) {
    echo "<li>$country</li>";
}
echo "</ul>";
?>
