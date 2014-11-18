<?php

#################### Datenbankfunktionen ####################
class dbfunctions {
    
    #################### User Berechtigung prüfen ####################
    public static function loginauth($dbh, $user, $pw){
        $loginquery = ($dbh->query("SELECT * FROM Login"));
        $logindata = $loginquery->fetchAll();
        
        if($logindata[0][0] == $user && $logindata[0][1] == $pw){
            return true;
        }
        unset($dbh);
    }
    
    #################### Passwort mit altem und wiederholtem PW vergleichen ####################
    public static function pwcheck($dbh, $user, $alt, $neu, $erneut){
        $query = ($dbh->query("SELECT Password FROM Login WHERE User='".$user."'"));
        $pwdb = $query->fetchColumn();
        
        if($pwdb == $alt && $neu == $erneut && $neu !=""){
            return true;
        }
        unset($dbh);
    }
    
    #################### Änderung des Passwortes in der DB vornehmen ####################
    public static function pwchange($dbh, $user, $pw){
        
        $stmt = $dbh->prepare("UPDATE Login SET Password='".$pw."' WHERE User='".$user."'");
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
    }
    
    #################### Prüfen welche Wohnungen belegt sind ####################
    public static function belegtewohnungen($dbh){
        
        $query = $dbh->query("SELECT Wohnungsnummer FROM Mieterspiegel WHERE Aktiv=1 ORDER BY Wohnungsnummer ASC");
        $queryresult = $query->fetchAll(PDO::FETCH_NUM);
        $laenge = count($queryresult);
        $belegteWohnungen = array();
        for($i = 0;$i <= $laenge; $i++){
            $belegteWohnungen[$i] = $queryresult[$i][0];
        }
        unset($dbh);
        
        return $belegteWohnungen;
    }    

    #################### Prüfen welche Wohnungen frei sind ####################
    public static function freiewohnungen($belegt){
        
        $Wohnungen = array(1,2,3,4,5,6,7,8,9,10,11,12);
        $freieWohnungen = array_diff($Wohnungen, $belegt);
        
        return $freieWohnungen;
    }
    
    #################### Neuen Mieter in DB eintragen ####################
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
    
    #################### Bestehenden Mieter in Datenbank ändern ####################
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
    
    #################### Neue Rechnung in DB erfassen ####################
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
    
    #################### Bestehende Rechnung in DB verändern ####################
    public static function rechnungsedit($dbh, $rnr, $wnr, $rtyp, $betrag, $datum, $komm, $bez){
        
        $updatequery = "";
        
        if($wnr !== ""){
            $updatequery = "Wohnungsnummer= ".$wnr;
        }
        if($rtyp !== null && $updatequery === ""){
            $updatequery = $updatequery.'Rechnungstyp= "'.$rtyp.'"';
        }
        else if($rtyp !== null){
            $updatequery = $updatequery.', Rechnungstyp= "'.$rtyp.'"';
        }
        if($betrag !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Betrag= '.$betrag;
        }
        else if($betrag !== ""){
            $updatequery = $updatequery.', Betrag= '.$betrag;
        }
        if($datum !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Datum= "'.$datum.'"';
        }
        else if($datum !== ""){
            $updatequery = $updatequery.', Datum= "'.$datum.'"';
        }
        if($komm !== "" && $updatequery === ""){
            $updatequery = $updatequery.'Kommentar= "'.$komm.'"';
        }
        else if($komm !== ""){
            $updatequery = $updatequery.', Kommentar= "'.$komm.'"';
        }
        if ($bez == null){
        $bez = 0;
        }
        if($updatequery === ""){
            $updatequery = $updatequery = "Bezahlt= ".$bez;
        }
        else if($updatequery !== ""){
            $updatequery = $updatequery.", Bezahlt= ".$bez;
        }
        
        $stmt = $dbh->prepare("UPDATE Rechnungen SET ".$updatequery." WHERE Rechnungsnummer=".$rnr);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
    }
    
    #################### Rechnung aus Datenbank löschen ####################
    public static function rechnungdelete($dbh, $rnr){
        
        $stmt = $dbh->prepare("DELETE FROM Rechnungen WHERE Rechnungsnummer=".$rnr);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        
        unset($dbh);
    }
    
}

?>
