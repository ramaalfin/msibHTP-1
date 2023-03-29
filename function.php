sederhanakan kode php berikut ini dan tentukan cara menampilkannya di html. 
<?php
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $prodi = $_POST['prodi'];
    $skill = $_POST['skill'];
    $email = $_POST['email'];

    $skor = 0;
    foreach ($skill as $val) {
        if (isset($ar_skill[$val])) {
            $skor += $ar_skill[$val] ?? 0;
        }
    }

    function kategori_skill($ar_skill, $skill)
    {
        $skor = 0;
        foreach ($skill as $val) {
            if (isset($ar_skill[$val])) {
                $skor += ($ar_skill[$val] ?? 0);
            }
        }
        if ($skor >= 100 && $skor <= 150) {
            return "Sangat Baik";
        } elseif ($skor >= 60 && $skor < 100) {
            return "Baik";
        } elseif ($skor >= 40 && $skor < 60) {
            return "Cukup";
        } elseif ($skor >= 0 && $skor < 40) {
            return "Kurang";
        } else {
            return "Tidak Memadai";
        }
    }