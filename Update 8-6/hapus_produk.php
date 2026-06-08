<?php
session_start();

// 1. Pastikan user sudah login
if (!isset($_SESSION['nama'])) {
    echo "Belum login";
    exit();
}

// 2. Pastikan ada ID produk yang dikirimkan
if (isset($_POST['id'])) {
    $koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");
    
    if (!$koneksi) {
        echo "Koneksi database gagal";
        exit();
    }

    // Ambil data dan amankan dari SQL Injection
    $id = intval($_POST['id']);
    $nama_user = $_SESSION['nama'];

    // 3. Jalankan query hapus (pastikan produk yang dihapus adalah milik user yang login)
    $query = "DELETE FROM produk_tersimpan WHERE id = $id AND nama_user = '$nama_user'";
    
    if (mysqli_query($koneksi, $query)) {
        // Wajib mencetak kata 'success' tanpa spasi/HTML lain agar dibaca benar oleh JS
        echo "success"; 
    } else {
        echo "Gagal eksekusi query: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan";
}
?>