<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B',16);
// mencetak string
$pdf->Cell(40,10,'Belajar Membuat Laporan PDF dengan FPDF');
$pdf->Output();
?>