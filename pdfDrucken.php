<?php
	
require("fpdf17/fpdf.php");
$pdf = new FPDF();

$pdf->AddPage("L");
$pdf->Image("img/logo_pdf.png");
$pdf->SetFont("Arial", "B", "20");
$pdf->Cell(0,20, "Gesamtabrechnung Mehrfamilienhaus", 0, 1, "C");
$pdf->Output();

?>


