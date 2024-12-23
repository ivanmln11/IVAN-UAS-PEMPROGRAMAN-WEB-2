<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihan 1c</title>
    <style>
        .box {
            width: 30px;
            height: 30px;
            display: inline-block;
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
            line-height: 30px;
            margin: 2px;
        }
        .container {
            margin-left: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            // Huruf pertama dimulai dari 'A' yang memiliki kode ASCII 65
            for ($i = 1; $i <= 3; $i++) {
                for ($j = 1; $j <= $i; $j++) {
                    // Menghitung nilai huruf yang sesuai
                    $huruf = chr(64 + $j); // 64 + 1 = 65 ('A'), 64 + 2 = 66 ('B'), dst.
                    echo "<div class='box'>$huruf</div>";
                }
                // Memulai baris baru
                echo "<br>";
            }
        ?>
    </div>
</body>
</html>