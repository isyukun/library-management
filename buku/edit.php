<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_buku = $_GET['id'];

// Ambil data buku berdasarkan ID
$query = "SELECT * FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

if (!$buku) {
    echo "Data buku tidak ditemukan!";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];

    $update_query = "UPDATE buku SET 
                     judul = '$judul', 
                     penulis = '$penulis', 
                     penerbit = '$penerbit', 
                     tahun_terbit = '$tahun', 
                     jumlah = '$jumlah' 
                     WHERE id_buku = $id_buku";
    if (mysqli_query($conn, $update_query)) {
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
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form method="POST">
        <label>Judul: <input type="text" name="judul" value="<?= $buku['judul'] ?>" required></label><br>
        <label>Penulis: <input type="text" name="penulis" value="<?= $buku['penulis'] ?>" required></label><br>
        <label>Penerbit: <input type="text" name="penerbit" value="<?= $buku['penerbit'] ?>" required></label><br>
        <label>Tahun: <input type="number" name="tahun" value="<?= $buku['tahun_terbit'] ?>" required></label><br>
        <label>Jumlah: <input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
