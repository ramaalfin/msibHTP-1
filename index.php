<?php
require('rumus.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 3 PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="table-responsive">
    <table border="1px" class="table table-bordered table-striped table-sm w-50">
        <thead>

            <tr>
                <?php
                foreach ($ar_judul as $judul) {
                ?>
                    <th><?= $judul ?></th>
                <?php } ?>
            </tr>

        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($mahasiswa as $mhs) {
                $ket = ($mhs['nilai'] >= 60) ? 'Lulus' : 'Tidak lulus';
                //grade 
                if ($mhs['nilai'] >= 80 && $mhs['nilai'] <= 100) $grade = 'A';
                else if ($mhs['nilai'] >= 75 && $mhs['nilai'] < 80) $grade = 'B';
                else if ($mhs['nilai'] >= 60 && $mhs['nilai'] < 74) $grade = 'C';
                else if ($mhs['nilai'] >= 30 && $mhs['nilai'] < 59) $grade = 'D';
                else if ($mhs['nilai'] >= 0 && $mhs['nilai'] < 29) $grade = 'E';
                else $grade = '';

                // Mencari Grade dan Predikat
                switch ($grade) {
                    case "A":
                        $predikat = "Sangat Baik";
                        break;
                    case "B":
                        $predikat = "Baik";
                        break;
                    case "C":
                        $predikat = "Cukup";
                        break;
                    case "D":
                        $predikat = "Kurang";
                        break;
                    case "E":
                        $predikat = "Sangat Kurang";
                        break;
                    default:
                        $predikat = "";
                        break;
                }
            ?>
                <tr>
                    <td><?= $no ?> </td>
                    <td><?= $mhs['NIM'] ?></td>
                    <td><?= $mhs['nama'] ?></td>
                    <td><?= $mhs['nilai'] ?></td>
                    <td><?= $ket ?></td>
                    <td><?= $grade ?></td>
                    <td><?= $predikat ?></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
        <tfoot>
            <?php
            foreach ($keterangan as $ket => $val) { ?>
                <tr>
                    <th colspan="6" style="text-align: left"><?= $ket ?></th>
                    <td><?= $val ?></td>
                </tr>
            <?php
            }
            ?>
        </tfoot>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>