<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumus Jajar Genjang</title>
</head>
<body>
    <h1>Rumus Jajar Genjang</h1>

    <form method="POST">
        <table>
        <tr>
            <td>Alas</td>
            <td>
                <input type="text" name="alas" require>
                <span>cm</span>
            </td>
        </tr>
        <tr>
            <td>Tinggi</td>
            <td>
                <input type="text" name="tinggi" require>
                <span>cm</span>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Hitung">
        </td>
        </tr>
</table>
</form>
<?php 
    if(isset($_POST['submit'])){
        $alas = $_POST['alas'];
        $tinggi = $_POST['tinggi'];

        $luas_jajar_genjang = $alas * $tinggi;
        $keliling_jajar_genjang = 2 * ($alas + $tinggi);
        echo '<br> Hasil perhitungan Luas Jajar Genjang';
        echo '<br> Diketahui :';
        echo '<br> Alas : '.$alas . ' cm';
        echo '<br> Tinggi : '.$tinggi . ' cm';
        echo '<br> Rumus : Alas x Tinggi :' . $alas . ' cm x ' . $tinggi . ' cm';
        echo '<br> Maka Luasnya adalah: ' .$luas_jajar_genjang . ' cm2';
        echo '<hr>';
        echo 'Hasil perhitungan Keliling Jajar Genjang';
        echo '<br> Diketahui :';
        echo '<br> Alas : '.$alas . ' cm';
        echo '<br> Tinggi : '.$tinggi . ' cm';
        echo '<br> Rumus : 2 x (Alas + Tinggi) :' . ' 2 x (' . $alas . ' cm + ' . $tinggi . ' cm)';
        echo '<br> Maka Kelilingnya adalah: ' .$keliling_jajar_genjang . ' cm';
    }
?>
</body>
</html>