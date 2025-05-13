<?php
session_start(); // Harus di atas
require_once "config.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE nama_admin = '$nama'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];

        if (password_verify($password, $hashedPassword)) {
            // Simpan ID admin ke dalam session
            $_SESSION['id_admin'] = $user['id_admin'];

            echo '<script>
                alert("Anda berhasil login.");
                window.location.href = "dashboard_admin.php";
            </script>';
        } else {
            echo '<script>
                alert("Password salah.");
                window.location.href = "login_admin.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("Akun tidak ditemukan. Silakan register terlebih dahulu.");
            window.location.href = "login_admin.php";
        </script>';
    }
}
?>
