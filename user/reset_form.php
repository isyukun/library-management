<?php
include '../koneksi.php';

$error_message = "";
$success_message = "";
$email = $_GET['email'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi
    if (!$password) {
        $error_message = "Password baru harus diisi!";
    } else {
        $hashed_password = md5($password);
        $query = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";
        if (mysqli_query($conn, $query)) {
            $success_message = "Password berhasil diubah! <a href='../login.php'>Login di sini</a>";
        } else {
            $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <p style="color: green;"><?= $success_message ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="email" value="<?= $email ?>">
        <label>Password Baru: <input type="password" name="password" required></label><br>
        <button type="submit">Reset Password</button>
    </form>
    <a href="../login.php">Kembali ke Login</a>
</body>
</html>
