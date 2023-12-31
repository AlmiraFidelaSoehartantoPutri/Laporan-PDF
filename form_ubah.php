<?php
include('koneksi.php');

// Mendapatkan ID dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mendapatkan data siswa berdasarkan ID
    $query = "SELECT * FROM pendaftaran_siswa WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $siswa = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

// Menangani pengiriman formulir ubah
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Query untuk memperbarui data siswa
    $updateQuery = "UPDATE pendaftaran_siswa SET nama='$nama', alamat='$alamat' WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Data Siswa</title>
</head>

<body>
    <h1>Form Ubah Data Siswa</h1>

    <!-- Formulir untuk mengubah data siswa -->
    <form method="post" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?php echo $siswa['alamat']; ?></textarea><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>

</html>
