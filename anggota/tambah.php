<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO anggota (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')";
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
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Tambah Anggota</h1>
    <form method="POST">
        <label>Nama: <input type="text" name="nama" required></label><br>
        <label>Alamat: <textarea name="alamat" required></textarea></label><br>
        <label>No HP: <input type="text" name="no_hp" required></label><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
