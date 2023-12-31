<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Persiapkan query untuk mendapatkan informasi siswa sebelum dihapus
    $selectQuery = "SELECT * FROM pendaftaran_siswa WHERE id = $id";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Lakukan penghapusan data
        $query = "DELETE FROM pendaftaran_siswa WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            // Hapus berhasil, arahkan kembali ke halaman utama dengan pesan sukses
            header("Location: index.php?success=1");
            exit();
        } else {
            // Gagal menghapus, arahkan kembali ke halaman utama dengan pesan error
            header("Location: index.php?error=" . urlencode(mysqli_error($conn)));
            exit();
        }
    } else {
        // Gagal mendapatkan informasi siswa, arahkan kembali ke halaman utama dengan pesan error
        header("Location: index.php?error=" . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_close($conn);
} else {
    // Jika tidak ada parameter id yang diterima, arahkan kembali ke halaman utama
    header("Location: index.php");
    exit();
}
?>
