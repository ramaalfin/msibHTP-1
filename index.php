<?php

require_once('Lingkaran.php');
require_once('PersegiPanjang.php');
require_once('Segitiga.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <title>Bentuk 2D</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Bentuk 2D</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Bidang</th>
                    <th scope="col">Luas</th>
                    <th scope="col">Keliling</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lingkaran = new Lingkaran(7);
                $persegi_panjang = new PersegiPanjang(8, 6);
                $segitiga = new Segitiga(10, 6);

                $bidangs = array($lingkaran, $persegi_panjang, $segitiga);

                foreach ($bidangs as $bidang) {
                    echo "<tr>";
                    echo "<td>" . $bidang->namaBidang() . "</td>";
                    echo "<td>" . $bidang->fungsiLuasBidang() . "</td>";
                    echo "<td>" . $bidang->fungsiKelilingBidang() . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>