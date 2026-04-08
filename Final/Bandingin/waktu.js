// Ambil tombol hitung
const tombolHitung = document.querySelector(".hitung");

// Tambahkan event ketika tombol diklik
tombolHitung.addEventListener("click", function () {

    // Ambil nilai input
    const pendapatan = parseFloat(document.getElementById("pendapatan").value);
    const hargaBarang = parseFloat(document.getElementById("hargaBarang").value);
    const jamPerHari = parseFloat(document.getElementById("jamPerHari").value);
    const hariPerMinggu = parseFloat(document.getElementById("hariPerMinggu").value);

    // Validasi input wajib
    if (!pendapatan || !hargaBarang) {
        alert("Pendapatan dan Harga Barang wajib diisi!");
        return;
    }

    let totalJamKerja;

    // Jika jam & hari kerja diisi
    if (jamPerHari && hariPerMinggu) {
        totalJamKerja = jamPerHari * hariPerMinggu * 4.33;
    } 
    // Jika tidak diisi
    else {
        totalJamKerja = 24 * 30; // 720 jam
    }

    // Hitung upah per jam
    const upahPerJam = pendapatan / totalJamKerja;

    // Hitung waktu (jam) untuk beli barang
    const jamDibutuhkan = hargaBarang / upahPerJam;

    // Konversi ke hari & jam
    const hari = Math.floor(jamDibutuhkan / 24);
    const sisaJam = Math.round(jamDibutuhkan % 24);

    // Tampilkan hasil
    document.querySelector(".result-value").innerText = `${jamDibutuhkan.toFixed(2)} jam`;

    document.querySelector(".result-detail").innerText =
        `≈ ${hari} hari ${sisaJam} jam kerja untuk membeli barang ini`;
});