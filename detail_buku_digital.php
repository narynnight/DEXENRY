<?php
session_start(); // WAJIB untuk mengakses session
include('config.php'); // File koneksi ke database

if (isset($_GET['id_buku'])) {
    $id_buku = (int) $_GET['id_buku'];
    $sql = "SELECT * FROM buku WHERE id_buku = $id_buku";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Data buku tidak ditemukan di database.");
    }

} else {
    echo "Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <link rel="stylesheet" href="style.css">
    <style>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.content {
    max-width: 1400px;
    min-height: 100vh;
    padding: 60px 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column; /* Menyusun elemen secara vertikal */
    justify-content: flex-start; /* Untuk memastikan elemen dimulai dari atas */
    align-items: center; /* Tengah-tengah */
}

.container {
            width: 500px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #003366;
}

.book-detail {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 20px;
}

.book-detail img {
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    width: 200px;
    height: auto;
}

.book-detail h2 {
    font-size: 28px;
    color: #222;
}

.book-detail p {
    font-size: 16px;
    line-height: 1.6;
    margin: 5px 0;
}

/* Tombol Pinjam */
.book-detail button {
    background-color: #003366;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.book-detail button:hover {
    background-color: #0055aa;
}

ul, li {
    text-decoration: none;
}

a {
    color: #003366;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>


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

                    <!-- Dropdown Koleksi -->
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

<section class="content">
    <div class="container">
        <h1>Detail Buku</h1>
        <div class="book-detail">
            <img src="uploads_digital/<?php echo htmlspecialchars($row['cover']); ?>" alt="Cover Buku" width="200" height="300">
            <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
            <p><strong>Penulis:</strong> <?php echo htmlspecialchars($row['penulis']); ?></p>
            <p><strong>Penerbit:</strong> <?php echo htmlspecialchars($row['penerbit']); ?></p>
            <p><strong>Tahun Terbit:</strong> <?php echo $row['tahun_terbit']; ?></p>
            <p><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></p>

            <?php if (!empty($_SESSION['signIn'])): ?>
                <form action="pinjam_digital.php" method="post">
                    <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                    <button type="submit">Baca</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Login dulu untuk meminjam</a></p>
            <?php endif; ?>
        </div>
    </div>
</section>
</body>
</html>
