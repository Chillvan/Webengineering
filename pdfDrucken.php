<?php	
require("fpdf17/fpdf.php");

class PDF extends FPDF {
    
    // Page header
    function Header() {
        // Logo
        $this->Image('img/logo_pdf.png',10,6,30);
        // Arial bold 20
        $this->SetFont('Arial','B',30);
        // Move to the right
        $this->Cell(10);
        // Title
        $this->Cell(0,20,'Gesamtabrechnung Mehrfamilienhaus',0,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    // fetch data from database
    function fetchData() {
        try {
            $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', 'u566874539_admin', 'WEFHNW14');
            $query = $dbh->prepare('SELECT * FROM Rechnungen, Mieterspiegel WHERE Mieterspiegel.Mieternummer=Rechnungen.Mieternummer ORDER BY Rechnungsnummer ASC');
            $dbh->query('SELECT SUM(Betrag) FROM Rechnungen');
            $query->execute();
            $abrechnung = $query->fetchAll(PDO::FETCH_ASSOC);
            $query = null;
            $dbh = null;
            return $abrechnung;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        } 
    }




    // Page content
    function createTable($header, $data) {
        
        // Column widths
        $w = array(60, 50, 60, 30, 40, 35);
        // Position at 4.5 cm from top
        $this->SetY(45);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'C');
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            $this->Cell($w[0],6,number_format($row[0]),'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
            $this->Cell($w[3],6,$row[3],'LR',0,'R');
            $this->Cell($w[4],6,$row[4],'LR',0,'R');
            $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }



    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',10);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
// Column headings
$header = array('Rechnungsnummer', 'Rechnungstyp', 'Wohnungsnummer', 'Name', 'Vorname', 'Betrag');
$data = $pdf->fetchData();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',14);
$pdf->AddPage('L');
$pdf->createTable($header);
//$pdf->SetFont('Times','',12);
$pdf->Output();
?>


