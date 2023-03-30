<?php 
require 'Pegawai.php';

$pegawai1 = new Pegawai('01111','Andi','Manager','Islam','Menikah');
$pegawai2 = new Pegawai('01112','Budi','Asisten Manager','Islam','Menikah');
$pegawai3 = new Pegawai('01113','Citra','Kepala Bagian','Kristen','Menikah');
$pegawai4 = new Pegawai('01114','Steven','Staff','Budha','Belum Menikah');
$pegawai5 = new Pegawai('01115','Nyoman','Intern','Hindu','Belum Menikah');


$ar_pegawai = [$pegawai1, $pegawai2, $pegawai3, $pegawai4, $pegawai5];

foreach($ar_pegawai as $pegawai){
    $pegawai->cetak();
}
