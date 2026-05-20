<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Banding.in</title>
    <link rel="stylesheet" href="StylePromo.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <div class="logo-box">in</div>
            <a href="LandingPage.php">Banding.in</a>
        </div>
    </nav>

    <div class="container">
        <div class="card-wrapper" id="cardWrapper">
            <div class="card-item">
                <div class="card">
                    <div class="image-upload-area" onclick="this.querySelector('input').click()">
                        <span>Tambah Gambar</span>
                        <input type="file" accept="image/*" hidden onchange="uploadGambar(this)">
                        <img>
                    </div>
                    <input type="text" placeholder="Nama Produk">
                    <input type="text" placeholder="Masukan Diskon">
                    <input type="text" placeholder="Harga">
                </div>
                <button class="btn-bookmark" onclick="simpanCard(this)" title="Simpan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                    </svg>
                </button>
            </div>

            <div class="card-item">
                <div class="card">
                    <div class="image-upload-area" onclick="this.querySelector('input').click()">
                        <span>Tambah Gambar</span>
                        <input type="file" accept="image/*" hidden onchange="uploadGambar(this)">
                        <img>
                    </div>
                    <input type="text" placeholder="Nama Produk">
                    <input type="text" placeholder="Masukan Diskon">
                    <input type="text" placeholder="Harga">
                </div>
                <button class="btn-bookmark" onclick="simpanCard(this)" title="Simpan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="button-wrapper">
            <button class="btn tambah">Tambah Kartu</button>
            <button class="btn banding">Bandingkan</button>
        </div>
    </div>

    <div id="customModal" class="modal-overlay">
        <div class="modal-content">
            <h3 class="modal-title">Hasil Perbandingan</h3>
            <div id="modalBody" class="modal-body"></div>
            <button id="closeModal" class="btn modal-btn">Tutup</button>
        </div>
    </div>

    <script>
        function uploadGambar(input) {
            let area = input.parentElement;
            let img = area.querySelector('img');
            let span = area.querySelector('span');

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                
                // Ketika file selesai dibaca, ubah jadi Base64 dan masukkan ke img src
                reader.onload = function(e) {
                    img.src = e.target.result; // Ini sekarang berisi teks Base64 (data:image/...)
                    img.style.display = "block";
                    span.style.display = "none";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function simpanCard(button) {
            const cardItem = button.closest('.card-item');
            const card = cardItem.querySelector('.card');
            
            const namaProduk = card.querySelector('input[placeholder="Nama Produk"]').value.trim();
            const diskonText = card.querySelector('input[placeholder="Masukan Diskon"]').value.trim();
            const hargaText = card.querySelector('input[placeholder="Harga"]').value.trim();
            
            // AMBIL FILE FISIK DARI INPUT FILE
            const inputGambar = card.querySelector('input[type="file"]');
            const fileGambar = inputGambar.files.length > 0 ? inputGambar.files[0] : null;

            if (namaProduk === "" || hargaText === "") {
                alert("Nama Produk dan Harga wajib diisi sebelum menyimpan!");
                return;
            }

            const harga = parseInt(hargaText) || 0;
            const diskon = parseInt(diskonText) || 0;
            const hargaAkhir = harga - (harga * diskon / 100);

            // Siapkan data untuk dikirim
            let formData = new FormData();
            formData.append('nama_produk', namaProduk);
            formData.append('diskon', diskon);
            formData.append('harga', harga);
            formData.append('harga_akhir', hargaAkhir);
            
            // Jika ada file gambar yang dipilih, masukkan ke paket pengiriman
            if (fileGambar) {
                formData.append('file_gambar', fileGambar);
            }

            fetch('simpan_produk.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert("Produk '" + namaProduk + "' berhasil disimpan!");
                    button.style.color = "#0a66c2";
                    button.style.fill = "#0a66c2";
                } else {
                    alert("Gagal menyimpan produk: " + data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan jaringan!");
            });
        }

        const tombolTambah = document.querySelector(".tambah");
        const cardWrapper = document.querySelector(".card-wrapper");

        tombolTambah.addEventListener("click", function () {
            if (document.querySelectorAll(".card-item").length >= 3) {
                alert("Maksimal hanya 3 kartu!");
                return;
            }

            const cardItemBaru = document.createElement("div");
            cardItemBaru.classList.add("card-item");
            cardItemBaru.innerHTML = `
                <div class="card">
                    <div class="image-upload-area" onclick="this.querySelector('input').click()">
                        <span>Tambah Gambar</span>
                        <input type="file" accept="image/*" hidden onchange="uploadGambar(this)">
                        <img>
                    </div>
                    <input type="text" placeholder="Nama Produk">
                    <input type="text" placeholder="Masukan Diskon">
                    <input type="text" placeholder="Harga">
                </div>
                <button class="btn-bookmark" onclick="simpanCard(this)" title="Simpan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                    </svg>
                </button>
            `;
            cardWrapper.appendChild(cardItemBaru);
        });

        // 4. FUNGSI BANDINGKAN PRODUK (DIREVISI)
        const tombolBanding = document.querySelector(".banding");
        const modal = document.getElementById("customModal");
        const modalBody = document.getElementById("modalBody");
        const closeModal = document.getElementById("closeModal");

        tombolBanding.addEventListener("click", function () {
            const semuaCardItem = document.querySelectorAll(".card-item");
            let hasilPerbandingan = "";
            let adaData = false;
            let hargaTermurah = Infinity;
            let produkTermurah = "";

            semuaCardItem.forEach(function (cardItem, index) {
                // Ambil kotak card di dalam pembungkus cardItem
                const card = cardItem.querySelector('.card');
                
                // Ambil nilai input dari masing-masing kotak
                const nama = card.querySelector('input[placeholder="Nama Produk"]').value.trim();
                
                // Bersihkan huruf/simbol dari harga & diskon agar perhitungan tidak error
                const rawDiskon = card.querySelector('input[placeholder="Masukan Diskon"]').value.replace(/[^0-9]/g, '');
                const rawHarga = card.querySelector('input[placeholder="Harga"]').value.replace(/[^0-9]/g, '');

                const diskon = parseInt(rawDiskon) || 0;
                const harga = parseInt(rawHarga) || 0;

                // Jika nama dan harga sudah diisi, lakukan perhitungan
                if (nama !== "" && harga > 0) {
                    adaData = true;
                    const hargaAkhir = harga - (harga * diskon / 100);

                    hasilPerbandingan += `
                        <b>Produk ${index + 1}: ${nama}</b><br>
                        Harga Awal: Rp ${harga.toLocaleString("id-ID")}<br>
                        Diskon: ${diskon}%<br>
                        Harga Akhir: <span style="color:#0a66c2; font-weight:bold;">Rp ${hargaAkhir.toLocaleString("id-ID")}</span><br><br>
                    `;

                    // Simpan data produk yang paling murah
                    if (hargaAkhir < hargaTermurah) {
                        hargaTermurah = hargaAkhir;
                        produkTermurah = nama;
                    }
                }
            });

            // Jika ada data yang berhasil dihitung, munculkan pop-up modal
            if (adaData) {
                hasilPerbandingan += `
                    <div style="background:#e8f0fe; padding:15px; border-radius:8px; border-left: 5px solid #0a66c2; margin-top:15px;">
                        <b>REKOMENDASI:</b><br>
                        Produk paling worth it adalah <b>"${produkTermurah}"</b> 
                        dengan harga <b>Rp ${hargaTermurah.toLocaleString("id-ID")}</b>!
                    </div>`;
                modalBody.innerHTML = hasilPerbandingan;
                
                // Paksa modal muncul dengan merubah display CSS-nya
                modal.style.display = "flex"; 
            } else {
                alert("Gagal membandingkan! Pastikan Nama Produk dan Harga sudah diisi.");
            }
        });

        // Logika untuk tombol tutup modal
        closeModal.addEventListener("click", function () {
            modal.style.display = "none";
        });

        closeModal.addEventListener("click", function () {
            modal.classList.remove("show");
        });
    </script>

</body>
</html>