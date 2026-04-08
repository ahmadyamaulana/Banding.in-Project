<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Waktu vs Harga</title>
    <link rel="stylesheet" href="stylewaktu.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <div class="logo-box">in</div>
            <a href="LandingPage.php">Banding.in</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Waktu vs Harga</h2>
            
            <div class="form-group">
                <label>Pendapatan Bulanan <span class="required"></span></label>
                <input type="number" id="pendapatan">
            </div>

            <div class="form-group">
                <label>Harga Barang <span class="required"></span></label>
                <input type="number" id="hargaBarang">
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Jam Kerja per Hari <span class="required"></span></label>
                    <input type="number" id="jamPerHari">
                </div>

                <div class="form-group half">
                    <label>Hari Kerja per Minggu <span class="required"></span></label>
                    <input type="number" id="hariPerMinggu">
                </div>
            </div>

            <div class="info-box">
                <p><strong>Rumus:</strong></p>
                <p> Jika jam & hari kerja diisi: Jam/hari × Hari/minggu × 4.33</p>
                <p> Jika tidak diisi: 24 jam × 30 hari = 720 jam</p>
            </div>

            <button class="btn hitung">Hitung</button>
        </div>

        <div class="result-card">
            <h3>Hasil</h3>
            <div class="result-value">-</div>
            <div class="result-detail">-</div>
        </div>
    </div>
    <script src="waktu.js"></script>
</body>
</html>