<?php
$host = "localhost";
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "perpustakaan";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
