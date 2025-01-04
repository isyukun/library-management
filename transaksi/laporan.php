<?php
include '../koneksi.php';

// Ambil semua transaksi yang sudah selesai
$query = "SELECT t.id_transaksi, b.judul, a.nama, t.tanggal_pinjam, t.tanggal_kembali 
          FROM transaksi t
          JOIN buku b ON t.id_buku = b.id_buku
          JOIN anggota a ON t.id_anggota = a.id_anggota
          WHERE t.tanggal_kembali IS NOT NULL";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <a href="list.php">Kembali ke Daftar Transaksi</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul Buku</th>
            <th>Nama Anggota</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id_transaksi'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
