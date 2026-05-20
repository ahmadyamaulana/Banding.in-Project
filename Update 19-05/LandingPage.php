<?php
session_start();

// Cek login
if (!isset($_SESSION['nama'])) {
    header("Location: Login.php");
    exit();
}

// Hubungkan ke database untuk mengambil daftar toko milik user ini
$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");
$nama_user = $_SESSION['nama'];
$query = "SELECT * FROM toko WHERE nama_user = '$nama_user' ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banding.in - Dashboard</title>
    <link rel="stylesheet" href="styleLandingpage.css?v=<?php echo time(); ?>">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <div class="logo-box">in</div>
            <a href="LandingPage.php">Banding.in</a>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <span>Halo, <b><?php echo htmlspecialchars($_SESSION['nama']); ?></b></span>
            <a href="logout.php" style="padding: 8px 16px; background-color: #ff4d4d; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 14px;">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="sidebar">
            <a href="LandingPage.php">Dashboard</a>
            <a href="promo.php">Promo & Banding</a>
            <a href="profile.php">Profile</a> 
        </div>

        <div class="content">
            <h2 style="margin-bottom: 25px; color: #1e1e1e;">Daftar Toko Anda</h2>
            
            <div class="card-container" id="wadahToko">
                
                <?php 
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="promo.php" class="card card-toko">' . htmlspecialchars($row['nama_toko']) . '</a>';
                    }
                }
                ?>

                <div class="card btn-tambah" id="tombolTambah">
                    <div style="font-size: 24px; color: #0a66c2; margin-bottom: 5px;">+</div>
                    <div>Tambah Toko</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="popupToko">
        <div class="modal-content">
            <h3>Tambah Toko Baru</h3>
            <input type="text" id="inputNamaToko" placeholder="Masukkan nama toko...">
            <div class="modal-buttons">
                <button class="btn-batal" id="btnBatal">Batal</button>
                <button class="btn-konfirmasi" id="btnKonfirmasi">Konfirmasi</button>
            </div>
        </div>
    </div>

    <script src="landingpage.js?v=<?php echo time(); ?>"></script>
</body>
</html>