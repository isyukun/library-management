<?php
include '../auth/cek_admin.php';
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <a href="tambah.php">Tambah Buku</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM buku";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $row['id_buku'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_buku'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_buku'] ?>" onclick="return confirm('Hapus buku ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
