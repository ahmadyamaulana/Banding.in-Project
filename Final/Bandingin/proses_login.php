<?php
session_start(); // Wajib taruh di baris paling atas!
$koneksi = mysqli_connect("localhost", "root", "", "banding_in_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data_user = mysqli_fetch_assoc($result);
        $_SESSION['nama'] = $data_user['nama'];
        header("Location: LandingPage.php");
        exit();
    } else {
        echo "<script>alert('Email atau Password salah!'); window.location.href='Login.php';</script>";
    }
}
?>