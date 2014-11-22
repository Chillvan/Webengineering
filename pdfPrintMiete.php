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
        $title = utf8_decode('Übersicht Miete Mehrfamilienhaus');
        $this->Cell(0,20,$title,0,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    // fetch data from database
    function fetchData() {
        $host = 'mysql:host=mysql.hostinger.de;dbname=u566874539_ftw';
        $user = 'u566874539_admin';
        $pass = 'WEFHNW14';
        
        try {
            $dbh = new PDO($host, $user, $pass);
            $query = $dbh->prepare('SELECT * FROM Miete, Mieterspiegel WHERE Mieterspiegel.Mieternummer=Miete.Mieternummer ORDER BY Jahr ASC');
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
    
    // fetch data from database
    function fetchGesamt() {
        $host = 'mysql:host=mysql.hostinger.de;dbname=u566874539_ftw';
        $user = 'u566874539_admin';
        $pass = 'WEFHNW14';
        
        try {
            $dbh = new PDO($host, $user, $pass);
            $sth = ($dbh->query('SELECT SUM(Mietzins) FROM Miete'));
            $gesamt = $sth->fetchColumn();
            $query = null;
            $dbh = null;
            return $gesamt;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        } 
    }




    // Page content
    function createTable($header, $data, $gesamt) {
        
        // Column widths
        $w = array(40, 40, 40, 60, 60, 35);
        // Position at 4.5 cm from top
        $this->SetY(45);
        // Header
        $this->SetFont('Arial', 'B', 14);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'L');
        $this->Ln();
        // Data
        $this->SetFont('Arial', '', 14);
        foreach ($data as $row) {
            $this->Cell($w[0], 8, $row['Jahr'], 1, 0, 'L');
            $this->Cell($w[1], 8, $row['Monat'] = utf8_decode($row['Monat']), 1, 0, 'L');
            $this->Cell($w[2], 8, $row['Wohnungsnummer'], 1, 0, 'L');
            $this->Cell($w[3], 8, $row['Name'] = utf8_decode($row['Name']), 1, 0, 'L');
            $this->Cell($w[4], 8, $row['Vorname'] = utf8_decode($row['Vorname']), 1, 0, 'L');
            $this->Cell($w[5], 8, $row['Mietzins'], 1, 0, 'R');
            $this->Ln();
        }
        $this->Ln();
        $this->Cell($w[0], 8, '', 0, 0, 'L');
        $this->Cell($w[1], 8, '', 0, 0, 'L');
        $this->Cell($w[2], 8, '', 0, 0, 'L');
        $this->Cell($w[3], 8, '', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell($w[4], 8, 'Total', 1, 0, 'L');
        $this->Cell($w[5], 8, $gesamt, 1, 0, 'R');
    }



    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',10);
        // Autoren
        $autoren = utf8_decode('Silvan Hoppler, Steven Bühler, Bastian End');
        $this->Cell(0, 10, $autoren, 0, 0, 'L');
        // Page number
        $this->Cell(0, 10, 'Seite '.$this->PageNo().'/{nb}', 0, 0, 'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$header = array('Jahr', 'Monat', 'Wohnungs-Nr.', 'Name', 'Vorname', 'Betrag');
$data = $pdf->fetchData();
$gesamt = $pdf->fetchGesamt();
$pdf->AliasNbPages();
//$pdf->SetFont('Arial','',14);
$pdf->AddPage('L');
$pdf->createTable($header, $data, $gesamt);
//$pdf->SetFont('Times','',12);
$pdf->Output();
?>