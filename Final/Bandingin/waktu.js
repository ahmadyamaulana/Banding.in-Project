const tombolHitung = document.querySelector(".hitung");
tombolHitung.addEventListener("click", function () {

    const pendapatan = parseFloat(document.getElementById("pendapatan").value);
    const hargaBarang = parseFloat(document.getElementById("hargaBarang").value);
    const jamPerHari = parseFloat(document.getElementById("jamPerHari").value);
    const hariPerMinggu = parseFloat(document.getElementById("hariPerMinggu").value);

    if (pendapatan < 0 || hargaBarang < 0 || jamPerHari < 0 || hariPerMinggu < 0) {
        alert("Semua nilai tidak boleh negatif!");
        return;
    }

    if (!pendapatan || !hargaBarang) {
        alert("Pendapatan dan Harga Barang wajib diisi!");
        return;
    }

    let totalJamKerja;

    if (jamPerHari && hariPerMinggu) {
        totalJamKerja = jamPerHari * hariPerMinggu * 4.33;
    } 
    else {
        totalJamKerja = 24 * 30; 
    }

    const upahPerJam = pendapatan / totalJamKerja;

    const jamDibutuhkan = hargaBarang / upahPerJam;

    const hari = Math.floor(jamDibutuhkan / 24);
    const sisaJam = Math.round(jamDibutuhkan % 24);

    document.querySelector(".result-value").innerText = `${jamDibutuhkan.toFixed(2)} jam`;

    document.querySelector(".result-detail").innerText =
        `≈ ${hari} hari ${sisaJam} jam kerja untuk membeli barang ini`;
});
