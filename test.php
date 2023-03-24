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
            <p>Agama : <?= $agama ?></p>
        </div>
        <div class="mb-3">
            <p>Status : <?= $status ?></p>
        </div>
        <div class="mb-3">
            <p>Jumlah Anak : <?= $jml_anak ?></p>
        </div>
        <div class="mb-3">
            <p>Gaji Pokok : Rp. <?= number_format($gaji_pokok, 0, ',', '.') ?></p>
        </div>
        <div class="mb-3">
            <p>Tunjangan Jabatan : Rp. <?= number_format($tunjangan_jabatan, 0, ',', '.') ?> (<small>20% dari gaji pokok</small>)</p>

        </div>
        <div class="mb-3">
            <p>Tunjangan Keluarga : Rp. <?= number_format($tunjangan_keluarga, 0, ',', '.') ?></p>
        </div>
        <div class="mb-3">
            <p>Gaji Kotor : Rp. <?= number_format($gaji_kotor, 0, ',', '.') ?></p>
        </div>
        <div class="mb-3">
            <p>Zakat Profesi : Rp. <?= number_format($zakat_profesi, 0, ',', '.') ?></p>
        </div>
        <div class="mb-3">
            <p>Take Home Pay : Rp. <?= number_format($take_home_pay, 0, ',', '.') ?></p>
        </div>

    <?php
    }
    ?>
</div>