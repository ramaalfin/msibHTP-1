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
        <h2 class="text-center">Form Gaji Karyawan</h2>
        <div class="row">
            <div class="col">
                <form method="POST" class="my-5 border p-4" style="background-color: #f5f5f5">
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
                            <input class="form-check-input" type="radio" name="status" id="menikah" value="Menikah" required>
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
                    <button class="btn btn-primary" name="proses" type="submit" style="width: -webkit-fill-available;">Simpan</button>
                </form>
            </div>
            <div class="col">
                <div class="my-5 border p-4">
                    <?php if (isset($tombol)) {
                    ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p>Nama Pegawai : </p>
                                    <input type="text" class="form-control" value="<?= $nama ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Jabatan : </p>
                                    <input type="text" class="form-control" value="<?= $jabatan ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p>Agama : </p>
                                    <input type="text" class="form-control" value="<?= $agama ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Status : </p>
                                    <input type="text" class="form-control" value="<?= $status ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Jumlah Anak : </p>
                                    <input type="text" class="form-control" value="<?= $jml_anak ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p>Gaji Pokok : </p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($gaji_pokok, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p>Tunjangan Jabatan :</p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($tunjangan_jabatan, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Tunjangan Keluarga : </p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($tunjangan_keluarga, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p>Gaji Kotor : </p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($gaji_kotor, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Zakat Profesi : </p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($zakat_profesi, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p>Take Home Pay :</p>
                                    <input type="text" class="form-control" value="Rp. <?= number_format($take_home_pay, 0, ',', '.') ?>" disabled>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>