<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Banding.in</title>
    <link rel="stylesheet" href="stylePromo.css ">
    
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <div class="logo-box">in</div>
            <a href="LandingPage.php">Banding.in</a>
        </div>
    </nav>

    <div class="container">

        <div class="card-wrapper">
            <div class="card">
                <input type="text" placeholder="Nama Produk">
                <input type="text" placeholder="Masukan Diskon">
                <input type="text" placeholder="Harga">
            </div>
            <div class="card">
                <input type="text" placeholder="Nama Produk">
                <input type="text" placeholder="Masukan Diskon">
                <input type="text" placeholder="Harga">
            </div>
        </div>
        <div class="button-wrapper">
            <button class="btn tambah">Tambah Kartu</button>
            <button class="btn banding">Bandingkan</button>
        </div>

    </div>

    </div> 
        <div id="customModal" class="modal-overlay">
            <div class="modal-content">
                <h3 class="modal-title">Hasil Perbandingan</h3>
                <div id="modalBody" class="modal-body">
            </div>
            <button id="closeModal" class="btn modal-btn">Tutup</button>
        </div>
    </div>
    
    <script>
        const tombolTambah = document.querySelector(".tambah");
        const cardWrapper = document.querySelector(".card-wrapper");
        
        tombolTambah.addEventListener("click", function () {
            const jumlahCard = document.querySelectorAll(".card").length;

            if (jumlahCard >= 3) {
                alert("Maksimal hanya 3 kartu!");
                return;
            }

            const cardBaru = document.createElement("div");
            cardBaru.classList.add("card");

            cardBaru.innerHTML = `
                <input type="text" placeholder="Nama Produk">
                <input type="text" placeholder="Masukan Diskon">
                <input type="text" placeholder="Harga">
            `;

            cardWrapper.prepend(cardBaru);
        });

        const tombolBanding = document.querySelector(".banding");
        const modal = document.getElementById("customModal");
        const modalBody = document.getElementById("modalBody");
        const closeModal = document.getElementById("closeModal");

        tombolBanding.addEventListener("click", function () {
            const semuaKartu = document.querySelectorAll(".card");
            let hasilPerbandingan = "";
            let adaData = false;
            let hargaTermurah = Infinity;
            let produkTermurah = "";
            let isError = false; 

            semuaKartu.forEach(function (card, index) {
                if (isError) return; 

                const inputs = card.querySelectorAll("input");
                const nama = inputs[0].value.trim();
                const diskonText = inputs[1].value.trim();
                const hargaText = inputs[2].value.trim();

                if (diskonText !== "" && isNaN(diskonText)) {
                    alert(`Peringatan: Diskon pada Produk ${index + 1} harus berupa angka!`);
                    isError = true;
                    return; 
                }

                if (hargaText !== "" && isNaN(hargaText)) {
                    alert(`Peringatan: Harga pada Produk ${index + 1} harus berupa angka!`);
                    isError = true;
                    return; 
                }

                const diskon = parseFloat(diskonText) || 0; 
                const harga = parseFloat(hargaText) || 0;  

                if (nama !== "" && harga > 0) {
                    adaData = true;
                    const nilaiDiskon = (harga * diskon) / 100;
                    const hargaAkhir = harga - nilaiDiskon;

                    hasilPerbandingan += `<b>Produk ${index + 1}: ${nama}</b><br>`;
                    hasilPerbandingan += `Harga Awal: Rp ${harga.toLocaleString("id-ID")}<br>`;
                    hasilPerbandingan += `Diskon: ${diskon}%<br>`;
                    hasilPerbandingan += `Harga Akhir: <span style="color:#0a66c2; font-weight:bold;">Rp ${hargaAkhir.toLocaleString("id-ID")}</span><br><br>`;

                    if (hargaAkhir < hargaTermurah) {
                        hargaTermurah = hargaAkhir;
                        produkTermurah = nama;
                    }
                }
            });

            if (isError) {
                return; 
            }

            if (adaData) {
                hasilPerbandingan += `<div>
                <b>REKOMENDASI:</b><br>
                Produk paling wort it untuk dibeli yang <b>"${produkTermurah}"</b> karna harganya cuma <b>Rp ${hargaTermurah.toLocaleString("id-ID")}</b>!
                </div>`;
                
                modalBody.innerHTML = hasilPerbandingan;
                modal.classList.add("show");
            } else {
                alert("Silakan isi nama produk dan harganya terlebih dahulu!");
            }
        });

        closeModal.addEventListener("click", function() {
            modal.classList.remove("show");
        });
    </script>

</body>

</html>

