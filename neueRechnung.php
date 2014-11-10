<?php
include_once 'dbfunctions.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['rechnung']) 
        && !empty($_POST['inputBetrag']) && !empty($_POST['inputDatum']) 
        && !empty($_POST['inputKommentar']) && !empty($_POST['submit'])) {

    dbfunctions::rechnungseintrag($_POST['inputWohnungsnummer'],$_POST['rechnung'],
            $_POST['inputBetrag'], $_POST['inputDatum'],
            $_POST['inputKommentar'],$_POST['inputBezahlt']);
    
    header('Location:rechnung.php');
        
}

else{
    echo 'Leider hat der Eintrag nicht geklappt';
}
?>