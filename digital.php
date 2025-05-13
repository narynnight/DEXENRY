<?php
session_start();
if (!isset($_SESSION['signIn'])) {
    header("Location: keanggotaan.php");
    exit;
}

include('config.php'); // Pastikan config.php ini koneksi database yang benar
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
$jenis = 'digital'; // Ganti ke 'cetak' untuk halaman koleksi fisik

if ($keyword) {
    $sql = "SELECT * FROM buku WHERE jenis = '$jenis' AND (
        judul LIKE '%$keyword%' OR
        penulis LIKE '%$keyword%' OR
        penerbit LIKE '%$keyword%' OR
        tahun_terbit LIKE '%$keyword%'
    )";
} else {
    $sql = "SELECT * FROM buku WHERE jenis = '$jenis'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOLEKSI DIGITAL - DEXENRY</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
         body {
            font-family: 'Arial', sans-serif;
        }

        .collection {
            padding: 40px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .collection h2 {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #0D47A1;
        }

        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        form input[type="text"] {
            padding: 10px;
            width: 60%;
            min-width: 250px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            padding: 10px 20px;
            background-color: #0D47A1;
            color: white;
            border: none;
            border-radius: 5px;
        }

        form button:hover {
            background-color: #1565C0;
            cursor: pointer;
        }

        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .book-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 180px;
            transition: transform 0.3s ease;
            overflow: hidden;
            text-align: center;
        }

        .book-item a {
            text-decoration: none;
            color: inherit;
        }

        .book-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .book-item h3 {
            font-size: 1rem;
            padding: 10px;
            color: #333;
        }

        .book-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
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
                    <li><a href="dashboard.php">HOME</a></li>
                    <li class="dropdown">
                        <a href="#">KOLEKSI</a>
                        <ul class="dropdown-content">
                            <li><a href="digital.php">Koleksi Digital</a></li>
                            <li><a href="cetak.php">Koleksi Fisik</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<section class="collection">
    <div class="collection-container">
    <h2>KOLEKSI DIGITAL DEXENRY</h2>
    <form method="GET">
        <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Cari berdasarkan judul, penulis, penerbit, atau tahun...">
        <button type="submit">Cari</button>
    </form>

    <div class="book-list">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="book-item">
                    <a href="<?php echo $jenis == 'digital' ? 'detail_buku_digital.php' : 'detail_buku_cetak.php'; ?>?id_buku=<?php echo $row['id_buku']; ?>">
                        <img src="<?php echo $jenis == 'digital' ? 'uploads_digital' : 'uploads'; ?>/<?php echo $row['cover']; ?>" alt="<?php echo $row['judul']; ?>">
                        <h3><?php echo $row['judul']; ?></h3>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="width: 100%; text-align: center; color: #888;">Tidak ada hasil ditemukan untuk pencarian.</p>
        <?php endif; ?>
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

</body>
</html>
