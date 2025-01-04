<?php
include '../koneksi.php';
include '../auth/cek_admin.php';

// Ambil data anggota
$query = "SELECT * FROM anggota";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
</head>
<body>
    <h1>Daftar Anggota</h1>
    <a href="tambah.php">Tambah Anggota</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id_anggota'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['no_hp'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_anggota'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_anggota'] ?>" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
