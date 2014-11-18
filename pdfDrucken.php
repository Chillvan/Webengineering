<?php
	
require("fpdf17/fpdf.php");
$pdf = new FPDF();

$pdf->AddPage();
$pdf->Output();

?>


