<?php
$ar_prodi = ["SI" => "Sistem Informasi", "TI" => "Teknik Informatika", "ILKOM" => "Ilmu Komputer", "TE" => "Teknik Elektro"];

$ar_skill = ["HTML" => 10, "CSS" => 10, "Javascript" => 20, "RWD Bootstrap" => 20, "PHP" => 30, "MySQL" => 30, "Laravel" => 40];
$domisili = ["Jakarta", "Bandung", "Bekasi", "Malang", "Surabaya", "lainnya"];
?>
<fieldset style="background-color:aquamarine;">
    <legend>Form Registrasi Kelompok Belajar</legend>
    <table>
        <thead>
            <tr>
                <th>Form Registrasi</th>
            </tr>
        </thead>
        <tbody>
            <form method="POST">
                <tr>
                    <td>NIM : </td>
                    <td>
                        <input type="text" name="nim">
                    </td>
                </tr>
                <tr>
                    <td>Nama : </td>
                    <td>
                        <input type="text" name="nama">
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin : </td>
                    <td>
                        <input type="radio" name="jk" value="L">Laki-Laki &nbsp;
                        <input type="radio" name="jk" value="P">Perempuan
                    </td>
                </tr>
                <tr>
                    <td>Program Studi: </td>
                    <td>
                        <select name="prodi">
                            <?php

                            foreach ($ar_prodi as $prodi => $v) {
                            ?>
                                <option value="<?= $prodi ?>"><?= $v ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Skill Programming : </td>
                    <td>
                        <?php
                        foreach ($ar_skill as $skill => $val) {
                        ?>
                            <input type="checkbox" name="skill[]" value="<?= $skill ?>"><?= $skill ?>

                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email">
                    </td>
                </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">
                    <button name="proses">Submit</button>
                </th>
            </tr>
        </tfoot>
    </table>


</fieldset>
<?php
if (isset($_POST['proses'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $prodi = $_POST['prodi'];
    $skill = $_POST['skill'];
    $email = $_POST['email'];

    $skor = 0;
    foreach ($skill as $val) {
        if (isset($ar_skill[$val])) {
            $skor += $ar_skill[$val];
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

?>
    <table border="1" style="border-collapse: collapse; font-weight: bold;">
        <tbody>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?= $nim ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $nama ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $jk ?></td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td><?= $prodi ?></td>
            </tr>
            <tr>
                <td>Skill</td>
                <td>:</td>
                <td><?= implode(', ', $skill) ?></td>
            </tr>
            <tr>
                <td>Skor Skill</td>
                <td>:</td>
                <td><?= $skor ?></td>
            </tr>
            <tr>
                <?php
                $skill_kategori = kategori_skill($ar_skill, $_POST['skill']);
                ?>
                <td>Kategori Skill</td>
                <td>:</td>
                <td><?= $skill_kategori ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $email ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>