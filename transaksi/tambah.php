<?php
include '../koneksi.php';

$buku_query = "SELECT id_buku, judul FROM buku";
$buku_result = mysqli_query($conn, $buku_query);

$anggota_query = "SELECT id_anggota, nama FROM anggota";
$anggota_result = mysqli_query($conn, $anggota_query);

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'] ?? null;
    $id_anggota = $_POST['id_anggota'] ?? null;
    $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? null;

    // Validasi input
    if (!$id_buku || !$id_anggota || !$tanggal_pinjam) {
        $error_message = "Semua kolom harus diisi!";
    } else {
        $query = "INSERT INTO transaksi (id_buku, id_anggota, tanggal_pinjam) 
                  VALUES ('$id_buku', '$id_anggota', '$tanggal_pinjam')";
        if (mysqli_query($conn, $query)) {
            header('Location: list.php');
        } else {
            $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Transaksi</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>
    <form method="POST" onsubmit="return validateForm()">
        <label>Buku: 
            <select name="id_buku" required>
                <option value="">Pilih Buku</option>
                <?php while ($buku = mysqli_fetch_assoc($buku_result)): ?>
                <option value="<?= $buku['id_buku'] ?>"><?= $buku['judul'] ?></option>
                <?php endwhile; ?>
            </select>
        </label><br>
        <label>Anggota: 
            <select name="id_anggota" required>
                <option value="">Pilih Anggota</option>
                <?php while ($anggota = mysqli_fetch_assoc($anggota_result)): ?>
                <option value="<?= $anggota['id_anggota'] ?>"><?= $anggota['nama'] ?></option>
                <?php endwhile; ?>
            </select>
        </label><br>
        <label>Tanggal Pinjam: <input type="date" name="tanggal_pinjam" required></label><br>
        <button type="submit">Simpan</button>
    </form>
    <script>
        function validateForm() {
            const tanggalPinjam = document.querySelector('input[name="tanggal_pinjam"]').value;
            if (!tanggalPinjam) {
                alert("Tanggal pinjam harus diisi!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
