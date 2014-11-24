<?php
include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(!empty($_POST['inputWohnungsnummer']) && !empty($_POST['inputName']) 
        && !empty($_POST['inputVorname']) && !empty($_POST['inputMietzins'])
        && !empty($_POST['inputStrasse']) && !empty($_POST['inputPLZ'])
        && !empty($_POST['inputOrt']) && !empty($_POST['eintragsubmit'])) {

    dbfunctions::mietereintrag($dbh, $_POST['inputWohnungsnummer'] ,$_POST['inputName'],
            $_POST['inputVorname'], $_POST['inputMietzins'],
            $_POST['inputStrasse'], $_POST['inputPLZ'],
            $_POST['inputOrt'], $_POST['inputAktiv']);
    
    unset($dbh);
    
    
    header('Location:mieter.php');
        
}
else{
    echo '<html><meta charset="UTF-8"><title>Fehler</title><body><p>Leider hat es nicht funktioniert. '
    . 'Bitte füllen Sie alle Eingabefelder aus.<br/>'
    . '<a href="mieter.php">Zurück zum Mieter erfassen.</a></body></html>';
}
?>