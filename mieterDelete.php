<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

if(isset($_POST['delete'])){

dbfunctions::mieterdelete($dbh, $_POST['submitdelete']);
}
else{
    echo 'geht ned';
}

?>

