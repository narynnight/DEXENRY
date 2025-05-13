<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_admin = mysqli_real_escape_string($conn, $_POST['nama_admin']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi_password'];

    // Validasi password dan konfirmasi
    if ($password !== $konfirmasi) {
        echo "<script>
            alert('Konfirmasi password tidak cocok!');
            window.location.href = 'register_admin.php';
        </script>";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database
    $sql = "INSERT INTO admin (nama_admin, no_telp, password)
            VALUES ('$nama_admin', '$no_telp', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Registrasi berhasil! Silakan login.');
            window.location.href = 'login_admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat registrasi!');
            window.location.href = 'register_admin.php';
        </script>";
    }
}
?>
