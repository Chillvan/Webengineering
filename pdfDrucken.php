<?php
	
define('FPDF_INSTALLDIR', '../fpdf17');

if(!defined('FPDF_FONTPATH')) define('FPDF_FONTPATH', FPDF_INSTALLDIR.'/font/');
include(FPDF_INSTALLDIR.'/fpdf.php');

// Prüfen ob die Klasse existiert
if(class_exists('FPDF')) {
  // Die Klasse existiert, Installation ok
  die("Die Installation war erfolgreich. Die Klasse FPDF existiert.");
} else {
  // Die Klasse existiert nicht
  die("Die Klasse FPDF existiert nicht.
       Prüfen Sie, ob die Datei '".FPDF_INSTALLDIR."/fpdf.php' vorhanden ist."); 
}

?>


