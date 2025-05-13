<?php
// Memulai sesi
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit();
}

// Mencegah halaman di-cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include('config.php');

// Proses pencarian
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
if ($keyword) {
    $sql = "SELECT * FROM buku 
            WHERE jenis = 'digital' 
            AND (
                judul LIKE '%$keyword%' OR 
                penulis LIKE '%$keyword%' OR 
                penerbit LIKE '%$keyword%' OR 
                tahun_terbit LIKE '%$keyword%'
            )
            ORDER BY judul ASC";
} else {
    $sql = "SELECT * FROM buku WHERE jenis = 'digital' ORDER BY judul ASC";
}
$result = mysqli_query($conn, $sql);
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
       .kosong {
           max-width: 1400px;
           min-height: 15vh;
           padding: 60px 0;
           background: rgba(0, 0, 0, 0.7);
           display: flex;
           flex-direction: column;
           justify-content: flex-start;
           align-items: center;
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
       .search-form {
           margin: 20px auto;
           display: flex;
           justify-content: center;
           align-items: center;
           gap: 10px;
           max-width: 600px;
       }
       .search-form input[type="text"] {
           width: 70%;
           padding: 10px 15px;
           border: 1px solid #ccc;
           border-radius: 5px;
           font-size: 14px;
       }
       .search-form button {
           background-color: #0D47A1;
           color: white;
           border: none;
           padding: 10px 15px;
           font-size: 14px;
           border-radius: 5px;
           cursor: pointer;
           display: flex;
           align-items: center;
           gap: 5px;
       }
       .search-form button:hover {
           background-color: #f39c12;
       }
       .book-list {
           display: flex;
           flex-wrap: wrap;
           justify-content: center;
           gap: 20px;
           padding-top:30px;
       }
       .book-item {
           background-color: #ffffff;
           border-radius: 10px;
           box-shadow: 0 4px 8px rgba(0,0,0,0.1);
           width: 180px;
           transition: transform 0.3s ease;
           overflow: hidden;
           text-align: center;
           position: relative;
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
       .book-item .admin-controls {
           position: absolute;
           top: 10px;
           right: 10px;
           background: rgba(0, 0, 0, 0.5);
           padding: 5px;
           border-radius: 50%;
           display: flex;
           gap: 5px;
       }
       .book-item .admin-controls a {
           color: white;
           font-size: 14px;
           text-decoration: none;
       }
       .book-item .admin-controls a:hover {
           color: #f39c12;
       }
       .add-book-btn {
           background-color: #0D47A1;
           margin-bottom: 20px;
           color: white;
           padding: 10px 20px;
           border: none;
           border-radius: 5px;
           cursor: pointer;
           text-decoration: none;
           font-size: 16px;
       }
       .add-book-btn:hover {
           background-color: #f39c12;
       }
       .info {
           padding: 40px 20px;
           background-color: #0D47A1;
           color: white;
           text-align: center;
       }
       .info-text h3 {
           font-size: 1.5rem;
           margin-bottom: 10px;
       }
       .info-text p {
           font-size: 1rem;
           line-height: 1.6;
       }
       footer {
           display: flex;
           justify-content: center;
           gap: 20px;
           background-color: rgba(51, 51, 51, 0.8);
           padding: 20px 0;
       }
       footer .button-prim,
       footer .button-sec {
           color: white;
           font-size: 24px;
           transition: color 0.3s;
       }
       footer .button-prim:hover,
       footer .button-sec:hover {
           color: #f39c12;
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

<section class="collection">
    <h2>KOLEKSI DIGITAL DEXENRY</h2>
    <form method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="Cari judul, penulis, penerbit, atau tahun terbit..." value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit"><i class="bi bi-search"></i> Cari</button>
    </form>

    <a href="tambah_bukudigital.php" class="add-book-btn">Tambah Buku Baru</a>

    <div class="book-list">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="book-item <?php echo $row['jenis']; ?>">
                    <a href="#">
                        <img src="uploads_digital/<?php echo $row['cover']; ?>" alt="Cover Buku">
                        <h3><?php echo $row['judul']; ?></h3>
                        <p class="info"><?php echo $row['penulis']; ?> | <?php echo $row['tahun_terbit']; ?></p>
                        <span class="jenis"><?php echo ucfirst($row['jenis']); ?></span>
                    </a>
                    <div class="admin-controls">
                        <a href="edit_bukudigital.php?id_buku=<?php echo $row['id_buku']; ?>" title="Edit Buku"><i class="bi bi-pencil-square"></i></a>
                        <a href="hapus_bukudigital.php?id_buku=<?php echo $row['id_buku']; ?>" title="Hapus Buku" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada buku yang ditemukan untuk keyword "<strong><?php echo htmlspecialchars($keyword); ?></strong>".</p>
        <?php endif; ?>
    </div>
</section>
<section class="kosong"></section>
</body>
</html>
