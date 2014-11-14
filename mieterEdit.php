<meta charset="UTF-8">
<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(isset($_POST['mieteredit'])){

dbfunctions::mieteredit($dbh, $_POST['mieteredit']);

header('Location:mieter.php');
}
else{
    echo 'Löschung ging leider nicht. Hier gehts zurück zur Übersicht.';
}

?>