<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="regis.css?v=2">
</head>
<body>

    <div class="container">
        <div class="card">
            <h2>Registrasi</h2>
            
            <form action="proses_register.php" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Masukan Email" required>
                <input type="password" name="password" placeholder="Masukan Password" required>
                
                <input type="password" name="ulangi_password" placeholder="Ulangi Password" required>
                
                <button type="submit" class="btn login" style="margin-top: 10px;">Daftar</button>
                
            </form>

            <p class="footer-text" style="margin-top: 20px;">Sudah punya akun? <a href="Login.php">Login sekarang</a></p>
        </div>
    </div>
</body>

</html>
