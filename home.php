<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SMKN 1 Depok</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".card");
        const popupContainer = document.createElement("div");
        popupContainer.classList.add("popup-container");
        document.body.appendChild(popupContainer);

        const overlay = document.createElement("div");
        overlay.classList.add("popup-overlay");
        document.body.appendChild(overlay);

        const scrollContent = document.querySelector(".scroll-content");

        cards.forEach((card) => {
            card.addEventListener("click", function () {
                const title = this.querySelector(".card-text").innerText;
                const imgSrc = this.querySelector("img").src;

                popupContainer.innerHTML = `
                    <h3>${title}</h3>
                    <img src="${imgSrc}" width="100%" height="150px" style="border-radius: 10px;">
                    <p>Jurusan ini memiliki banyak peluang karir di masa depan!</p>
                    <button onclick="closePopup()">Tutup</button>
                `;

                popupContainer.style.display = "block";
                overlay.style.display = "block";

                // Tambahkan class untuk menghentikan scroll
                scrollContent.classList.add("paused");

                history.pushState(null, null, location.href);
                window.onpopstate = function () {
                    history.go(1);
                };
            });
        });

        window.closePopup = function () {
            popupContainer.style.display = "none";
            overlay.style.display = "none";

            // Hapus class agar animasi berjalan lagi
            scrollContent.classList.remove("paused");
        };

        overlay.addEventListener("click", closePopup);
    });

</script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo" style="width: 50%">
                <img src="erasebg-transformed.png" alt="Logo">
            </div>
            <div style="width: 50%">
            <nav>
    <ul>
        <li><a href="home.php">HOME</a></li>

        <!-- Dropdown Layanan -->
        <li class="dropdown">
            <a href="#">LAYANAN</a>
            <ul class="dropdown-content">
                <li><a href="keanggotaan.php">Keanggotaan</a></li>
                <li><a href="login_admin.php">Kelola</a></li>
            </ul>
        </li>

        <!-- Dropdown Koleksi -->
        <li class="dropdown">
            <a href="#">KOLEKSI</a>
            <ul class="dropdown-content">
                <li><a href="digital.php">Koleksi Digital</a></li>
                <li><a href="cetak.php">Koleksi Fisik</a></li>
            </ul>
        </li>
    </ul>
</nav>
            </div>
        </div>
    </header>

    <section class="hero">
    <div class="overlay">
        <h2>WELCOME TO SMK NEGERI 1 DEPOK</h2>
        <p>6 Jurusan di SMKN 1 Depok yang siap membangun masa depan!</p>
    </div>
    <div class="scroll-content">
            <!-- Duplikat konten agar looping seamless -->
            <div class="card">
                <img src="Emblem PPLG.png" alt="PPLG">
                <div class="card-text">Pengembangan Perangkat Lunak <br> dan Gim</div>
            </div>
            <div class="card">
                <img src="logodkv.jpg" alt="DKV">
                <div class="card-text">Desain Komunikasi <br> Visual</div>
            </div>
            <div class="card">
                <img src="logoaph.png" alt="APH">
                <div class="card-text">Akomodasi <br> Perhotelan</div>
            </div>
            <div class="card">
                <img src="logoakl.png" alt="AKL">
                <div class="card-text">Akuntansi dan Keuangan <br> Lembaga</div>
            </div>
            <div class="card">
                <img src="logotbsm.png" alt="TBSM">
                <div class="card-text">Teknik Bisnis <br> Sepeda Motor Otomotif</div>
            </div>
            <div class="card">
                <img src="logotkro.png" alt="TKR">
                <div class="card-text">Teknik Kendaraan <br> Ringan Otomotif</div>
            </div>

            <!-- Duplikasi agar animasi seamless -->
            <div class="card">
                <img src="Emblem PPLG.png" alt="PPLG">
                <div class="card-text">Pengembangan Perangkat Lunak <br> dan Gim</div>
            </div>
            <div class="card">
                <img src="logodkv.jpg" alt="DKV">
                <div class="card-text">Desain Komunikasi <br> Visual</div>
            </div>
            <div class="card">
                <img src="logoaph.png" alt="APH">
                <div class="card-text">Akomodasi <br> Perhotelan</div>
            </div>
            <div class="card">
                <img src="logoakl.png" alt="AKL">
                <div class="card-text">Akuntansi dan Keuangan <br> Lembaga</div>
            </div>
            <div class="card">
                <img src="logotbsm.png" alt="TBSM">
                <div class="card-text">Teknik Bisnis <br> Sepeda Motor Otomotif</div>
            </div>
            <div class="card">
                <img src="logotkro.png" alt="TKR">
                <div class="card-text">Teknik Kendaraan <br> Ringan Otomotif</div>
            </div>
    </div>
</section>


    <section class="info">
        <div class="info-text">
        <h3>PERPUSTAKAAN SMK NEGERI 1 DEPOK</h3>
        <p>Jl. Raya Tapos Gg. Bhakti Suci No. 100, Kelurahan Cimpaeun, Kecamatan Tapos, Kota Depok, Jawa Barat</p>
        </div>
    </section>


    <footer>
    <a href="https://www.instagram.com/officialsmkn1depok?igsh=ZG52azA5aG9wa2x5" target="_blank" class="button-prim">
                    <i class="bi bi-instagram"></i>
    <a href="https://www.youtube.com/channel/UCmL4kX4wpl_op1FYizxO50g" target="_blank" class="button-sec">
                    <i class="bi bi-youtube"></i>
    </footer>
    
</body>
</html>
