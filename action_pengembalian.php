<?php
session_start();
include('config.php');

if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];

    // Ambil id_buku dari tabel peminjaman
    $sqlGet = "SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    $result = mysqli_query($conn, $sqlGet);
    if ($row = mysqli_fetch_assoc($result)) {
        $id_buku = $row['id_buku'];

        // Update status peminjaman jadi dikembalikan
        $updateStatus = "UPDATE peminjaman SET status = 'dikembalikan' WHERE id_peminjaman = '$id_peminjaman'";
        $updateJumlah = "UPDATE buku SET tersedia = tersedia + 1 WHERE id_buku = '$id_buku'";

        // Eksekusi dua update
        if (mysqli_query($conn, $updateStatus) && mysqli_query($conn, $updateJumlah)) {
            header("Location: peminjaman.php");
            exit();
        } else {
            echo "Gagal memperbarui status atau jumlah buku: " . mysqli_error($conn);
        }
    } else {
        echo "Peminjaman tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>

