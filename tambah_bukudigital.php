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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    move_uploaded_file($cover_tmp, "uploads_digital/$cover");

    $file_pdf = $_FILES['file_pdf']['name'];
    $file_tmp = $_FILES['file_pdf']['tmp_name'];
    move_uploaded_file($file_tmp, "uploads_digital/$file_pdf");

    $sql = "INSERT INTO buku (kategori, judul, penulis, penerbit, tahun_terbit, cover, jenis, file_pdf)
            VALUES ('$kategori', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$cover', 'digital', '$file_pdf')";
    mysqli_query($conn, $sql);
    header("Location: data_bukudigital.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Buku</title>
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('wandek.jpg');
            background-size: 100% auto;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow-x: hidden;
        }

        .content {
            max-width: 1400px;
            min-height: 100vh;
            padding: 60px 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .container {
            width: 500px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .btn-back {
            width: 100%;
            background: #6c757d;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-bottom: 10px;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        input[type="submit"] {
            width: 100%;
            background: #150E3E;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #4A4E69;
        }
    </style>
</head>
<body>
<section class="content">
    <div class="container">
        <h2>Input Buku Digital</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul Buku" required><br>
            <input type="text" name="penulis" placeholder="Penulis" required><br>
            <input type="text" name="penerbit" placeholder="Penerbit" required><br>
            <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required><br>
            <select name="kategori" id="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php
                $result_kategori = mysqli_query($conn, "SELECT * FROM kategori");
                while ($row = mysqli_fetch_assoc($result_kategori)) {
                    echo "<option value='" . $row['kategori'] . "'>" . $row['kategori'] . "</option>";
                }
                ?>
            </select>
            <label>Upload Cover:</label>
            <input type="file" name="cover" required><br>
            <label>Upload File PDF:</label>
            <input type="file" name="file_pdf" required><br>
            
            <button type="button" onclick="window.location.href='data_bukudigital.php'" class="btn-back">Back</button>
            <input type="submit" value="Input Buku">
        </form>
    </div>
</section>
</body>
</html>
