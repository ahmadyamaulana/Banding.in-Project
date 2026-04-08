<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banding.in - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    
    <div class="container">
        <div class="Login-card">
            <h2>Login</h2>
            <form action="proses_login.php" method="POST">
                <div class ="input-group">
                    <input type="email" name="email" placeholder="Masukkan Email" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>

                <div class="forgot-password">
                    <a href="#">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <div class="register-link">
                    <p>Belum punya akun? <a href="regis.php"> Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="login.js?v=2"></script>
    
</body>
</html>