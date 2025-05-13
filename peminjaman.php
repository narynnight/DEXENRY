<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit();
}
require "config.php";

$sql = "SELECT p.*, a.nama AS nama_anggota, a.kelas AS kelas, b.judul AS judul_buku, b.penulis AS penulis, b.jenis AS jenis_buku
        FROM peminjaman p
        JOIN anggota a ON p.nisn = a.nisn
        JOIN buku b ON p.id_buku = b.id_buku
        ORDER BY p.tanggal_pinjam DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman - Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
    section {
        padding: 40px 20px;
        background-color: #f9f9f9;
        min-height: 100vh;
    }
    h2 {
        text-align: center;
        font-size: 2rem;
        color: #0D47A1;
        margin-bottom: 30px;
    }
    .loan-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }
    .loan-item {
        background-color: #ffffff;
        width: 320px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: left;
    }
    .loan-item p {
        margin: 10px 0;
        color: #333;
    }
    .loan-item strong {
        color: #0D47A1;
    }
    .loan-item button {
        padding: 8px 16px;
        background-color: #0D47A1;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .loan-item button:hover {
        background-color: #1565C0;
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
                    <li><a href="dashboard_admin.php">Home</a></li>
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
                </ul>
            </nav>
        </div>
    </div>
</header>

<section>
    <h2>Riwayat Peminjaman</h2>
    <div class="loan-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="loan-item">
                <p><strong>Anggota:</strong> <?= htmlspecialchars($row['nama_anggota']); ?></p>
                <p><strong>Kelas</strong> <?= htmlspecialchars($row['kelas']); ?></p>
                <p><strong>Buku:</strong> <?= htmlspecialchars($row['judul_buku']); ?></p>
                <p><strong>Penulis:</strong> <?= htmlspecialchars($row['penulis']); ?></p>
                <p><strong>Jenis:</strong> <?= ucfirst($row['jenis_buku']); ?></p>
                <p><strong>Tanggal Peminjaman:</strong> <?= $row['tanggal_pinjam']; ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($row['status']); ?></p>

                <?php if (strtolower(trim($row['jenis_buku'])) === 'cetak'): ?>
                <?php if (strtolower(trim($row['status'])) === 'proses peminjaman'): ?>
                <form method="post" action="konfirmasi_peminjaman.php">
                <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman']; ?>">
                <button type="submit">Konfirmasi Peminjaman</button>
                </form>
                <?php elseif (strtolower(trim($row['status'])) === 'dipinjam'): ?>
                <form method="post" action="action_pengembalian.php">
                <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman']; ?>">
                <button type="submit">Tandai Sudah Dikembalikan</button>
                </form>
                <?php else: ?>
                <p><em>Buku sudah dikembalikan.</em></p>
                <?php endif; ?>
                <?php else: ?>
                <p><em>Buku digital, dapat langsung dibaca tanpa proses peminjaman.</em></p>
                <?php endif; ?>
                </div>
        <?php endwhile; ?>
    </div>
</section>
</body>
</html>
