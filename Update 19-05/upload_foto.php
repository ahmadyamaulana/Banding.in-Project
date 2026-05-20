<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['nama'])) {
    $nama_user = $_SESSION['nama'];
    
    // Cek apakah ada file foto yang dikirim
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
        $file = $_FILES['foto_profil'];
        $nama_file = time() . "_" . basename($file['name']); // Nama unik anti ganda
        
        // Buat folder 'uploads/profiles/' otomatis jika belum ada
        $target_dir = "uploads/profiles/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); 
        }
        $target_file = $target_dir . $nama_file;
        
        // Validasi tipe file (Hanya boleh gambar)
        $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            
            // Pindahkan file dari memori sementara ke folder tujuan
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                
                // Hapus foto profil yang lama agar memori komputer/server Anda tidak penuh
                $cek_lama = mysqli_query($koneksi, "SELECT foto_profil FROM users WHERE nama='$nama_user'");
                if ($row = mysqli_fetch_assoc($cek_lama)) {
                    if (!empty($row['foto_profil']) && file_exists($row['foto_profil'])) {
                        unlink($row['foto_profil']); 
                    }
                }
                
                // Simpan jalur foto baru ke database
                $query = "UPDATE users SET foto_profil='$target_file' WHERE nama='$nama_user'";
                if (mysqli_query($koneksi, $query)) {
                    echo $target_file; // Kembalikan teks jalur file ke JavaScript
                } else {
                    echo "error_db";
                }
            } else {
                echo "error_upload";
            }
        } else {
            echo "error_ext";
        }
    } else {
        echo "error_file";
    }
} else {
    echo "unauthorized";
}
?>