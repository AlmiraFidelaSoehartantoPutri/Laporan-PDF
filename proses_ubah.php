<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Validasi data (jika diperlukan)
    // ...

    // Query untuk mengubah data di database
    $query = "UPDATE pendaftaran_siswa SET nama='$nama', alamat='$alamat' WHERE id=$id";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika pengubahan berhasil, redirect ke halaman utama
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
<!-- Kode HTML untuk form ubah data -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Data Siswa</title>
</head>

<body>
    <h2>Form Ubah Data Siswa</h2>

    <?php
    // Ambil data dari database berdasarkan ID yang diterima dari form sebelumnya
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM pendaftaran_siswa WHERE id=$id");
        $row = mysqli_fetch_assoc($result);

        // Tampilkan formulir ubah data
    ?>
        <form action="proses_ubah.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
            <br>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required><?php echo $row['alamat']; ?></textarea>
            <br>

            <input type="submit" value="Simpan Perubahan">
        </form>
    <?php
    } else {
        echo "ID tidak valid.";
    }
    ?>

</body>

</html>
