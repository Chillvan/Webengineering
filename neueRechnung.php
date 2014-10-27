<?php
include_once 'dbfunctions.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['inputName']) && !empty($_POST['inputVorname']) 
        && !empty($_POST['inputMietzins']) && !empty($_POST['inputRechnungsadresse']) && !empty($_POST['submit'])) {

    dbfunctions::rechnungseintrag($_POST['inputWohnungsnummer'] ,$_POST['rechnung'],$_POST['inputBetrag'],
            date(),$_POST['inputKommentar'],$_POST['inputBezahlt']);
    
    header('Location:rechnung.php');
        
}
?>