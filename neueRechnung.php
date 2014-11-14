<?php
include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['rechnung']) 
        && !empty($_POST['inputBetrag']) && !empty($_POST['inputDatum']) 
        && !empty($_POST['inputKommentar']) && !empty($_POST['rechnungsubmit'])) {

    dbfunctions::rechnungseintrag($dbh, $_POST['inputWohnungsnummer'],$_POST['rechnung'],
            $_POST['inputBetrag'], $_POST['inputDatum'],
            $_POST['inputKommentar'],$_POST['inputBezahlt']);
    
    print_r($_POST);
    
    header('Location:rechnung.php');
        
}

else{
    echo 'Leider hat der Eintrag nicht geklappt';
}
?>