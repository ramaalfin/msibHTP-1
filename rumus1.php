<?php
if (isset($_POST['proses'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $agama = $_POST['agama'];
    $jml_anak = $_POST['jml_anak'];
    $gaji_pokok = 0;
    $tunjangan_jabatan = 0;
    $tunjangan_keluarga = 0;
    $gaji_kotor = 0;
    $zakat_profesi = 0;
    $take_home_pay = 0;

    // Hitung gaji pokok
    switch ($jabatan) {
        case 'manajer':
            $gaji_pokok = 10000000;
            break;
        case 'asisten':
            $gaji_pokok = 7000000;
            break;
        case 'kabag':
            $gaji_pokok = 5000000;
            break;
        case 'staff':
            $gaji_pokok = 3000000;
            break;
    }

    // Hitung tunjangan jabatan
    $tunjangan_jabatan = 0.2 * $gaji_pokok;

    // Hitung tunjangan keluarga
    if ($status == 'Menikah') {
        $tunjangan_keluarga = 0.1 * $gaji_pokok;
        if ($jml_anak > 2) {
            $tunjangan_keluarga += (0.05 * $gaji_pokok);
        } else if ($jml_anak == 3 && $jml_anak >= 5) {
            $tunjangan_keluarga += (0.1 * $gaji_pokok);
        } else {
            $tunjangan_keluarga = 0;
        }
    }

    // Hitung gaji kotor
    $gaji_kotor = $gaji_pokok + $tunjangan_jabatan + $tunjangan_keluarga;

    // Hitung zakat profesi
    $zakat_profesi = ($gaji_kotor >= 6000000 && $agama == "Muslim") ? 0.025 * $gaji_kotor : 0;

    // Hitung take home pay
    $take_home_pay = $gaji_kotor - $zakat_profesi;

    // Tampilkan hasil perhitungan
    $tombol = true;
}
?>
