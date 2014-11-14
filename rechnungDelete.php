<meta charset="UTF-8">
<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(isset($_POST['rechnungdelete'])){

dbfunctions::rechnungdelete($dbh, $_POST['rechnungdelete']);

header('Location:rechnung.php');
}
else{
    echo 'Löschung ging leider nicht. Hier gehts zurück zur Übersicht.';
}

?>

