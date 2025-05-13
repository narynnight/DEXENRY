<?php
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

// Proses update data anggota jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);

    $update = "UPDATE anggota SET 
                nama = '$nama',
                kelas = '$kelas',
                no_telp = '$no_telp'
                WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data anggota berhasil diperbarui!'); window.location.href='data_anggota.php';</script>";
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}

// Ambil data anggota untuk ditampilkan di form
if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    $sql = "SELECT * FROM anggota WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $sql);

    if ($data = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="style.css">
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
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            width: 500px;
            background: #fff;
            padding: 30px;
            margin-top: 50px;
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
        input[type="date"],
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
            background: #007BFF;
            color: #fff;
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
    </style>
</head>
<body>
<section class="content">
<div class="container">
    <h2>Edit Data Anggota</h2>
    <form method="POST" action="edit_anggota.php?nisn=<?= $nisn ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>

        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required>

        <label for="no_telp">Nomor Telepon</label>
        <input type="text" id="no_telp" name="no_telp" value="<?= htmlspecialchars($data['no_telp']); ?>" required>

        <button type="button" class="btn-back" onclick="window.location.href='data_anggota.php'">Back</button>
        <input type="submit" name="submit" value="Update">
    </form>
</div>
</section>
</body>
</html>
<?php
    } else {
        echo "Data tidak ditemukan!";
    }
} else {
    echo "NISN tidak diberikan.";
}
?>
