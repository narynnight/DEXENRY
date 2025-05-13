<?php 
session_start();
require_once "config.php";

if(isset($_SESSION["signIn"])) {
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST["login"])) {
    $nama = strtolower(trim($_POST["nama"]));
    $nisn = trim($_POST["nisn"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM anggota WHERE nama = ? AND nisn = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nama, $nisn);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) === 1) {
            $pw = mysqli_fetch_assoc($result);
            if(password_verify($password, $pw["password"])) {
                $_SESSION["signIn"] = $pw["nisn"] ;
                $_SESSION["member"]["nama"] = $pw["nama"];
                $_SESSION["member"]["nisn"] = $pw["nisn"];
                echo '<script>
                    alert("Log In Berhasil, Selamat Datang di DEXENRY!");
                    window.location.href = "dashboard.php";
                </script>';
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Akun tidak ditemukan!";
        }
    }      
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png" />
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
    <h1 class="text-center fw-bold">Log In</h1>
    <hr />
    <form action="" method="post" class="needs-validation" novalidate>
      <!-- Nama -->
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          <input type="text" class="form-control" name="nama" id="nama" required />
          <div class="invalid-feedback">Nama wajib diisi!</div>
        </div>
      </div>

      <!-- NISN -->
      <div class="mb-3">
        <label for="nisn" class="form-label">NISN/NUPTK</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
          <input type="number" class="form-control" name="nisn" id="nisn" required />
          <div class="invalid-feedback">NISN wajib diisi!</div>
        </div>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
          <input type="password" class="form-control" name="password" id="password" required />
          <span class="input-group-text" onclick="togglePassword('password', this)">
            <i class="fa-solid fa-eye"></i>
          </span>
          <div class="invalid-feedback">Password wajib diisi!</div>
        </div>
      </div>

      <!-- Tombol -->
      <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-primary" type="submit" name="login">Log In</button>
        <a class="btn btn-success" href="home.php">Batal</a>
      </div>

      <p class="mt-3 text-center">
        Belum punya akun?
        <a href="register.php" class="text-decoration-none text-primary">Daftar</a>
      </p>

      <?php if(isset($error)) : ?>
        <div class="alert alert-danger mt-2" role="alert"><?php echo $error; ?></div>
      <?php endif; ?>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
