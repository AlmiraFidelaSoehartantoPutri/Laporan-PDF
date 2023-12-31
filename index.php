<?php
include('koneksi.php');

// Fungsi untuk mendapatkan data siswa dari database
function getDataSiswa()
{
    global $conn;
    $query = "SELECT * FROM pendaftaran_siswa";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Memproses form ubah jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM pendaftaran_siswa WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $siswa = mysqli_fetch_assoc($result);
}

// Memproses form simpan jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
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

// Memproses form ubah jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proses_ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE pendaftaran_siswa SET nama='$nama', alamat='$alamat' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Memproses form hapus jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM pendaftaran_siswa WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Mendapatkan data siswa
$dataSiswa = getDataSiswa();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>

<body>
    <h1>Data Siswa</h1>

    <!-- Form untuk simpan data -->
    <form action="index.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea>
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <hr>

    <!-- Tabel untuk menampilkan data siswa -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($dataSiswa as $siswa) : ?>
            <tr>
                <td><?= $siswa['id']; ?></td>
                <td><?= $siswa['nama']; ?></td>
                <td><?= $siswa['alamat']; ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
                        <button type="submit" name="ubah">Ubah</button>
                        <button type="submit" name="hapus">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form untuk ubah data -->
    <?php if (isset($siswa)) : ?>
        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?= $siswa['nama']; ?>" required>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required><?= $siswa['alamat']; ?></textarea>
            <button type="submit" name="proses_ubah">Proses Ubah</button>
        </form>
    <?php endif; ?>

</body>

</html>
<?php
include('koneksi.php');

// Fungsi untuk mencetak PDF
function cetakPDF() {
    require('Cetak_PDF.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $result = mysqli_query($conn, "SELECT * FROM pendaftaran_siswa");
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40, 10, $row['nama'], 1, 0);
        $pdf->Cell(60, 10, $row['alamat'], 1, 1);
    }

    $pdf->Output();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>

<body>

    <!-- Tombol untuk mencetak PDF -->
    <form action="index.php" method="post">
        <input type="submit" name="cetak_pdf" value="Cetak PDF">
    </form>

    <?php
    
    // Proses cetak PDF jika tombol ditekan
    if (isset($_POST['cetak_pdf'])) {
        cetakPDF();
    }

    // Tampilkan data siswa
    $result = mysqli_query($conn, "SELECT * FROM pendaftaran_siswa");
    ?>

</body>

</html>
