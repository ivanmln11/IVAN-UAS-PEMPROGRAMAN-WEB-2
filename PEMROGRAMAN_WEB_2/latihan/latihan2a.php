<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2a</title>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="0">
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
            <th>Kolom 3</th>
            <th>Kolom 4</th>
            <th>Kolom 5</th>
        </tr>
        
<?php

$numBaris = 15 ;
$numKolom = 5;

for ($row = 1; $row <= $numBaris; $row++) {
    echo "<tr>"; 


    for ($col = 1; $col <= $numKolom; $col++) {
        echo "<td>Baris $row, Kolom $col</td>";
    }
    echo "</tr>";

}
?>
    </table>
</body>
</html>
