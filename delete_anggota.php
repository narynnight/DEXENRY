<?php
session_start();
require 'config.php';

if (isset($_GET['nisn']) && !empty($_GET['nisn'])) {
    $nisn = mysqli_real_escape_string($conn, $_GET['nisn']);

    $query_delete = mysqli_query($conn, "DELETE FROM anggota WHERE nisn = '$nisn'");

    if ($query_delete) {
        echo "<script>alert('Data anggota dan semua riwayat peminjamannya berhasil dihapus!'); window.location.href='data_anggota.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data anggota!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('NISN tidak valid!'); window.history.back();</script>";
}
?>
