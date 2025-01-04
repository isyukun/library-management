<?php
include 'koneksi.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek pengguna
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $now = new DateTime();
        $last_attempt = new DateTime($user['last_attempt']);
        $diff = $now->diff($last_attempt);

        // Cek apakah pengguna terkunci
        if ($user['login_attempts'] >= 3 && $diff->i < 5) { // Terkunci selama 5 menit
            $error_message = "Akun Anda terkunci. Coba lagi dalam beberapa menit.";
        } else {
            if (password_verify($password, $user['password'])) {
                // Login berhasil
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $reset_attempts = "UPDATE user SET login_attempts = 0, last_attempt = NULL WHERE username = '$username'";
                mysqli_query($conn, $reset_attempts);
                header('Location: index.php');
                exit;
            } else {
                // Login gagal
                $attempts = $user['login_attempts'] + 1;
                $update_attempts = "UPDATE user SET login_attempts = $attempts, last_attempt = NOW() WHERE username = '$username'";
                mysqli_query($conn, $update_attempts);
                $error_message = "Username atau password salah!";
            }
        }
    } else {
        $error_message = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
