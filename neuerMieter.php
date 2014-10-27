<?php
include_once 'dbfunctions.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['inputName']) && !empty($_POST['inputVorname']) 
        && !empty($_POST['inputMietzins']) && !empty($_POST['inputRechnungsadresse']) && !empty($_POST['submit'])) {

    dbfunctions::mietereintrag($_POST['inputWohnungsnummer'] ,$_POST['inputName'],$_POST['inputVorname'],
            $_POST['inputMietzins'],$_POST['inputRechnungsadresse'],$_POST['inputAktiv']);
    
    header('Location:mieter.php');
        
}
?>