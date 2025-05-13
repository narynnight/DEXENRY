<?php
session_start();
require 'config.php';

if (!isset($_SESSION['signIn'])) {
    die("Harus login terlebih dahulu.");
}

$nisn = $_SESSION['signIn'];
$id_peminjaman = $_POST['id_peminjaman'];

// Cek jenis buku sebelum mengubah status
$cek = mysqli_query($conn, "SELECT buku.jenis FROM peminjaman 
                            JOIN buku ON peminjaman.id_buku = buku.id_buku 
                            WHERE peminjaman.id_peminjaman = '$id_peminjaman' AND peminjaman.nisn = '$nisn'");
$data = mysqli_fetch_assoc($cek);

if ($data['jenis'] !== 'cetak') {
    die("Buku digital tidak perlu dikembalikan.");
}

// Update status pengembalian
$sql = "UPDATE peminjaman SET status = 'dikembalikan', tanggal_pengembalian = NOW() 
        WHERE id_peminjaman = '$id_peminjaman' AND nisn = '$nisn'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Menambahkan kembali jumlah tersedia setelah pengembalian
    mysqli_query($conn, "UPDATE buku SET tersedia = tersedia + 1 WHERE id_buku = (SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman')");

    header("Location: peminjaman_buku.php");
    exit();
} else {
    echo "Gagal mengembalikan buku: " . mysqli_error($conn);
}
?>
