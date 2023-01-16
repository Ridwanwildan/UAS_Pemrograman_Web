<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_kas_rt";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo "Koneksi Gagal";
    die();
}
?>
