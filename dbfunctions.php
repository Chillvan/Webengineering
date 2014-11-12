<?php

class dbfunctions {
    
    public static function mietereintrag($dbh, $wnr, $name, $vname, $zins, $strasse, $plz, $ort, $aktiv){
        
        if ($aktiv == null){
            $aktiv = 0;
        }

        $stmt = $dbh->prepare("INSERT INTO Mieterspiegel(Wohnungsnummer,"
            . "Name,Vorname,Mietzins,Strasse,PLZ,Ort,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8)");
        $stmt->execute(array(':field1' => $wnr, ':field2' => $name, 
            ':field3' => $vname, ':field4' => $zins,':field5' => $strasse, 
            ':field6' => $plz, ':field7' => $ort, ':field8' => $aktiv));
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
        public static function mieterdelete($dbh, $mr){
        
        $stmt = $dbh->prepare("DELETE FROM Mieterspiegel WHERE Mieternummer=".$mr);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
    public static function rechnungseintrag($dbh, $wnr, $rtyp, $betrag, $datum, $komm, $bez){
        
        if ($bez == null){
            $bez = 0;
        }
        
        $queryresult = ($dbh->query('SELECT Mieternummer FROM Mieterspiegel WHERE Wohnungsnummer='.$wnr.' AND Aktiv=1'));
        $Mieternummer = $queryresult->fetchColumn();
        
        $stmt = $dbh->prepare("INSERT INTO Rechnungen(Mieternummer,"
            . "Rechnungstyp,Betrag,Datum,Kommentar,Bezahlt)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6)");
        $stmt->execute(array(':field1' => $Mieternummer['Mieternummer'],
            ':field2' => $rtyp, ':field3' => $betrag, ':field4' => $datum,
            ':field5' => $komm, ':field6' => $bez));
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
}

?>
