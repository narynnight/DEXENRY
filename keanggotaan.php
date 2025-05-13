<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Keanggotaan</title>
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('wandek.jpg'); /* Ganti dengan path foto sekolahmu */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(40%);
            z-index: -2;
        }

        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .wrapper {
            display: flex;
            width: 80%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .section {
            flex: 1;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .left {
            background-color: rgba(21, 14, 62, 0.9);
            color: white;
        }

        .right {
            background-color: #ffffff;
            color: #333;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            margin-bottom: 20px;
            font-size: 15px;
        }

                .button {
            display: inline-block;
            min-width: 160px;
            padding: 12px 24px;
            background: #f39c12;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
            align-self: center; /* untuk posisi di tengah */
            margin-top: 30px;
        }


        .button:hover {
            background: #d68910;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- SECTION REGISTER -->
        <div class="section left">
            <h2>Pendaftaran Keanggotaan</h2>
            <p>Gabung menjadi anggota DEXENRY untuk dapat mengakses informasi mengenai koleksi buku fisik maupun digital di SMKN 1 Depok.</p>
            <p><strong>Syarat:</strong> Siswa atau Guru di SMKN 1 Depok, memiliki NISN/NUPTK, dan data diri lengkap.</p>
            <a href="register.php" class="button">Daftar Sekarang</a>
        </div>

        <!-- SECTION LOGIN -->
        <div class="section right">
            <h2>Sudah Punya Akun?</h2>
            <p>Silakan login terlebih dahulu sebelum meminjam buku, melihat riwayat, dan mengakses koleksi fisik maupun digital kami.</p>
            <a href="login.php" class="button">Login di Sini</a>
        </div>
    </div>

</body>
</html>
