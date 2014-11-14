<?php

class dbfunctions {
    
    public static function mietereintrag($dbh, $wnr, $name, $vname, $zins, $str, $plz, $ort, $aktiv){
        
        if ($aktiv == null){
            $aktiv = 0;
        }

        $stmt = $dbh->prepare("INSERT INTO Mieterspiegel(Wohnungsnummer,"
            . "Name,Vorname,Mietzins,Strasse,PLZ,Ort,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8)");
        $stmt->execute(array(':field1' => $wnr, ':field2' => $name, 
            ':field3' => $vname, ':field4' => $zins,':field5' => $str, 
            ':field6' => $plz, ':field7' => $ort, ':field8' => $aktiv));
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
        public static function mieteredit($dbh, $mnr, $wnr, $name, $vname, $zins, $str, $plz, $ort, $aktiv){

        $updatequery = "";
        
        if($wnr !== ""){
            $updatequery = "Wohnungsnummer= ".$wnr;
        }
        if($name !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Name= "'.$name.'"';
        }
        else if($name !== ""){
            $updatequery = $updatequery.', Name= "'.$name.'"';
        }
        if($vname !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Vorname= "'.$vname.'"';
        }
        else if($vname !== ""){
            $updatequery = $updatequery.', Vorname= "'.$vname.'"';
        }
        if($zins !== "" && $updatequery === ""){
            $updatequery = $updatequery."Mietzins= ".$zins;
        }
        else if($zins !== ""){
            $updatequery = $updatequery.", Mietzins= ".$zins;
        }
        if($str !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Strasse= "'.$str.'"';
        }
        else if($str !== ""){
            $updatequery = $updatequery.', Strasse= "'.$str.'"';
        }
        if($plz !== "" && $updatequery === ""){
            $updatequery = $updatequery."PLZ= ".$plz;
        }
        else if($plz !== ""){
            $updatequery = $updatequery.", PLZ= ".$plz;
        }
        if($ort !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Ort= "'.$ort.'"';
        }
        else if($ort !== ""){
            $updatequery = $updatequery.', Ort= "'.$ort.'"';
        }
        if ($aktiv == null){
        $aktiv = 0;
        }
        if($updatequery === ""){
            $updatequery = $updatequery = "Aktiv= ".$aktiv;
        }
        else if($updatequery !== ""){
            $updatequery = $updatequery.", Aktiv= ".$aktiv;
        }

        $stmt = $dbh->prepare("UPDATE Mieterspiegel SET ".$updatequery." WHERE Mieternummer=".$mnr);
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
        $stmt->execute(array(':field1' => $Mieternummer,
            ':field2' => $rtyp, ':field3' => $betrag, ':field4' => $datum,
            ':field5' => $komm, ':field6' => $bez));
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
    public static function rechnungdelete($dbh, $rn){
        
        $stmt = $dbh->prepare("DELETE FROM Rechnungen WHERE Rechnungsnummer=".$rn);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
        
    }
    
}

?>
