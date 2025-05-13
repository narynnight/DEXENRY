<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>DASHBOARD ADMIN - DEXENRY</title>
    <style>
        .content{
         max-width: 1400px;
    min-height: 46vh;
    padding: 60px 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column; /* Menyusun elemen secara vertikal */
    justify-content: flex-start; /* Untuk memastikan elemen dimulai dari atas */
    align-items: center; /* Tengah-tengah */
        }
        h2{
            color: #fff;
        }
    </style>
</head>
<body>
<header>
        <div class="navbar">
            <div class="logo" style="width: 50%">
                <img src="erasebg-transformed.png" alt="Logo">
            </div>
            <div style="width: 50%">
                <nav>
                    <ul>

                        <!-- Dropdown Layanan -->
                        <li class="dropdown">
                            <a href="#">Data Pengguna</a>
                            <ul class="dropdown-content">
                            <li><a href="data_anggota.php">Anggota</a></li>
                            </ul>
                        </li>
                            <li><a href="peminjaman.php">Data Peminjaman</a></li>
                        <li class="dropdown">
                            <a href="#">Data Buku</a>
                            <ul class="dropdown-content">
                            <li><a href="data_buku.php">Fisik</a></li>
                            <li><a href="data_bukudigital.php">Digital</a></li>
                            </ul>
                        </li>
                        <li><a href="logout_admin.php" onclick="return confirmLogout()"  class="login-btn">LOG OUT</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <section class="content">
        <div class="container">
        <h2>DASHBOARD ADMIN DEXENRY</h2>
        </div>
    </section>
    <script>
    function confirmLogout() {
    return confirm("Apakah Anda yakin ingin log out?");
    }
    </script>
</body>
</html>