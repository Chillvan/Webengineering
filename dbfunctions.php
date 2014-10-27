<?php

class dbfunctions {
    // Login Variabeln
    private static $user = 'u566874539_admin';
    private static $pass = 'WEFHNW14';
    
    public static function mietereintrag($wnr, $name, $vname, $zins, $radresse, $aktiv){
        
        if ($aktiv == null){
            $aktiv = 0;
        }
        
        try {
        $dbhf = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', self::$user, self::$pass);
        
        $stmt = $dbhf->prepare("INSERT INTO Mieterspiegel(Wohnungsnummer,"
            . "Name,Vorname,Mietzins,Rechnungsadresse,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6)");
        $stmt->execute(array(':field1' => $wnr,
            ':field2' => $name, ':field3' => $vname, ':field4' => $zins,
            ':field5' => $radresse, ':field6' => $aktiv));
        $affected_rows = $stmt->rowCount();
        
        unset($dbhf);
        
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        echo 'DB Verbindung klappt nicht';
        die();
}
    }
    
}

?>
