-- SOAL 3.1

-- 1.	Tampilkan produk yang asset nya diatas 20jt
SELECT * FROM produk WHERE harga_beli * stok > 20000000;

-- 2.	Tampilkan data produk beserta selisih stok dengan minimal stok
SELECT SUM(stok - min_stok) as selisih from produk;

-- 3.	Tampilkan total asset produk secara keseluruhan
SELECT sum(stok) as total_asset from produk;

-- 4.	Tampilkan data pelanggan yang lahirnya antara tahun 1999 sampai 2004
SELECT * FROM pelanggan WHERE YEAR(tgl_lahir) BETWEEN 1999 AND 2004;

-- 5.	Tampilkan data pelanggan yang lahirnya tahun 1998
SELECT * FROM pelanggan WHERE YEAR(tgl_lahir) = 1998;

-- 6.	Tampilkan data pelanggan yang berulang tahun bulan agustus
SELECT * FROM pelanggan WHERE MONTH(tgl_lahir) = 08;

-- 7.	Tampilkan data pelanggan : nama, tmp_lahir, tgl_lahir dan umur (selisih tahun sekarang dikurang tahun kelahiran)
SELECT nama_pelanggan, tmp_lahir, tgl_lahir, (YEAR(NOW())-YEAR(tgl_lahir)) AS umur FROM pelanggan;

-- SOAL 3.2

-- 1.	Berapa jumlah pelanggan yang tahun lahirnya 1998
SELECT COUNT(*) FROM pelanggan WHERE YEAR(tgl_lahir) = 1998;

-- 2.	Berapa jumlah pelanggan perempuan yang tempat lahirnya di Jakarta
SELECT COUNT(*) FROM pelanggan WHERE jk = 'P' AND tmp_lahir LIKE '%Jakarta%';

-- 3.	Berapa jumlah total stok semua produk yang harga jualnya dibawah 10rb
SELECT nama, harga_jual FROM produk WHERE stok > 0 AND harga_jual < 10000;

-- 4.	Ada berapa produk yang mempunyai kode awal K
SELECT COUNT(*) FROM produk WHERE kode LIKE "K%";

-- 5.	Berapa harga jual rata-rata produk yang diatas 1jt
SELECT AVG(harga_jual) FROM produk WHERE harga_jual > 1000000;

-- 6.	Tampilkan jumlah stok yang paling besar
SELECT MAX(stok) FROM produk;

-- 7.	Ada berapa produk yang stoknya kurang dari minimal stok
SELECT COUNT(*) AS 'produk kurang dari minimal stok' FROM produk WHERE stok < min_stok;

-- 8.	Berapa total asset dari keseluruhan produk
SELECT SUM(harga_beli * stok) AS "total asset" FROM produk

-- SOAL 3.3

-- 1.	Tampilkan data produk : id, nama, stok dan informasi jika stok telah sampai batas minimal atau kurang dari minimum stok dengan informasi ‘segera belanja’ jika tidak ‘stok aman’.
SELECT id, nama, stok, 
    CASE 
        WHEN stok < min_stok THEN "segera belanja" 
        ELSE "stok aman" 
    END AS status_produk 
FROM produk;

-- 2.	Tampilkan data pelanggan: id, nama, umur dan kategori umur : jika umur < 17 → ‘muda’ , 17-55 → ‘Dewasa’, selainnya ‘Tua’
SELECT id, nama_pelanggan, (YEAR(NOW())-YEAR(tgl_lahir)) AS umur, 
    CASE 
        WHEN (YEAR(NOW())-YEAR(tgl_lahir)) < 17 THEN "Muda"
        WHEN (YEAR(NOW())-YEAR(tgl_lahir)) >= 17 OR (YEAR(NOW())-YEAR(tgl_lahir)) <= 55 THEN "Dewasa"
        ELSE "Tua" 
    END AS "kategori umur" 
FROM pelanggan;

-- 3.	Tampilkan data produk: id, kode, nama, dan bonus untuk kode ‘TV01’ →’DVD Player’ , ‘K001’ → ‘Rice Cooker’ selain dari diatas ‘Tidak Ada’
SELECT id, kode, nama, 
    CASE 
        WHEN kode = "TV01" THEN "DVD Player"
        WHEN kode = "K001" THEN "Rice Cooker"
        ELSE "Tidak Ada" 
    END AS "bonus" 
FROM produk;

-- SOAL 3.4

-- 1.	Tampilkan data statistik jumlah tempat lahir pelanggan
SELECT tmp_lahir, COUNT(*) AS "jumlah pelanggan" FROM pelanggan GROUP BY tmp_lahir;

-- 2.	Tampilkan jumlah statistik produk berdasarkan jenis produk
SELECT jenis_produk_id, COUNT(*) AS jumlah_produk FROM produk GROUP BY jenis_produk_id;

-- 3.	Tampilkan data pelanggan yang usianya dibawah rata usia pelanggan
SELECT nama_pelanggan, (YEAR(NOW())-YEAR(tgl_lahir)) AS usia FROM pelanggan WHERE (YEAR(NOW())-YEAR(tgl_lahir)) < (SELECT AVG((YEAR(NOW())-YEAR(tgl_lahir))) FROM pelanggan);

-- 4.	Tampilkan data produk yang harganya diatas rata-rata harga produk
SELECT id, nama, harga_jual FROM produk WHERE harga_jual > (SELECT AVG(harga_jual) FROM produk);

-- 5.	Tampilkan data pelanggan yang memiliki kartu dimana iuran tahunan kartu diatas 90rb
SELECT pelanggan.id, pelanggan.nama_pelanggan, kartu.kode, kartu.iuran FROM pelanggan 
    JOIN kartu ON pelanggan.kartu_id = kartu.id WHERE kartu.iuran > 90000;

-- 6.	Tampilkan statistik data produk dimana harga produknya dibawah rata-rata harga produk secara keseluruhan
SELECT COUNT(*) AS jumlah_produk, MIN(harga_jual) AS harga_minimal, MAX(harga_jual) AS harga_maksimal, 
    AVG(harga_jual) AS rata_rata_harga FROM produk 
    WHERE harga_jual < (SELECT AVG(harga_jual) FROM produk);

-- 7.	Tampilkan data pelanggan yang memiliki kartu dimana diskon kartu yang diberikan diatas 3%
SELECT pelanggan.id, pelanggan.nama_pelanggan, pelanggan.tgl_lahir, kartu.kode, kartu.diskon
    FROM pelanggan JOIN kartu  ON pelanggan.kartu_id = kartu.id WHERE kartu.diskon > 0.03;
