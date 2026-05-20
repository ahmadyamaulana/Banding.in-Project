document.addEventListener('DOMContentLoaded', function() {
    
    const wadahToko = document.getElementById('wadahToko');
    const tombolTambah = document.getElementById('tombolTambah');

    const popupToko = document.getElementById('popupToko');
    const btnBatal = document.getElementById('btnBatal');
    const btnKonfirmasi = document.getElementById('btnKonfirmasi');
    const inputNamaToko = document.getElementById('inputNamaToko');

    // 1. Munculkan Popup
    tombolTambah.addEventListener('click', function() {
        popupToko.classList.add('show'); 
        inputNamaToko.value = "";        
        inputNamaToko.focus();           
    });

    // 2. Tutup Popup
    btnBatal.addEventListener('click', function() {
        popupToko.classList.remove('show');
    });

    // 3. Proses saat "Konfirmasi" diklik (Kirim ke DB lewat AJAX)
    btnKonfirmasi.addEventListener('click', function() {
        let namaTokoBaru = inputNamaToko.value.trim();

        if (namaTokoBaru === "") {
            alert("Nama toko tidak boleh kosong!");
            return;
        }

        // Siapkan data untuk dikirim ke PHP
        let formData = new FormData();
        formData.append('nama_toko', namaTokoBaru);

        // Kirim data secara background menggunakan Fetch API
        fetch('simpan_toko.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                // Jika database sukses menyimpan, baru buat kotaknya di layar
                let cardBaru = document.createElement('a');
                cardBaru.href = 'promo.php?toko=' + encodeURIComponent(namaTokoBaru); // UPDATE BAGIAN INI
                cardBaru.className = 'card card-toko';
                cardBaru.innerText = namaTokoBaru;

                // Masukkan kotak sebelum tombol tambah
                wadahToko.insertBefore(cardBaru, tombolTambah);

                // Tutup popup
                popupToko.classList.remove('show');
            } else {
                alert("Gagal menyimpan toko ke database! Status: " + data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan jaringan!");
        });
    });
});
