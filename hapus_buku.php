<?php
// Koneksi ke database
include('config.php');

// Cek apakah ada id_buku yang dikirim
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Ambil dulu data cover buku sebelum hapus, supaya file gambarnya bisa dihapus juga
    $query_get = mysqli_query($conn, "SELECT cover FROM buku WHERE id_buku = '$id_buku'");
    $data = mysqli_fetch_assoc($query_get);

    if ($data) {
        // Hapus file cover dari folder uploads jika ada
        if (!empty($data['cover']) && file_exists('uploads/' . $data['cover'])) {
            unlink('uploads/' . $data['cover']);
        }

        // Hapus data buku dari database
        $query_delete = mysqli_query($conn, "DELETE FROM buku WHERE id_buku = '$id_buku'");

        if ($query_delete) {
            echo "<script>alert('Buku berhasil dihapus!'); window.location.href='data_buku.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus buku!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Data buku tidak ditemukan!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID Buku tidak ditemukan!'); window.history.back();</script>";
}
?>
