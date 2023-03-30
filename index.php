<?php
require('function.php');
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        table {
            border-collapse: collapse;
            border: 2px solid black;
        }
        td,
        th {
            border: none;
        }

        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <h1 class="text-lg mb-5 font-bold text-center">Form Registrasi</h1>
            <form method="POST">
                <div class="mb-5">
                    <label for="nim" class="mb-3 block text-base font-medium text-[#07074D]">
                        NIM
                    </label>
                    <input type="number" name="nim" id="nim" placeholder="NIM" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mb-5">
                    <label for="nama" class="mb-3 block text-base font-medium text-[#07074D]">
                        Nama
                    </label>
                    <input type="text" name="nama" id="nama" placeholder="nama" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                        Email
                    </label>
                    <input type="text" name="email" id="email" placeholder="Email" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mb-5">
                    <label for="jk" class="mb-3 block text-base font-medium text-[#07074D]">
                        Jenis Kelamin
                    </label>
                    <div class="flex items-center gap-x-5">
                        <div class="flex items-center gap-x-1">
                            <input id="laki-laki" name="jk" value="L" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="laki-laki" class="block text-sm font-medium leading-6 text-gray-900">Laki-laki</label>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <input id="push-email" name="jk" value="P" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="push-email" class="block text-sm font-medium leading-6 text-gray-900">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="program_studi" class="mb-3 block text-base font-medium text-[#07074D]">
                        Program Studi
                    </label>
                    <select id="program_studi" name="prodi" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <?php

                        foreach ($ar_prodi as $prodi => $v) {
                        ?>
                            <option value="<?= $prodi ?>"><?= $v ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="skill_programming" class="mb-3 block text-base font-medium text-[#07074D]">
                        Skill Programming
                    </label>
                    <div class="relative flex gap-x-2">
                        <?php
                        foreach ($ar_skill as $skill => $val) {
                        ?>
                            <div class="flex h-6 items-center">
                                <input name="skill[]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" value="<?= $skill ?>">
                            </div>
                            <div class="text-sm">
                                <label class="font-medium text-gray-900"><?= $skill ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <button class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none" name="proses">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['proses'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
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

        function kategori_skill($skor)
        {
            if ($skor >= 100 && $skor <= 160) {
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
        <div class="flex items-center justify-center p-5">
            <div class="mx-auto w-full max-w-[600px]">
                <table class="font-bold">
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
                            <td>Email</td>
                            <td>:</td>
                            <td><?= $email ?></td>
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
                            $skill_kategori = kategori_skill($skor);
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
            </div>
        </div>
    <?php } ?>
</body>

</html>