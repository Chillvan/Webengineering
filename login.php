<?php

include_once 'dbfunctions.php';
include_once 'configPDO.php';

session_start();
if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])){
    
    if(dbfunctions::loginauth($dbh, $_POST['inputUsername'], $_POST['inputPassword'])){
        $_SESSION['user'] = $_POST['inputUsername'];
        header('Location: index.php');
    }
    else{
        echo 'Login ist leider fehlgeschlagen. Bitte versuchen Sie es nochmal.';
    }
}
else{
    echo 'Bitte geben Sie die Login-Daten ein.';
}
