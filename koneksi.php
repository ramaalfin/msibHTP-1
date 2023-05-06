<?php 
$dbname = "dbpos2";
$dsn = 'mysql:dbname='.$dbname.'; host:host=localhost';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Terjadi Kesalahan Koneksi DB dengan sebab: ' .
    $e->getMessage();
}

?>