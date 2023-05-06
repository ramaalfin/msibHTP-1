<?php 
require_once '../koneksi.php';
class Pesanan_model{
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
    public function get_pesanan()
    {
        $stmt = $this->dbh->prepare('SELECT pesanan.*, pelanggan.nama_pelanggan AS nama_pelanggan FROM pesanan JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id ORDER BY tanggal');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>