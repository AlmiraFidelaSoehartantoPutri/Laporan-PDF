<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO pendaftaran_siswa (nama, alamat) VALUES ('$nama', '$alamat')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Simpan Data Siswa</title>
</head>

<body>
    <h1>Form Simpan Data Siswa</h1>

    <form method="post" action="form_simpan.php">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea>
        <br>

        <button type="submit">Simpan</button>
    </form>

    <a href="index.php">Kembali ke Data Siswa</a>
</body>

</html>
