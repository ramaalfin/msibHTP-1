<?php
    $m1 = ['NIM' => '01111021', 'nama' => 'Andi', 'nilai' => 80];
    $m2 = ['NIM' => '01111022', 'nama' => 'Ani', 'nilai' => 70];
    $m3 = ['NIM' => '01111023', 'nama' => 'Ari', 'nilai' => 50];
    $m4 = ['NIM' => '01111024', 'nama' => 'Aji', 'nilai' => 40];
    $m5 = ['NIM' => '01111025', 'nama' => 'Ali', 'nilai' => 90];
    $m6 = ['NIM' => '01111026', 'nama' => 'Ai', 'nilai' => 75];
    $m7 = ['NIM' => '01111027', 'nama' => 'Budi', 'nilai' => 30];
    $m8 = ['NIM' => '01111028', 'nama' => 'Bani', 'nilai' => 85];
    $mahasiswa = [$m1, $m1, $m3, $m4, $m5, $m6, $m7, $m8];
    $ar_judul = ['No', 'NIM', 'Nama', 'Nilai', 'Keterangan', 'Grade', 'Predikat'];

    $jml_mhs = count($mahasiswa);
    $total_nilai = array_sum(array_column($mahasiswa, 'nilai'));
    $max_nilai = max(array_column($mahasiswa, 'nilai'));
    $min_nilai = min(array_column($mahasiswa, 'nilai'));
    $avg_nilai = $total_nilai/$jml_mhs;
    $keterangan = [
        'Jumlah Mahasiswa' => $jml_mhs, 
        'Nilai Tertinggi' => $max_nilai, 
        'Nilai Terendah' => $min_nilai, 
        'Nilai Rata-rata' => $avg_nilai
    ];