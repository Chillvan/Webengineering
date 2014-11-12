<?php
$host = 'mysql:host=mysql.hostinger.de;dbname=u566874539_ftw';
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
    
try {
    $dbh = new PDO($host, $user, $pass);
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();   
    }
    
?>
