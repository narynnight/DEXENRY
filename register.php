<?php
require 'config.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $tgl = date('Y-m-d H:i:s');
    $password = $_POST['pass'];
    $konfirmpassword = $_POST['repeatpass'];
    

    // Validasi input
    if ($password !== $konfirmpassword) {
        die("Password dan Konfirmasi Password tidak cocok.");
    }

    // Periksa apakah username sudah digunakan
    $sql = "SELECT * FROM anggota WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        die("NISN sudah terdaftar.");
    }

    // Hash password sebelum menyimpannya
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO anggota (nama, nisn, kelas, no_telp, jenis_kelamin, tgl_pendaftaran, password) VALUES 
    ('$nama', '$nisn', '$kelas', '$no_telp', '$jenis_kelamin', '$tgl', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
            alert("Registrasi berhasil. Silakan login.");
            window.location.href = "login.php";
        </script>';
    } else {
        die("Gagal menyimpan data: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/de8de52639.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="shortcut icon"
      href="https://smkn1depok.sch.id/img/logo/logo.png"
    />
    <title>Registrasi</title>
    <style>
      body {
        background-color: #f8f9fa;
      }
      .container {
        max-width: 600px;
      }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center fw-bold">Register</h1>
      <hr />
      <form action="" method="post" class="needs-validation" novalidate>
        <!-- NISN -->
        <div class="mb-3">
          <label for="nisn" class="form-label">NISN/NUPTK</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
            <input
              type="number"
              class="form-control"
              name="nisn"
              id="nisn"
              required
            />
            <div class="invalid-feedback">NISN/NUPTK wajib diisi!</div>
          </div>
        </div>

        <!-- Nama -->
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <input
              type="text"
              class="form-control"
              name="nama"
              id="nama"
              required
            />
            <div class="invalid-feedback">Nama wajib diisi!</div>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input
              type="password"
              class="form-control"
              id="pass"
              name="pass"
              required
            />
            <span class="input-group-text" onclick="togglePassword('pass', this)">
              <i class="fa-solid fa-eye"></i>
            </span>
            <div class="invalid-feedback">Password wajib diisi!</div>
          </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
          <label for="repeatpass" class="form-label">Konfirmasi Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input
              type="password"
              class="form-control"
              id="repeatpass"
              name="repeatpass"
              required
            />
            <span class="input-group-text" onclick="togglePassword('repeatpass', this)">
              <i class="fa-solid fa-eye"></i>
            </span>
            <div class="invalid-feedback">Konfirmasi password wajib diisi!</div>
          </div>
        </div>

        <!-- Gender -->
        <div class="mb-3">
          <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
          <select
            class="form-select"
            id="jenis_kelamin"
            name="jenis_kelamin"
            required
          >
            <option selected disabled value="">Pilih</option>
            <option value="Laki laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          <div class="invalid-feedback">Silakan pilih jenis kelamin.</div>
        </div>

        <!-- Kelas -->
        <div class="mb-3">
          <label for="kelas" class="form-label">Kelas</label>
          <input
            type="text"
            class="form-control"
            id="kelas"
            name="kelas"
          />
          <div class="invalid-feedback">Kelas wajib diisi!</div>
        </div>

        <!-- No Telepon -->
        <div class="mb-3">
          <label for="no_telp" class="form-label">No Telepon</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
            <input
              type="number"
              class="form-control"
              name="no_telp"
              id="no_telp"
              required
            />
            <div class="invalid-feedback">No telepon wajib diisi!</div>
          </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-between align-items-center">
          <button class="btn btn-primary" type="submit" name="register">
            Register
          </button>
          <a class="btn btn-success" href="home.php">Batal</a>
        </div>

        <p class="mt-3 text-center">
          Sudah punya akun?
          <a href="login.php" class="text-decoration-none text-primary"
            >Log In</a
          >
        </p>
      </form>
    </div>

    <script>
      (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach((form) => {
          form.addEventListener(
            'submit',
            (event) => {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            },
            false
          );
        });
      })();

      function togglePassword(id, el) {
        const input = document.getElementById(id);
        const icon = el.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      }
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
