<?php
include '../koneksi.php';
include '../auth/cek_user.php';

// Ambil kata kunci pencarian (jika ada)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query untuk data transaksi dengan pencarian
$query = "SELECT t.id_transaksi, b.judul, a.nama, t.tanggal_pinjam, t.tanggal_kembali 
          FROM transaksi t
          JOIN buku b ON t.id_buku = b.id_buku
          JOIN anggota a ON t.id_anggota = a.id_anggota 
          WHERE b.judul LIKE '%$keyword%' OR a.nama LIKE '%$keyword%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
</head>
<body>
    <h1>Daftar Transaksi</h1>
    <a href="tambah.php">Tambah Transaksi</a>
    <form method="GET" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Cari judul buku atau nama anggota" value="<?= $keyword ?>">
        <button type="submit">Cari</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul Buku</th>
            <th>Nama Anggota</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id_transaksi'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?: 'Belum Kembali' ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_transaksi'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_transaksi'] ?>" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
