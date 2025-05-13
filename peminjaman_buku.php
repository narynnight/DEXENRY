<?php
session_start();
include('config.php');

if (!isset($_SESSION['signIn'])) {
    die("Harus login!");
}

$nisn = $_SESSION['signIn'];

$sql = "SELECT buku.*, peminjaman.status, peminjaman.tanggal_pinjam, peminjaman.id_peminjaman, peminjaman.tanggal_pengembalian
        FROM peminjaman 
        JOIN buku ON peminjaman.id_buku = buku.id_buku 
        WHERE peminjaman.nisn = '$nisn'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koleksi Saya</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #003366, #004080);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #fff;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-top: 40px;
        }

        table {
            width: 90%;
            max-width: 1100px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            color: #000;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #004080;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 8px;
        }

        button, .btn-back {
            background-color: #004080;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover, .btn-back:hover {
            background-color: #00264d;
        }
        .btn-baca, .btn-unduh {
            display: inline-block;
            background-color: #004080;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin: 5px 5px 0 0;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-baca:hover, .btn-unduh:hover {
            background-color: #00264d;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        form {
            display: inline-block;
            margin: 0 5px;
        }

        a {
            color: #004080;
            text-decoration: none;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Koleksi Saya</h2>
    <table>
    <tr>
        <th>Cover</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td>
        <?php
        $folder = ($row['jenis'] === 'digital') ? 'uploads_digital' : 'uploads'; ?>
        <img src="<?= $folder . '/' . $row['cover']; ?>" alt="<?= $row['judul']; ?>" width="100" height="150">
        </td>
        <td><?= $row['judul']; ?></td>
        <td><?= $row['penulis']; ?></td>
        <td><?= $row['tanggal_pinjam']; ?></td>
        <td><?= $row['status']; ?></td>
        <td>
        <?php if ($row['jenis'] === 'digital'): ?>
            <?php if ($row['status'] === 'dipinjam'): ?>
                <div class="action-buttons">
                    <a href="uploads_digital/<?= $row['file_pdf']; ?>" class="btn-baca" target="_blank">Baca</a>
                    <a href="uploads_digital/<?= $row['file_pdf']; ?>" class="btn-unduh" download>Unduh</a>
                </div>
            <?php else: ?>
                <p><em>Buku digital sudah dibaca.</em></p>
            <?php endif; ?>
        <?php elseif ($row['jenis'] === 'cetak'): ?>
            <?php if ($row['status'] === 'proses peminjaman'): ?>
                <p><em>Silakan ke Perpustakaan untuk konfirmasi peminjaman kepada petugas dan mengambil buku.</em></p>
            <?php elseif ($row['status'] === 'dipinjam'): ?>
                <p><em>Buku sedang dipinjam. Pengembalian akan dikonfirmasi oleh petugas perpustakaan.</em></p>
            <?php endif; ?>
        <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    </table>
    <div style="text-align:center;">
        <button type="button" onclick="window.location.href='dashboard.php'" class="btn-back">Kembali ke Dashboard</button>
    </div>
</div>
</body>
</html>
