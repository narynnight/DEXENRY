<?php
session_start();

// Hapus hanya session login admin
unset($_SESSION['id_admin']);

// Hapus cache agar tidak bisa kembali dengan tombol "Back"
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect ke home.php
header("Location: home.php");
exit;
?>
