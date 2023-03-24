<?php
require('rumus1.php')
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pegawai</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" class="form-select" required>
                    <option selected>--- Pilih jabatan ---</option>
                    <option value="manajer">manajer</option>
                    <option value="asisten">asisten</option>
                    <option value="kabag">kabag</option>
                    <option value="staff">staff</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">Agama :</label>
                <select name="agama" class="form-select" required>
                    <option selected>--- Pilih jabatan ---</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="menikah" value="Menikah"  required>
                    <label class="form-check-label" for="menikah">
                        menikah
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="belum_menikah" value="belum_menikah" required>
                    <label class="form-check-label" for="belum_menikah">
                        belum menikah
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="anak" class="form-label">Jumlah Anak :</label>
                <input class="form-control" type="number" name="jml_anak" id="jml_anak" min="0" max="5" required>
            </div>
            <button class="btn btn-primary" name="proses" type="submit">Simpan</button>
        </form>

        <div class="mt-5">
            <?php if (isset($tombol)) {
            ?>
                <div class="mb-3">
                    <p>Nama Pegawai : <?= $nama ?></p>
                </div>
                <div class="mb-3">
                    <p>Jabatan : <?= $jabatan ?></p>
                </div>
                <div class="mb-3">
                    <p>Status : <?= $status ?></p>
                </div>
                <div class="mb-3">
                    <p>Jumlah Anak : <?= $jml_anak ?></p>
                </div>
                <div class="mb-3">
                    <p>Gaji Pokok : <?= $gaji_pokok ?></p>
                </div>
                <div class="mb-3">
                    <p>Tunjangan Jabatan : <?= $tunjangan_jabatan ?></p>
                    <small>20% dari gaji pokok</small>
                </div>
                <div class="mb-3">
                    <p>Tunjangan Keluarga : <?= $tunjangan_keluarga ?></p>
                </div>
                <div class="mb-3">
                    <p>Gaji Kotor : <?= $gaji_kotor ?></p>
                </div>
                <div class="mb-3">
                    <p>Zakat Profesi : <?= $zakat_profesi ?></p>
                </div>
                <div class="mb-3">
                    <p>Take Home Pay : <?= $take_home_pay ?></p>
                </div>

            <?php
            }
            ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>