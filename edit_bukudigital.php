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
// Koneksi ke database
include('config.php');

// Cek jika ada ID buku yang dikirimkan
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Query untuk mengambil data buku berdasarkan ID
    $sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    $buku = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$buku) {
        die("Buku tidak ditemukan!");
    }

    // Proses update jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $kategori = $_POST['kategori'];

        // Cek jika ada file cover baru
        if (!empty($_FILES['cover']['name'])) {
            $cover = $_FILES['cover']['name'];
            $target_dir = "uploads_digital/";
            $target_file = $target_dir . basename($cover);
            move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
        } else {
            $cover = $buku['cover'];
        }

        // Query untuk mengupdate data buku
        $sql_update = "UPDATE buku SET 
                        judul = '$judul',
                        penulis = '$penulis',
                        penerbit = '$penerbit',
                        tahun_terbit = '$tahun_terbit',
                        cover = '$cover',
                        kategori = '$kategori'
                        WHERE id_buku = '$id_buku'";

        if (mysqli_query($conn, $sql_update)) {
            echo "<script>alert('Buku berhasil diperbarui!'); window.location.href='data_bukudigital.php';</script>";
        } else {
            echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
        }
    }
} else {
    echo "ID Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('wandek.jpg'); /* Pastikan path gambar benar */
            background-size: 100% auto; /* Lebar 100% dan tinggi mengikuti */
            background-position: center top; /* Posisi gambar tetap di tengah */
            background-repeat: no-repeat; /* Supaya gambar tidak berulang */
            background-attachment: fixed;
            overflow-x: hidden; /* Mencegah scroll horizontal */
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
        input[type="text"], input[type="number"], input[type="file"], textarea {
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
            background: #007BFF;
            color: #fff;
            padding-top: 10px;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .current-cover {
            text-align: center;
            margin-bottom: 15px;
        }
        .current-cover img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<section class="content">
<div class="container">
    <h2>Edit Data Buku</h2>
    <form action="edit_buku.php?id_buku=<?php echo $id_buku; ?>" method="post" enctype="multipart/form-data">
        
        <label for="judul">Judul Buku</label>
        <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>

        <label for="penulis">Penulis</label>
        <input type="text" id="penulis" name="penulis" value="<?php echo htmlspecialchars($buku['penulis']); ?>" required>

        <label for="penerbit">Penerbit</label>
        <input type="text" id="penerbit" name="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>" required>

        <label for="tahun_terbit">Tahun Terbit</label>
        <input type="number" id="tahun_terbit" name="tahun_terbit" value="<?php echo htmlspecialchars($buku['tahun_terbit']); ?>" required>

        <label for="kategori">Kategori</label>
        <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($buku['kategori']); ?>" required>

        <div class="current-cover">
            <p>Cover Saat Ini:</p>
            <img src="uploads_digital/<?php echo htmlspecialchars($buku['cover']); ?>" alt="Cover Buku">
        </div>

        <label for="cover">Ganti Cover Baru (Opsional)</label>
        <input type="file" id="cover" name="cover">

        <button type="button" onclick="window.location.href='data_bukudigital.php'" class="btn-back">Back</button>
        <input type="submit" value="Update Buku">

    </form>
</div>
    </section>
</body>
</html>
