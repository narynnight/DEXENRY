<?php
header('Content-Type: application/json');

// Koneksi database
$host = "localhost";
$user = "root";
$pass= "";
$db = "dexenry";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Koneksi database gagal."]));
}

// Ambil data kelas
$kelasQuery = "SELECT id_kelas, nama_kelas FROM kelas";
$kelasResult = $conn->query($kelasQuery);

$kelas = [];
while ($row = $kelasResult->fetch_assoc()) {
    $kelas[] = $row;
}

// Kirim data JSON
echo json_encode([
    "kelas" => $kelas,
]);

$conn->close();
?>
