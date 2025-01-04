<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_anggota = $_GET['id'];

// Ambil data anggota berdasarkan ID
$query = "SELECT * FROM anggota WHERE id_anggota = $id_anggota";
$result = mysqli_query($conn, $query);
$anggota = mysqli_fetch_assoc($result);

if (!$anggota) {
    echo "Data anggota tidak ditemukan!";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $update_query = "UPDATE anggota SET 
                     nama = '$nama', 
                     alamat = '$alamat', 
                     no_hp = '$no_hp' 
                     WHERE id_anggota = $id_anggota";
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
    <title>Edit Anggota</title>
</head>
<body>
    <h1>Edit Anggota</h1>
    <form method="POST">
        <label>Nama: <input type="text" name="nama" value="<?= $anggota['nama'] ?>" required></label><br>
        <label>Alamat: <textarea name="alamat" required><?= $anggota['alamat'] ?></textarea></label><br>
        <label>No HP: <input type="text" name="no_hp" value="<?= $anggota['no_hp'] ?>" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
