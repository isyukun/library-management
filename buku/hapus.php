<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_buku = $_GET['id'];

// Hapus data buku berdasarkan ID
$query = "DELETE FROM buku WHERE id_buku = $id_buku";
if (mysqli_query($conn, $query)) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
