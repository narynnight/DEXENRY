<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nisn = $_POST['nisn']; // ini sudah hidden
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $no_telp = $_POST['no_telp'];

    $sql = "UPDATE anggota SET 
                nama = '$nama', 
                jenis_kelamin = '$jenis_kelamin', 
                kelas = '$kelas', 
                no_telp = '$no_telp' 
            WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $sql)) {
        header("Location: data_anggota.php?pesan=berhasil_update");
        exit();
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>
