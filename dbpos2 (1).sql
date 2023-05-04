-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2023 at 10:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpos2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputPelanggan` (IN `kode` VARCHAR(11), IN `nama_pelanggan` VARCHAR(255), IN `jk` VARCHAR(1), IN `tmp_lahir` VARCHAR(255), IN `tgl_lahir` DATE, IN `email` VARCHAR(255), IN `kartu_id` INT(11), OUT `id_pelanggan` INT(11))   BEGIN
  -- memasukkan data pelanggan baru ke dalam tabel pelanggan
  INSERT INTO pelanggan (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id) VALUES (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id);
  
  -- menyimpan id pelanggan yang baru saja dibuat
  SET id_pelanggan = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inputProduk` (IN `kode` VARCHAR(10), IN `nama` VARCHAR(255), IN `jenis_produk_id` VARCHAR(255), IN `harga_jual` DOUBLE, IN `harga_beli` DOUBLE, IN `stok` INT(11), IN `min_stok` INT(11))   BEGIN
    INSERT INTO produk (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok) 
    VALUES (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showAllPesanan` ()   BEGIN
  SELECT pesanan.id AS pesanan_id, pesanan.tanggal, pelanggan.kode AS pelanggan_kode, pelanggan.nama_pelanggan, produk.kode AS produk_kode, produk.nama AS nama_produk, pesanan_items.qty, produk.harga_jual, SUM(pesanan_items.qty * pesanan_items.harga) AS total_harga
    FROM pesanan
    JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
    JOIN pesanan_items ON pesanan.id = pesanan_items.pesanan_id
    JOIN produk ON pesanan_items.produk_id = produk.id
    GROUP BY pesanan.id, produk.id, pesanan_items.id, pelanggan.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showPelanggan` ()   BEGIN
    SELECT * FROM pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showProduk` ()   BEGIN
    SELECT * FROM produk;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `totalPesanan` ()   BEGIN
  SELECT pelanggan.kode AS kode_pelanggan, pelanggan.nama_pelanggan, SUM(pesanan_items.qty) AS total_produk, SUM(pesanan_items.qty * pesanan_items.harga) AS total_harga
  FROM pesanan_items
  JOIN pesanan ON pesanan_items.pesanan_id = pesanan.id
  JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
  GROUP BY pelanggan.kode, pelanggan.nama_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pembayaran_status` (`pesanan_id` INT)   BEGIN
    DECLARE total_bayar DECIMAL(10, 2);
    DECLARE total_pesanan DECIMAL(10, 2);

    -- Ambil total pembayaran dari tabel pembayaran
    SELECT SUM(jumlah) INTO total_bayar FROM pembayaran WHERE pesanan_id = pesanan_id;

    -- Ambil total pesanan dari tabel pesanan
    SELECT total INTO total_pesanan FROM pesanan WHERE id = pesanan_id;

    -- Jika total pembayaran sama dengan total pesanan, update status pembayaran menjadi lunas
    IF total_bayar >= total_pesanan THEN
        UPDATE pembayaran
        SET status_pembayaran = 'Lunas'
        WHERE pesanan_id = pesanan_id;
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `inputPelanggan` (`kode` VARCHAR(11), `nama_pelanggan` VARCHAR(255), `jk` VARCHAR(1), `tmp_lahir` VARCHAR(255), `tgl_lahir` DATE, `email` VARCHAR(255), `kartu_id` INT(11)) RETURNS INT DETERMINISTIC BEGIN
  DECLARE id_pelanggan INT(11);
  
  -- memasukkan data pelanggan baru ke dalam tabel pelanggan
  INSERT INTO pelanggan (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id) VALUES (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id);
  
  -- menyimpan id pelanggan yang baru saja dibuat
  SET id_pelanggan = LAST_INSERT_ID();
  
  RETURN id_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `inputProduk` (`kode` VARCHAR(10), `nama` VARCHAR(255), `jenis_produk_id` VARCHAR(255), `harga_jual` DOUBLE, `harga_beli` DOUBLE, `stok` INT(11), `min_stok` INT(11)) RETURNS INT DETERMINISTIC BEGIN
    DECLARE id_produk INT;
    INSERT INTO produk (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok) 
    VALUES (kode, nama, jenis_produk_id, harga_jual, harga_beli, stok, min_stok);
    SET id_produk = LAST_INSERT_ID();
    RETURN id_produk;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `showPelanggan` () RETURNS TEXT CHARSET utf8mb4 DETERMINISTIC BEGIN
    DECLARE result TEXT;
    SET result = '';
    SELECT GROUP_CONCAT(CONCAT('ID: ', pelanggan.id, ', Kode: ', pelanggan.kode, ', Nama Pelanggan: ', pelanggan.nama_pelanggan) SEPARATOR '; ') INTO result FROM pelanggan;
    RETURN result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `showPesananAll` () RETURNS TEXT CHARSET utf8mb4 DETERMINISTIC BEGIN
  DECLARE result TEXT;
  SELECT CONCAT('Pesanan ID: ', pesanan.id, ', Tanggal: ', pesanan.tanggal, ', Kode Pelanggan: ', pelanggan.kode, ', Nama Pelanggan: ', pelanggan.nama_pelanggan, ', Kode Produk: ', produk.kode, ', Nama Produk: ', produk.nama, ', Jumlah: ', pesanan_items.qty, ', Harga Satuan: ', produk.harga_jual, ', Total Harga: ', pesanan_items.qty * produk.harga_jual) INTO result
    FROM pesanan
    JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
    JOIN pesanan_items ON pesanan.id = pesanan_items.pesanan_id
    JOIN produk ON pesanan_items.produk_id = produk.id
    WHERE pesanan.id = pesanan_id
    LIMIT 1;
  RETURN result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `showProduk` () RETURNS TEXT CHARSET utf8mb4 DETERMINISTIC BEGIN
    DECLARE result TEXT;
    SET result = '';
    SELECT GROUP_CONCAT(CONCAT('ID: ', produk.id, ', Kode: ', produk.kode, ', Nama: ', produk.nama, ', Harga Beli: ', produk.harga_beli, ', Harga Jual: ', produk.harga_jual, ', Stok: ', produk.stok, ', Minimum Stok: ', produk.min_stok) SEPARATOR '; ') INTO result FROM produk;
    RETURN result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `totalPesanan` () RETURNS TEXT CHARSET utf8mb4 DETERMINISTIC BEGIN
  DECLARE result TEXT;
  SELECT CONCAT('Kode Pelanggan: ', pelanggan.kode, ', Nama Pelanggan: ', pelanggan.nama_pelanggan, ', Total Produk: ', SUM(pesanan_items.qty), ', Total Harga: ', SUM(pesanan_items.qty * pesanan_items.harga)) INTO result
  FROM pesanan_items
  JOIN pesanan ON pesanan_items.pesanan_id = pesanan.id
  JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
  GROUP BY pelanggan.kode, pelanggan.nama_pelanggan
  LIMIT 1;
  RETURN result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `nama`) VALUES
(1, 'elektronik'),
(2, 'furniture'),
(3, 'makanan'),
(4, 'minuman'),
(5, 'komputer');

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `id` int NOT NULL,
  `kode` varchar(6) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `iuran` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id`, `kode`, `nama`, `diskon`, `iuran`) VALUES
(1, 'GOLD', 'Gold Utama', 0.05, 100000),
(2, 'PLAT', 'Platinum Jaya', 0.1, 150000),
(3, 'SLV', 'Silver', 0.025, 50000),
(4, 'NO', 'Non Member', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama_pelanggan` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `tmp_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `kartu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nama_pelanggan`, `jk`, `tmp_lahir`, `tgl_lahir`, `email`, `kartu_id`) VALUES
(1, 'C001', 'Agung Sedayu', 'L', 'Solo', '2010-01-01', 'sedayu@gmail.com', 1),
(2, 'C002', 'Pandan Wangi', 'P', 'Yogyakarta', '1950-01-01', 'wangi@gmail.com', 2),
(3, 'C003', 'Sekar Mirah', 'P', 'Kediri', '1983-02-20', 'mirah@yahoo.com', 1),
(4, 'C004', 'Swandaru Geni', 'L', 'Kediri', '1981-01-04', 'swandaru@yahoo.com', 4),
(5, 'C005', 'Pradabashu', 'L', 'Pati', '1985-04-02', 'prada85@gmail.com', 2),
(6, 'C006', 'Gayatri Dwi', 'P', 'Jakarta', '1987-11-28', 'gaya87@gmail.com', 1),
(7, 'C007', 'Dewi Gyat', 'P', 'Jakarta', '1988-12-01', 'giyat@gmail.com', 1),
(8, 'C008', 'Andre Haru', 'L', 'Surabaya', '1990-07-15', 'andre.haru@gmail.com', 4),
(9, 'C009', 'Ahmad Hasan', 'L', 'Surabaya', '1992-10-15', 'ahasan@gmail.com', 4),
(10, 'C010', 'Cassanndra', 'P', 'Belfast', '1990-11-20', 'casa90@gmail.com', 1),
(12, 'C011', 'Alex', 'L', 'Jakarta', '1996-05-12', 'alex@gmail.com', 2),
(13, 'C012', 'Amara', 'P', 'Jakarta', '1996-05-12', 'amara@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `nokuitansi` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `ke` int DEFAULT NULL,
  `pesanan_id` int NOT NULL,
  `status_pembayaran` varchar(100) DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nokuitansi`, `tanggal`, `jumlah`, `ke`, `pesanan_id`, `status_pembayaran`) VALUES
(24, 'INV001', '2023-05-02', 20000, 1, 2, 'Belum Lunas'),
(25, 'INV002', '2023-05-02', 17500, 2, 2, 'Belum Lunas'),
(26, 'INV003', '2023-05-02', 20000, 1, 2, 'Belum Lunas'),
(34, 'INV004', '2023-05-02', 25000, 1, 2, 'Lunas'),
(35, 'INV005', '2023-05-02', 15000, 1, 11, 'Belum Lunas'),
(36, 'INV006', '2023-05-02', 15000, 1, 11, 'Lunas'),
(37, 'INV007', '2023-05-04', 20000, 1, 11, 'Lunas');

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `update_status_pembayaran` BEFORE INSERT ON `pembayaran` FOR EACH ROW BEGIN
    DECLARE total_bayar DECIMAL(10, 2);
    DECLARE total_pesanan DECIMAL(10, 2);

    -- Ambil total pembayaran dari tabel pembayaran
    SELECT SUM(jumlah) INTO total_bayar FROM pembayaran WHERE pesanan_id = NEW.pesanan_id;

    -- Ambil total pesanan dari tabel pesanan
    SELECT total INTO total_pesanan FROM pesanan WHERE id = NEW.pesanan_id;

    -- Jika total pembayaran lebih besar atau sama dengan total pesanan, update status pembayaran menjadi lunas
    IF total_bayar + NEW.jumlah >= total_pesanan THEN
        SET NEW.status_pembayaran = 'Lunas';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `nomor` varchar(10) DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `vendor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal`, `nomor`, `produk_id`, `jumlah`, `harga`, `vendor_id`) VALUES
(1, '2019-10-10', 'P001', 1, 2, 3500000, 1),
(2, '2019-11-20', 'P002', 2, 5, 5500000, 2),
(3, '2019-12-12', 'P003', 2, 5, 5400000, 1),
(4, '2020-01-20', 'P004', 7, 200, 1800, 3),
(5, '2020-01-20', 'P005', 5, 100, 2300, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `pelanggan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal`, `total`, `pelanggan_id`) VALUES
(1, '2015-11-04', 9720000, 1),
(2, '2015-11-04', 17500, 3),
(3, '2015-11-04', 0, 6),
(4, '2015-11-04', 0, 7),
(5, '2015-11-04', 0, 10),
(6, '2015-11-04', 0, 2),
(7, '2015-11-04', 0, 5),
(8, '2015-11-04', 0, 4),
(9, '2015-11-04', 0, 8),
(10, '2015-11-04', 0, 9),
(11, '2023-05-04', 10000, 3),
(12, '2023-05-05', 500000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_items`
--

CREATE TABLE `pesanan_items` (
  `id` int NOT NULL,
  `produk_id` int NOT NULL,
  `pesanan_id` int NOT NULL,
  `qty` int DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pesanan_items`
--

INSERT INTO `pesanan_items` (`id`, `produk_id`, `pesanan_id`, `qty`, `harga`) VALUES
(1, 1, 1, 1, 5040000),
(2, 3, 1, 1, 4680000),
(3, 5, 2, 5, 3500),
(6, 5, 3, 10, 3500),
(7, 1, 3, 1, 5040000),
(9, 5, 5, 10, 3500),
(10, 5, 6, 20, 3500);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pesanan_produk_vw`
-- (See below for the actual view)
--
CREATE TABLE `pesanan_produk_vw` (
`pesanan_id` int
,`tanggal` date
,`pelanggan_kode` varchar(10)
,`nama_pelanggan` varchar(45)
,`produk_kode` varchar(10)
,`nama_produk` varchar(45)
,`qty` int
,`harga_jual` double
,`total_harga` double
);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `min_stok` int DEFAULT NULL,
  `jenis_produk_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `harga_beli`, `harga_jual`, `stok`, `min_stok`, `jenis_produk_id`) VALUES
(1, 'TV01', 'Televisi 21 inch', 3500000, 5040000, 5, 2, 1),
(2, 'TV02', 'Televisi 40 inch', 5500000, 7440000, 4, 2, 1),
(3, 'K001', 'Kulkas 2 pintu', 3500000, 4680000, 6, 2, 1),
(4, 'M001', 'Meja Makan', 500000, 600000, 4, 3, 2),
(5, 'TK01', 'Teh Kotak', 3000, 3500, 6, 10, 4),
(6, 'PC01', 'PC Desktop HP', 7000000, 9600000, 9, 2, 5),
(7, 'TB01', 'Teh Botol', 2000, 2500, 53, 10, 4),
(8, 'AC01', 'Notebook Acer', 8000000, 10800000, 7, 2, 5),
(9, 'LN01', 'Notebook Lenovo', 9000000, 12000000, 9, 2, 5),
(10, 'L004', 'Laptop HP', 12000000, 13000000, 20, 5, 5),
(11, 'L002', 'Laptop ASUS', 10000000, 15000000, 50, 10, 5),
(13, 'L003', 'Laptop ACER', 10000000, 15000000, 50, 10, 5),
(14, 'L005', 'Laptop MAC', 10000000, 15000000, 50, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int NOT NULL,
  `nomor` varchar(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `kontak` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nomor`, `nama`, `kota`, `kontak`) VALUES
(1, 'V001', 'PT Guna Samudra', 'Surabaya', 'Ali Nurdin'),
(2, 'V002', 'PT Pondok C9', 'Depok', 'Putri Ramadhani'),
(3, 'V003', 'CV Jaya Raya Semesta', 'Jakarta', 'Dwi Rahayu'),
(4, 'V004', 'PT Lekulo X', 'Kebumen', 'Mbambang G'),
(5, 'V005', 'PT IT Prima', 'Jakarta', 'David W');

-- --------------------------------------------------------

--
-- Structure for view `pesanan_produk_vw`
--
DROP TABLE IF EXISTS `pesanan_produk_vw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pesanan_produk_vw`  AS SELECT `pesanan`.`id` AS `pesanan_id`, `pesanan`.`tanggal` AS `tanggal`, `pelanggan`.`kode` AS `pelanggan_kode`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `produk`.`kode` AS `produk_kode`, `produk`.`nama` AS `nama_produk`, `pesanan_items`.`qty` AS `qty`, `produk`.`harga_jual` AS `harga_jual`, sum((`pesanan_items`.`qty` * `pesanan_items`.`harga`)) AS `total_harga` FROM (((`pesanan` join `pelanggan` on((`pesanan`.`pelanggan_id` = `pelanggan`.`id`))) join `pesanan_items` on((`pesanan`.`id` = `pesanan_items`.`pesanan_id`))) join `produk` on((`pesanan_items`.`produk_id` = `produk`.`id`))) GROUP BY `pesanan`.`id`, `produk`.`id`, `pesanan_items`.`id`, `pelanggan`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggan_kartu1_idx` (`kartu_id`),
  ADD KEY `idx_nama_pelanggan` (`nama_pelanggan`),
  ADD KEY `idx_tgllahir_pelanggan` (`tgl_lahir`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nokuitansi_UNIQUE` (`nokuitansi`),
  ADD KEY `fk_pembayaran_pesanan1_idx` (`pesanan_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_UNIQUE` (`nomor`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_customer_idx` (`pelanggan_id`);

--
-- Indexes for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_items_pesanan1_idx` (`pesanan_id`),
  ADD KEY `fk_pesanan_items_produk1_idx` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`),
  ADD KEY `fk_produk_jenis_produk1_idx` (`jenis_produk_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_kartu1` FOREIGN KEY (`kartu_id`) REFERENCES `kartu` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pesanan1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_customer` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD CONSTRAINT `fk_pesanan_items_pesanan1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `fk_pesanan_items_produk1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_jenis_produk1` FOREIGN KEY (`jenis_produk_id`) REFERENCES `jenis_produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
