<meta charset="UTF-8">
<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(isset($_POST['rechnungsedit'])){

    dbfunctions::rechnungsedit($dbh, $_POST['rechnungsedit'], $_POST['inputWohnungsnummer'],
        $_POST['rechnung'], $_POST['inputBetrag'], $_POST['inputDatum'],
        $_POST['inputKommentar'], $_POST['inputBezahlt']);
    
    unset($dbh);

header('Location:rechnung.php');
}
else{
    echo 'Löschung ging leider nicht. Hier gehts zurück zur Übersicht.';
}

?>