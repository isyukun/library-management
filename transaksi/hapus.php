<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_transaksi = $_GET['id'];

// Hapus data transaksi berdasarkan ID
$query = "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi";
if (mysqli_query($conn, $query)) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
