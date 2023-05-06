<?php 
require_once '../koneksi.php';
class Pelanggan_model {
    private $dbh;

    public function __construct() {
        global $dsn, $user, $password;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Terjadi Kesalahan Koneksi DB dengan sebab: ' .
            $e->getMessage());
        }
    }

    public function get_pelanggan() {
        $stmt = $this->dbh->prepare('SELECT pelanggan.*, CASE WHEN jk = "L" THEN "Laki-laki" ELSE "Perempuan" END AS jk, kartu.nama AS kartu FROM pelanggan JOIN kartu ON pelanggan.kartu_id = kartu.id ORDER BY nama_pelanggan;');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>