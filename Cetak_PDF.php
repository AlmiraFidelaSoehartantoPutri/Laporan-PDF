<?php
require('./fpdf186/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Laporan PDF',0,0,'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo(),0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Isi laporan disini...');
$pdf->Output();
?>
