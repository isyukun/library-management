<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_transaksi = $_GET['id'];

// Ambil data transaksi
$query = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
$result = mysqli_query($conn, $query);
$transaksi = mysqli_fetch_assoc($result);

if (!$transaksi) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $update_query = "UPDATE transaksi SET 
                     tanggal_kembali = '$tanggal_kembali' 
                     WHERE id_transaksi = $id_transaksi";
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
    <title>Edit Transaksi</title>
</head>
<body>
    <h1>Edit Transaksi</h1>
    <form method="POST">
        <label>Tanggal Kembali: <input type="date" name="tanggal_kembali" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
