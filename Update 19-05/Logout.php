<?php
// 1. Mulai sesi untuk mengenali user yang sedang login
session_start();

// 2. Hapus semua data sesi (seperti nama user, dll)
session_unset();

// 3. Hancurkan sesi sepenuhnya agar tidak bisa di-back
session_destroy();

// 4. Arahkan pengguna kembali ke halaman Login.php
header("Location: Login.php");
exit();
?>