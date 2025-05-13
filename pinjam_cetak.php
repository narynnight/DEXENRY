<?php
session_start();
include('config.php');

if (!isset($_SESSION['signIn'])) {
    header("Location: detail_buku_cetak.php?id_buku={$_POST['id_buku']}&msg=" . urlencode("Anda harus login untuk meminjam buku."));
    exit;
}

$nisn = $_SESSION['signIn'];
$id_buku = (int) $_POST['id_buku'];

// Cek apakah sudah meminjam dan belum dikembalikan
$cek = mysqli_query($conn, "SELECT * FROM peminjaman WHERE nisn='$nisn' AND id_buku='$id_buku' AND status='proses peminjaman'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: detail_buku_cetak.php?id_buku=$id_buku&msg=" . urlencode("Buku ini masih dalam proses peminjaman. Silakan ambil ke perpustakaan."));
    exit;
}

// Cek ketersediaan
$cek_tersedia = mysqli_query($conn, "SELECT tersedia FROM buku WHERE id_buku = '$id_buku'");
$data_tersedia = mysqli_fetch_assoc($cek_tersedia);

if ($data_tersedia['tersedia'] <= 0) {
    header("Location: detail_buku_cetak.php?id_buku=$id_buku&msg=" . urlencode("Maaf, buku ini sedang habis dan tidak tersedia untuk dipinjam."));
    exit;
}

// Proses peminjaman
$sql = "INSERT INTO peminjaman (nisn, id_buku, status) VALUES ('$nisn', '$id_buku', 'proses peminjaman')";
if (mysqli_query($conn, $sql)) {
    mysqli_query($conn, "UPDATE buku SET tersedia = tersedia - 1 WHERE id_buku = '$id_buku'");
    header("Location: peminjaman_buku.php?id_buku=$id_buku&msg=" . urlencode("Berhasil meminjam! Silakan datang ke perpustakaan untuk ambil bukunya."));
    exit;
} else {
    header("Location: detail_buku_cetak.php?id_buku=$id_buku&msg=" . urlencode("Gagal meminjam buku. Silakan coba lagi."));
    exit;
}
?>
