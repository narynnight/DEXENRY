<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $cover = $_FILES['cover']['name'];

    // Upload Cover Image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($cover);
    move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);

    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, cover, jenis) 
            VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$cover', 'cetak')";

    if (mysqli_query($conn, $sql)) {
        echo "Buku berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!-- HTML untuk form tambah buku -->
<form action="tambah_buku.php" method="post" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Judul Buku" required><br>
    <input type="text" name="penulis" placeholder="Penulis" required><br>
    <input type="text" name="penerbit" placeholder="Penerbit" required><br>
    <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required><br>
    <input type="file" name="cover" required><br>
    <button type="submit">Tambah Buku</button>
</form>
