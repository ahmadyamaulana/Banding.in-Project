<?php
session_start();

// Cek login
if (!isset($_SESSION['nama'])) {
    header("Location: Login.php");
    exit();
}

$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");
$nama_user = $_SESSION['nama'];

// 1. Ambil info email & foto profil user
$query_user = "SELECT email, foto_profil FROM users WHERE nama = '$nama_user' LIMIT 1";
$result_user = mysqli_query($koneksi, $query_user);
$email_user = "email@tidakditemukan.com";
$foto_profil = "";

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $email_user = $row_user['email'];
    $foto_profil = $row_user['foto_profil'];
}

// 2. Ambil produk yang disimpan oleh user ini
$query_produk = "SELECT * FROM produk_tersimpan WHERE nama_user = '$nama_user' ORDER BY id DESC";
$result_produk = mysqli_query($koneksi, $query_produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banding.in - Profile</title>
    <link rel="stylesheet" href="styleLandingpage.css?v=<?php echo time(); ?>">
    <style>
        .profile-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        /* GAYA BARU UNTUK KOTAK AVATAR AGAR BISA DIKLIK */
        .avatar-box {
            width: 100px;
            height: 100px;
            background: #e0e0e0;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: #777;
            position: relative;
            cursor: pointer; /* Kursor berubah jadi tangan */
            overflow: hidden; /* Agar efek hover tetap bulat */
            border: 3px solid #0a66c2;
        }
        /* Tulisan "Ubah" yang muncul saat disorot mouse */
        .avatar-box .overlay-edit {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            width: 100%;
            text-align: center;
            font-size: 13px;
            padding: 8px 0;
            display: none;
            font-weight: bold;
        }
        .avatar-box:hover .overlay-edit {
            display: block;
        }
        
        .profile-info h3 { font-size: 24px; color: #1e1e1e; margin-bottom: 5px; }
        .profile-info p { color: #666; font-size: 14px; }
        
        /* ... Gaya grid dan card untuk produk tetap sama ... */
        .saved-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px; }
        .saved-card { background: white; border-radius: 25px; padding: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.08); display: flex; flex-direction: column; align-items: center; text-align: center; }
        .saved-card img { width: 100%; height: 130px; object-fit: cover; border-radius: 15px; background: #f5f5f5; margin-bottom: 15px; }
        .saved-card .placeholder-img { width: 100%; height: 130px; background: #f0f0f0; border-radius: 15px; display: flex; justify-content: center; align-items: center; color: #aaa; font-size: 13px; margin-bottom: 15px; }
        .saved-card h4 { font-size: 16px; margin-bottom: 8px; color: #222; }
        .txt-toko { font-size: 11px; color: #666; background: #e8f0fe; padding: 3px 10px; border-radius: 10px; margin-bottom: 8px; font-weight: 600; }
        .txt-diskon { color: #ff4d4d; font-weight: bold; font-size: 13px; margin-bottom: 4px; }
        .txt-harga-awal { text-decoration: line-through; color: #999; font-size: 12px; margin-bottom: 4px; }
        .txt-harga-akhir { color: #0a66c2; font-weight: bold; font-size: 16px; }
        .btn-hapus { background: #ff4d4d; color: white; border: none; padding: 8px; width: 100%; border-radius: 10px; margin-top: 15px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .btn-hapus:hover { background: #e60000; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
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
            <a href="profile.php" style="font-weight: bold; color: white;">Profile</a>
            
        </div>

        <div class="content" style="overflow-y: auto;">
            
            <div class="profile-section">
                <div class="avatar-box" onclick="document.getElementById('inputFotoProfil').click()" title="Klik untuk ubah foto">
                    
                    <?php if (!empty($foto_profil)): ?>
                        <img id="previewFoto" src="<?php echo $foto_profil; ?>" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                        <span id="inisialFoto" style="display:none;"></span>
                    <?php else: ?>
                        <img id="previewFoto" src="" alt="Foto Profil" style="display:none; width: 100%; height: 100%; object-fit: cover;">
                        <span id="inisialFoto"></span>
                    <?php endif; ?>
                    
                    <div class="overlay-edit">Ubah Foto</div>
                </div>
                <input type="file" id="inputFotoProfil" accept="image/*" style="display: none;" onchange="uploadFotoProfil(this)">

                <div class="profile-info">
                    <h3><?php echo htmlspecialchars($nama_user); ?></h3>
                    <p style="margin-bottom: 5px; font-weight: 600; color: #0a66c2;"><?php echo htmlspecialchars($email_user); ?></p>
                    <p>Anggota Banding.in - bingung milih harga, banding-in aja</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px; color: #1e1e1e;">Produk Rekomendasi Tersimpan</h3>
            <div class="saved-grid">
                <?php 
                if ($result_produk && mysqli_num_rows($result_produk) > 0) {
                    while ($row = mysqli_fetch_assoc($result_produk)) {
                        echo '<div class="saved-card">';
                        
                        if (!empty($row['gambar'])) { echo '<img src="' . $row['gambar'] . '" alt="Gambar">'; } 
                        else { echo '<div class="placeholder-img">Tidak Ada Gambar</div>'; }
                        
                        $toko = !empty($row['nama_toko']) ? $row['nama_toko'] : "Toko Umum";
                        echo '<div class="txt-toko"> ' . htmlspecialchars($toko) . '</div>';
                        echo '<h4>' . htmlspecialchars($row['nama_produk']) . '</h4>';
                        
                        if ($row['diskon'] > 0) {
                            echo '<div class="txt-diskon">Diskon ' . $row['diskon'] . '%</div>';
                            echo '<div class="txt-harga-awal">Rp ' . number_format($row['harga'], 0, ',', '.') . '</div>';
                        }
                        echo '<div class="txt-harga-akhir">Rp ' . number_format($row['harga_akhir'], 0, ',', '.') . '</div>';
                        echo '<button class="btn-hapus" onclick="hapusProduk(' . $row['id'] . ')">Hapus</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="color: #666; grid-column: 1/-1;">Belum ada produk yang disimpan.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
    // Fungsi Menghapus Produk
    // Fungsi Menghapus Produk (Sudah Dilengkapi Debugging Error)
    function hapusProduk(id) {
        if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
            let formData = new FormData();
            formData.append('id', id);

            fetch('hapus_produk.php', { method: 'POST', body: formData })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "success") { 
                    location.reload(); 
                } else { 
                    // Perbaikan: Menampilkan balasan error asli dari PHP agar tahu letak salahnya
                    alert("Gagal menghapus produk! Respons Server: " + data); 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan jaringan!");
            });
        }
    }

    // Fungsi Upload Foto Profil
    function uploadFotoProfil(input) {
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let formData = new FormData();
            formData.append('foto_profil', file);

            // Kirim gambar secara background ke upload_foto.php
            fetch('upload_foto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Jika balasan mengandung kata "uploads/", artinya upload sukses
                if (data.includes("uploads/")) {
                    let imgPreview = document.getElementById('previewFoto');
                    let inisial = document.getElementById('inisialFoto');
                    
                    // Update gambar di layar saat itu juga (ditambahkan timestamp agar browser tidak nge-cache)
                    imgPreview.src = data + "?t=" + new Date().getTime(); 
                    imgPreview.style.display = 'block';
                    inisial.style.display = 'none';
                    
                } else {
                    alert("Gagal mengupload foto! Pastikan formatnya .JPG/.PNG dan ukuran tidak terlalu besar.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan jaringan!");
            });
        }
    }
    </script>
</body>
</html>