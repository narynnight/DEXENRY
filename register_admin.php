<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <link rel="shortcut icon" href="https://smkn1depok.sch.id/img/logo/logo.png">
    <style>
        /* * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        } */

        body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative; /* Agar pseudo-element bekerja */
    }

        body::before {
            content: ""; /* Wajib untuk pseudo-element */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('wandek.jpg'); /* Pastikan path gambar benar */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: brightness(40%); /* Efek transparan hitam */
            z-index: -2; /* Supaya tidak menutupi elemen lain */
        }

        body::after {
            content: ""; 
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Lapisan hitam transparan */
            z-index: -1; /* Supaya tetap di belakang form */
        }

        /* Container Login */
.container {
    background: rgba(255, 255, 255, 0.9); /* Background putih transparan */
    padding: 30px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

h1 {
    font-size: 28px;
    color: #150E3E;
    margin-bottom: 20px; /* Tambahkan jarak ke bawah */
    display: block; /* Pastikan elemen tidak sejajar dengan input */
}

/* Input Box */
.inputBox {
    margin-bottom: 15px;
    text-align: left;
}

.inputBox label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.inputBox input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    transition: 0.3s;
}

/* Efek saat input di klik */
.inputBox input:focus {
    border-color: #150E3E;
    outline: none;
    box-shadow: 0px 0px 5px rgba(21, 14, 62, 0.5);
}

/* Tombol Regist */
.submitRegist input {
    width: 100%;
    padding: 10px;
    background: #150E3E;
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.submitRegist input:hover {
    background: #4A4E69;
}

/* Responsive */
@media (max-width: 400px) {
    .container {
        width: 90%;
        padding: 20px;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <h1>FORM REGISTER ADMIN</h1>
        <div class="flex-container">
            <form method="post" action="action_registeradmin.php">
                <div class="inputBox">
                   <label for="nama">Nama Lengkap:</label>
                   <input type="text" name="nama_admin" placeholder="Enter Your Fullname" required>
                </div>
                <div class="inputBox">
                   <label for="no_telp">Nomor Telepon:</label>
                   <input type="text" name="no_telp" placeholder="Enter Your Number Phone" required>
                </div>
                <div class="inputBox">
                   <label for="nama">Password:</label>
                   <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="inputBox">
                   <label for="nama">Konfirmasi Password:</label>
                   <input type="password" name="konfirmasi_password" placeholder="Confirm Your Password" required>
                </div>

                <div class="submitRegist">
                <input type="submit" value="REGIST">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
