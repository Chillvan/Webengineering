<?php

class dbfunctions {
    // Login Variabeln
    private static $user = 'u566874539_admin';
    private static $pass = 'WEFHNW14';
    
    public static function mietereintrag($wnr, $name, $vname, $zins, $strasse, $plz, $ort, $aktiv){
        
        if ($aktiv == null){
            $aktiv = 0;
        }
        
        try {
        $dbhm = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', self::$user, self::$pass);
        
        $stmt = $dbhm->prepare("INSERT INTO Mieterspiegel(Wohnungsnummer,"
            . "Name,Vorname,Mietzins,Strasse,PLZ,Ort,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8)");
        $stmt->execute(array(':field1' => $wnr, ':field2' => $name, 
            ':field3' => $vname, ':field4' => $zins,':field5' => $strasse, 
            ':field6' => $plz, ':field7' => $ort, ':field8' => $aktiv));
        $affected_rows = $stmt->rowCount();
        
        unset($dbhm);
        
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
            
        }
    }
    
    public static function rechnungseintrag($wnr, $rtyp, $betrag, $datum, $komm, $bez){
        
        if ($bez == null){
            $bez = 0;
        }
        
        try {
        $dbhr = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', self::$user, self::$pass);
        
        $queryresult = ($dbhr->query('SELECT Mieternummer FROM Mieterspiegel WHERE Wohnungsnummer='.$wnr.' AND Aktiv=1'));
        $Mieternummer = $queryresult->fetchColumn();
        
        $stmt = $dbhr->prepare("INSERT INTO Rechnungen(Mieternummer,"
            . "Rechnungstyp,Betrag,Datum,Kommentar,Bezahlt)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6)");
        $stmt->execute(array(':field1' => $Mieternummer['Mieternummer'],
            ':field2' => $rtyp, ':field3' => $betrag, ':field4' => $datum,
            ':field5' => $komm, ':field6' => $bez));
        $affected_rows = $stmt->rowCount();
        
        unset($dbhr);
        
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
            
        }
        
    }
    
}

?>
