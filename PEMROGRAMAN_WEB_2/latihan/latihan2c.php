<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2c</title>
    <style>
        .ganjil {
            background-color: #003;
            color: #fff;
        }
        .genap {
            background-color: #999;
        }
        table {
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <table>
                                        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $i; $j++) {
                // Kondisi ganjil atau genap
                $class = ($i % 2 == 0) ? 'genap' : 'ganjil';
                echo "<td class='$class'>$j</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
