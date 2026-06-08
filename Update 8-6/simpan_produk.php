<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['nama'])) {
    $nama_user = $_SESSION['nama'];
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $diskon = (int)$_POST['diskon'];
    $harga = (int)$_POST['harga'];
    $harga_akhir = (int)$_POST['harga_akhir'];
    
    $path_gambar = "";

    // PROSES UPLOAD GAMBAR KE FOLDER 'uploads'
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
        // Beri nama unik menggunakan waktu agar gambar tidak tertimpa
        $nama_file = time() . "_" . basename($_FILES['file_gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $nama_file;
        
        // Pindahkan file ke folder uploads
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $target_file)) {
            $path_gambar = $target_file; // Ini yang disimpan di database: "uploads/12345_susu.jpg"
        }
    }

    if (!empty($nama_produk)) {
        // Simpan data produk dan jalur gambarnya
        $query = "INSERT INTO produk_tersimpan (nama_user, nama_produk, diskon, harga, harga_akhir, gambar) 
                  VALUES ('$nama_user', '$nama_produk', '$diskon', '$harga', '$harga_akhir', '$path_gambar')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "empty";
    }
} else {
    echo "unauthorized";
}
?>