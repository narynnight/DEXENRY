<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit();
}
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];

    $update = "UPDATE peminjaman SET status = 'dipinjam' WHERE id_peminjaman = '$id_peminjaman'";
    if (mysqli_query($conn, $update)) {
        header("Location: peminjaman.php");
        exit();
    } else {
        echo "Gagal konfirmasi peminjaman: " . mysqli_error($conn);
    }
} else {
    header("Location: peminjaman.php");
    exit();
}
?>
