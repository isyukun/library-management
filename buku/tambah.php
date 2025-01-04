<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, jumlah) 
              VALUES ('$judul', '$penulis', '$penerbit', '$tahun', '$jumlah')";
    if (mysqli_query($conn, $query)) {
        header('Location: list.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku</h1>
    <form method="POST">
        <label>Judul: <input type="text" name="judul" required></label><br>
        <label>Penulis: <input type="text" name="penulis" required></label><br>
        <label>Penerbit: <input type="text" name="penerbit" required></label><br>
        <label>Tahun: <input type="number" name="tahun" required></label><br>
        <label>Jumlah: <input type="number" name="jumlah" required></label><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
