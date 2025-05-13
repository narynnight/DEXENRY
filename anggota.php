<?php
require_once "config.php";

class Anggota {
    public $nisn;
    public $nama;
    public $password;
    public $jenis_kelamin;
    public $kelas;
    public $no_telp;
    public $tgl_pendaftaran;
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function read() {
        $query = "SELECT * FROM anggota";
        return $this->db->query($query);
    }

    public function delete($nisn) {
        $query = "DELETE FROM anggota WHERE nisn = ?";
        
        // Menggunakan prepared statement untuk keamanan
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die("Error dalam prepared statement: " . $this->db->conn->error);
        }
        $stmt->bind_param("s", $nisn); // "s" untuk tipe data string atau varchar
        return $stmt->execute();
    }
}
?>