<?php
include '../auth/cek_admin.php';
include '../koneksi.php';

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);


    // Validasi input
    if (!$username || !$password || !$email || !$role) {
        $error_message = "Semua kolom harus diisi!";
    } else {
        // Cek apakah username atau email sudah ada
        $check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Username atau email sudah terdaftar!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
            $query = "INSERT INTO user (username, password, email, role) 
                      VALUES ('$username', '$hashed_password', '$email', '$role')";
            if (mysqli_query($conn, $query)) {
                $success_message = "Pengguna berhasil didaftarkan!";
            } else {
                $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
            }
        }
    }
}
?>
