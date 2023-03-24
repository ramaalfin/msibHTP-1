<?php
require('rumus.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan pemrosesan form</title>
</head>

<body>
    <form method="POST">
        <p> Form input nilai</p>
        <label> Nama </label>
        <input type="text" name="nama" placeholder="Masukan nama"><br>
        <label> Matakuliah</label>
        <select name="matkul">
            <option>----pilih matakuliah ---</option>
            <option value="html">HTML dan CSS </option>
            <option value="js">Javascript</option>
            <option value="UI">UI/UX</option>
            <option value="PHP">PHP</option>
        </select><br>
        <label> Nilai </label>

        <input type="text" name="nilai" placeholder="masukan nilai anda">
        <button name="proses" type="submit">Simpan</button>
    </form>


</body>

</html>