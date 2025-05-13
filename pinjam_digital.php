<?php
session_start();
include('config.php');

// Cek apakah user login sebagai anggota
if (!isset($_SESSION['signIn'])) {
    die("Anda harus login sebagai anggota terlebih dahulu.");
}


$nisn = $_SESSION['signIn'];
$id_buku = (int) $_POST['id_buku'];  // Amankan input

// Cek apakah sudah pernah pinjam dan belum dikembalikan
$cek = mysqli_query($conn, "SELECT * FROM peminjaman WHERE nisn='$nisn' AND id_buku='$id_buku' AND status='dipinjam'");
if (mysqli_num_rows($cek) > 0) {
    echo "Buku ini sudah Anda pinjam dan belum dikembalikan.";
    exit;
}

// Simpan peminjaman baru
$sql = "INSERT INTO peminjaman (nisn, id_buku, status) VALUES ('$nisn', '$id_buku', 'dipinjam')";
if (mysqli_query($conn, $sql)) {
    header("Location: peminjaman_buku.php");
    exit;
} else {
    echo "Gagal meminjam buku: " . mysqli_error($conn);
}
?>
