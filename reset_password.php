<?php
include 'koneksi.php';

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Simulasikan tautan reset password
        $reset_link = "http://localhost/perpustakaan/user/reset_form.php?email=" . urlencode($email);
        $success_message = "Tautan reset password telah dikirim ke email Anda: <a href='$reset_link'>Klik di sini</a>";
    } else {
        $error_message = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
</head>
<body>
    <h1>Lupa Password</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <p style="color: green;"><?= $success_message ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Kirim Tautan Reset</button>
    </form>
    <a href="login.php">Kembali ke Login</a>
</body>
</html>
