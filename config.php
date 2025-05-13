<?php
$host = "localhost"; // Sesuaikan dengan server database
$user = "root";      // Sesuaikan dengan username database
$pass = "";          // Jika ada password MySQL, isi di sini
$dbname = "dexenry"; // Sesuaikan dengan nama database

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
