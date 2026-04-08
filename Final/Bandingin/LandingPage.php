<?php
session_start();
$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Pengguna';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Banding.in</title>
<link rel="stylesheet" href="styleLandingpage.css">
</head>

<body>

<nav class="navbar">
        <div class="logo">
            <div class="logo-box">in</div>
            <a href="LandingPage.php">Banding.in</a>
        </div>
</nav>

<div class="container">
    <aside class="sidebar">
        <a href="LandingPage.php">Home</a>
        <a href="Login.php">Logout</a>
    </aside>

    <main class="content">
        <h2 style="margin-bottom: 20px;">Selamat datang, <?php echo $nama_user; ?>!</h2>
        <div class="card-container">
            <a href="promo.php" class="card">Promo Barang</a>
            <a href="#" class="card">Nyicil vs Nabung</a>
            <a href="Waktuvsharga.php" class="card">Waktu apa Harga?</a>
        </div>
    </main>
</div>
<script src="landingpage.js"></script>
</body>
</html>