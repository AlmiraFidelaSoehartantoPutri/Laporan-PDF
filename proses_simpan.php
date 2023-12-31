<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Validasi data (jika diperlukan)
    // ...

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pendaftaran_siswa (nama, alamat) VALUES ('$nama', '$alamat')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika penyimpanan berhasil, redirect ke halaman utama
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Simpan Data</title>
</head>

<body>
    <h2>Form Simpan Data</h2>

    <form method="post" action="proses_simpan.php">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <br>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea>
        <br>
        <input type="submit" value="Simpan">
    </form>
</body>

</html>
