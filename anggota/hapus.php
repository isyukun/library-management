<?php
include '../koneksi.php';

// Cek apakah ada parameter id yang dikirimkan
if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id_anggota = $_GET['id'];

// Hapus data anggota berdasarkan ID
$query = "DELETE FROM anggota WHERE id_anggota = $id_anggota";
if (mysqli_query($conn, $query)) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
