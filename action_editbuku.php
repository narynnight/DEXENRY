<?php
// Koneksi ke database
include('config.php');

if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];
    
    // Ambil data buku berdasarkan id_buku
    $query = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $buku = mysqli_fetch_assoc($result);
    } else {
        echo "Buku tidak ditemukan!";
        exit;
    }
} else {
    echo "ID buku tidak diberikan!";
    exit;
}


// Inisialisasi variabel
$buku = null;

    // Proses update jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
        $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
        $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
        $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
        $jumlah_halaman = intval($_POST['jumlah_halaman']);
        $deskripsi_buku = mysqli_real_escape_string($conn, $_POST['deskripsi_buku']);

        // Cek jika ada file cover baru
        if (isset($_FILES['cover']) && $_FILES['cover']['name'] != "") {
            $cover = basename($_FILES['cover']['name']);
            $target_dir = "uploads/";
            $target_file = $target_dir . $cover;
            move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
        } else {
            $cover = $buku['cover']; // Jika cover tidak diubah, gunakan cover lama
        }

        // Update data ke database
        $sql_update = "UPDATE buku SET 
                        judul = '$judul',
                        penulis = '$penulis',
                        penerbit = '$penerbit',
                        tahun_terbit = '$tahun_terbit',
                        cover = '$cover',
                        jumlah_halaman = '$jumlah_halaman',
                        deskripsi_buku = '$deskripsi_buku',
                        kategori = '$kategori'
                        WHERE id_buku = '$id_buku'";

        if (mysqli_query($conn, $sql_update)) {
            echo "<script>alert('Buku berhasil diperbarui!'); window.location.href='daftar_buku.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    die("ID Buku tidak ditemukan!");
}
?>
