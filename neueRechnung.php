<?php
include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['rechnung']) 
        && !empty($_POST['inputBetrag']) && !empty($_POST['inputDatum']) 
        && !empty($_POST['rechnungsubmit'])) {

    dbfunctions::rechnungseintrag($dbh, $_POST['inputWohnungsnummer'],$_POST['rechnung'],
            $_POST['inputBetrag'], $_POST['inputDatum'],
            $_POST['inputKommentar'],$_POST['inputBezahlt']);
    
    unset($dbh);
    
    header('Location:rechnung.php');
        
}

else{
    echo '<html><meta charset="UTF-8"><title>Fehler</title><body><p>Leider hat es nicht funktioniert. '
    . 'Bitte füllen Sie alle Eingabefelder aus.<br/>'
    . '<a href="rechnung.php">Zurück zum Rechnungen erfassen.</a></body></html>';
}
?>