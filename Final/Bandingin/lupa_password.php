<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banding.in - Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="container">
        <div class="Login-card">
            <h2>Reset Password</h2>
            <form action="proses_lupa_password.php" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Masukkan Email Terdaftar" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password_baru" placeholder="Masukkan Password Baru" required>
                </div>

                <button type="submit" class="btn-login">Simpan Password Baru</button>

                <div class="register-link">
                    <p>Ingat password? <a href="Login.php">Kembali ke Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>