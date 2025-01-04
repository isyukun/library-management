<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perpustakaan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Peran Anda: <?= htmlspecialchars($_SESSION['role']) ?></p>
    <ul>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="buku/list.php">Daftar Buku</a></li>
            <li><a href="anggota/list.php">Daftar Anggota</a></li>
            <li><a href="user/register.php">Tambah Pengguna Baru</a></li>
        <?php endif; ?>
        <li><a href="transaksi/list.php">Daftar Transaksi</a></li>
        <li><a href="transaksi/laporan.php">Laporan Transaksi</a></li>
    </ul>
</body>
</html>
