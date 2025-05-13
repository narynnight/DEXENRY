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
require "config.php";

$sql = "SELECT * FROM anggota";
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
  /* Background section transparan */
.container {
    max-width: 1400px;
    min-height: 100vh;
    padding: 60px 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column; /* Menyusun elemen secara vertikal */
    justify-content: flex-start; /* Untuk memastikan elemen dimulai dari atas */
    align-items: center; /* Tengah-tengah */
}

h1 {
    font-size: 28px;
    color: #fff;
    margin-bottom: 30px; /* Jarak ke bawah agar lebih rapi */
    text-align: center; /* Pastikan teks di tengah */
}

/* Tabel */
table {
    width: 60%;
    margin: 40px auto;
    border-collapse: collapse;
    background: #ffffff; /* Solid putih */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

/* Header tabel */
thead {
    background-color: #4a90e2;
    color: #ffffff;
}

thead th {
    padding: 14px 20px;
    text-align: left;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Isi tabel */
tbody td {
    padding: 12px 20px;
    border-bottom: 1px solid #dddddd;
    color: #333333;
}

/* Efek hover baris */
tbody tr:hover {
    background-color: rgba(74, 144, 226, 0.1); /* Biru tipis transparan */
    transition: background 0.3s ease;
}

/* Hilangkan border di baris terakhir */
tbody tr:last-child td {
    border-bottom: none;
} 

/* Link dalam tabel */
td a {
    text-decoration: none;
    color: #4a90e2;
    font-weight: 600;
    transition: color 0.3s ease;
}

td a:hover {
    color: #2c6ecb;
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
                        <!-- Dropdown Layanan -->
                        <li class="dropdown">
                            <a href="#">Data Pengguna</a>
                            <ul class="dropdown-content">
                            <li><a href="data_anggota.php">Anggota</a></li>
                            </ul>
                        </li>
                        <li><a href="peminjaman.php">Data Peminjaman</a></li>
                         <!-- Dropdown Koleksi -->
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
    <div class="container">
        <h1>DATA ANGGOTA DEXENRY</h1>
    <table>
        <thead>
            <tr>
                <th>NISN/NUPTK</th>
                <th>Nama Anggota</th>
                <th>Password</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Pendaftaran</th>
                <th>Aksi</th> 
            </tr>
        </thead>
        <tbody>
            <?php while($data = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?php echo $data['nisn']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['jenis_kelamin']; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td><?php echo $data['no_telp']; ?></td>
                    <td><?php echo $data['tgl_pendaftaran']; ?></td>
                    <td>
                        <a href="edit_anggota.php?nisn=<?php echo $data['nisn']; ?>">Edit</a> | 
                        <a href="delete_anggota.php?nisn=<?php echo $data['nisn']; ?>">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
            </div>
</body>
</html>