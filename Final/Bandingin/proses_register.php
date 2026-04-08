<?php
$koneksi = mysqli_connect("localhost", "root", "", "bandingin_db");

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ulangi_password = $_POST['ulangi_password'];

    if ($password !== $ulangi_password) {
        echo "<script>alert('Pendaftaran Gagal: Password tidak cocok!'); window.location.href='regis.php';</script>";
        exit();
    }

    $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>alert('Pendaftaran Gagal: Email sudah terdaftar!'); window.location.href='regis.php';</script>";
        exit();
    }

    $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location.href='Login.php';</script>";
        exit();
    } 
    else {
        echo "<script>alert('Terjadi kesalahan sistem!'); window.location.href='regis.php';</script>";
    }
}
?>