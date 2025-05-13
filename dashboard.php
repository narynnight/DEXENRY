<?php
session_start();
if (!isset($_SESSION['signIn'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SMKN 1 Depok</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                        <li><a href="dashboard.php">HOME</a></li>
                        <li><a href="peminjaman_buku.php">KOLEKSI SAYA</a></li>
                        <li class="dropdown">
                            <a href="#">KOLEKSI</a>
                            <ul class="dropdown-content">
                                <li><a href="digital.php">Koleksi Digital</a></li>
                                <li><a href="cetak.php">Koleksi Fisik</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php" onclick="return confirmLogout()" class="login-btn">LOG OUT</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- SECTION TATA CARA PEMINJAMAN -->
    <section class="cara-peminjaman" style="background-color: #f8f9fa; padding: 50px 20px;">
        <div class="container" style="max-width: 1000px; margin: auto;">
            <h2 style="text-align: center; margin-bottom: 30px;">Tata Cara Peminjaman</h2>
            <div class="peminjaman-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div class="box" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h3>Koleksi Fisik</h3>
                    <ol>
                        <li>Buka menu <strong>Koleksi Fisik</strong>.</li>
                        <li>Pilih buku yang ingin dipinjam dan klik <strong>Pinjam</strong>.</li>
                        <li>Buku akan masuk ke <strong>Koleksi Saya</strong> dengan status <em>“proses peminjaman”</em>.</li>
                        <li>Datang langsung ke Perpustakaan untuk mengambil buku dan lapor kepada Petugas.</li>
                        <li>Petugas akan konfirmasi, dan status buku berubah menjadi <em>“dipinjam”</em>.</li>
                    </ol>
                </div>
                <div class="box" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h3>Koleksi Digital</h3>
                    <ol>
                        <li>Klik menu <strong>Koleksi Digital</strong>.</li>
                        <li>Pilih buku yang ingin dibaca.</li>
                        <li>Klik tombol <strong>Baca</strong>.</li>
                        <li>Kemudian buku akan masuk ke <strong>Koleksi saya</strong>.</li>
                        <li>Pembaca diberi 2 pilihan, yaitu membaca bukunya secara online atau offline (unduh).</li>
                        <li>Tidak perlu proses peminjaman atau pengembalian.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="info">
        <div class="info-text">
            <h3>PERPUSTAKAAN SMK NEGERI 1 DEPOK</h3>
            <p>Jl. Raya Tapos Gg. Bhakti Suci No. 100, Kelurahan Cimpaeun, Kecamatan Tapos, Kota Depok, Jawa Barat</p>
        </div>
    </section>
    <footer>
        <a href="https://www.instagram.com/officialsmkn1depok?igsh=ZG52azA5aG9wa2x5" target="_blank" class="button-prim">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.youtube.com/channel/UCmL4kX4wpl_op1FYizxO50g" target="_blank" class="button-sec">
            <i class="bi bi-youtube"></i>
        </a>
    </footer>
    <script>
    function confirmLogout() {
    return confirm("Apakah Anda yakin ingin log out?");
    }
    </script>
</body>
</html>
