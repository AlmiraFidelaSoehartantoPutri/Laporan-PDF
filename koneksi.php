<?php
$host = "localhost";
$user = "root"; // Ganti dengan nama pengguna database Anda
$pass = ""; // Ganti dengan kata sandi database Anda
$db = "pendaftaran_siswa"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
