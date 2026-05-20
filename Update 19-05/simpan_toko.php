<?php
session_start();

// Koneksi ke database Anda
$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Pastikan request berupa POST dan user sudah login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['nama'])) {
    $nama_user = $_SESSION['nama'];
    // Mengamankan input dari sql injection
    $nama_toko = mysqli_real_escape_string($koneksi, $_POST['nama_toko']);

    if (!empty($nama_toko)) {
        // Query masukkan data
        $query = "INSERT INTO toko (nama_user, nama_toko) VALUES ('$nama_user', '$nama_toko')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "success"; // Kirim respon sukses ke Javascript
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