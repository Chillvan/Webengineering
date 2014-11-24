<?php
include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(!empty($_POST['inputMonat']) && !empty($_POST['inputJahr']) && !empty($_POST['mietebezahlt'])) {

    dbfunctions::mieteerfassen($dbh, $_POST['mietebezahlt'], $_POST['inputWohnungsnummer'] ,
            $_POST['inputMietzins'], $_POST['inputMonat'], $_POST['inputJahr']);
    
    unset($dbh);
    
    header('Location:miete.php');
        
}
else{
    echo '<html><meta charset="UTF-8"><title>Fehler</title><body><p>Leider hat es nicht funktioniert. '
    . 'Bitte füllen Sie alle Eingabefelder aus.<br/>'
    . '<a href="miete.php">Zurück zum Mieteingang erfassen.</a></body></html>';
}
?>