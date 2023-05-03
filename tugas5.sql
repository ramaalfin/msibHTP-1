-- membuat fungsi inputPelanggan()
DELIMITER $$
CREATE FUNCTION inputPelanggan(kode VARCHAR(11), nama_pelanggan VARCHAR(255), jk VARCHAR(1), tmp_lahir VARCHAR(255), tgl_lahir DATE, email VARCHAR(255), kartu_id INT(11))
RETURNS INT(11)
DETERMINISTIC
BEGIN
  DECLARE id_pelanggan INT(11);
  
  -- memasukkan data pelanggan baru ke dalam tabel pelanggan
  INSERT INTO pelanggan (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id) VALUES (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id);
  
  -- menyimpan id pelanggan yang baru saja dibuat
  SET id_pelanggan = LAST_INSERT_ID();
  
  RETURN id_pelanggan;
END $$
DELIMITER ;
SELECT inputPelanggan('C012', 'Amara', 'P', 'Jakarta', '1996-05-12', 'amara@gmail.com', 2);



-- Buat fungsi showPelanggan(), setelah itu panggil fungsinya
DELIMITER $$
CREATE PROCEDURE showPelanggan()
BEGIN
    SELECT * FROM pelanggan;
END $$
DELIMITER ;

CALL showPelanggan();


-- Buat fungsi inputProduk(), setelah itu panggil fungsinya
DELIMITER $$
CREATE PROCEDURE inputProduk(
    IN kode VARCHAR(10),
    IN nama VARCHAR(255),
    IN jenis_produk_id VARCHAR(255),
    IN harga_jual DOUBLE,
    IN harga_beli DOUBLE,
    IN stok INT(11),
    IN min_stok INT(11)
)
BEGIN
    INSERT INTO produk (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok) 
    VALUES (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok);
END $$
DELIMITER ;
CALL inputProduk('L002', 'Laptop ASUS', 5, 15000000, 10000000, 50, 10);



-- Buat fungsi showProduk(), setelah itu panggil fungsinya
DELIMITER $$
CREATE PROCEDURE showProduk()
BEGIN
    SELECT * FROM produk;
END $$
DELIMITER ;

CALL showProduk();


-- Buat fungsi totalPesanan(), setelah itu panggil fungsinya
DELIMITER $$
BEGIN
  SELECT pelanggan.kode AS kode_pelanggan, pelanggan.nama_pelanggan, SUM(pesanan_items.qty) AS total_produk, SUM(pesanan_items.qty * pesanan_items.harga) AS total_harga
  FROM pesanan_items
  JOIN pesanan ON pesanan_items.pesanan_id = pesanan.id
  JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
  GROUP BY pelanggan.kode, pelanggan.nama_pelanggan;
END $$
DELIMITER ;
CALL totalPesanan();


-- tampilkan seluruh pesanan dari semua pelanggan
DELIMITER $$
CREATE PROCEDURE showAllPesanan()
BEGIN
  SELECT pesanan.id AS pesanan_id, pesanan.tanggal, pelanggan.kode AS pelanggan_kode, pelanggan.nama_pelanggan, produk.kode AS produk_kode, produk.nama AS nama_produk, pesanan_items.qty, produk.harga_jual, SUM(pesanan_items.qty * pesanan_items.harga) AS total_harga
    FROM pesanan
    JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
    JOIN pesanan_items ON pesanan.id = pesanan_items.pesanan_id
    JOIN produk ON pesanan_items.produk_id = produk.id
    GROUP BY pesanan.id, produk.id, pesanan_items.id, pelanggan.id;
END $$
DELIMITER ;
CALL showAllPesanan();


-- buatkan query panjang di atas menjadi sebuah view baru: pesanan_produk_vw (menggunakan join dari table pesanan,pelanggan dan produk)
CREATE VIEW pesanan_produk_vw AS
SELECT pesanan.id AS pesanan_id, pesanan.tanggal, pelanggan.kode AS pelanggan_kode, pelanggan.nama_pelanggan, produk.kode AS produk_kode, produk.nama AS nama_produk, pesanan_items.qty, produk.harga_jual, SUM(pesanan_items.qty * pesanan_items.harga) AS total_harga
    FROM pesanan
    JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
    JOIN pesanan_items ON pesanan.id = pesanan_items.pesanan_id
    JOIN produk ON pesanan_items.produk_id = produk.id
    GROUP BY pesanan.id, produk.id, pesanan_items.id, pelanggan.id;

SELECT * FROM pesanan_produk_vw;