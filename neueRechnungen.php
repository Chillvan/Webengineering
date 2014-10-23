<meta http-equiv="content-type" content="text/html; charset=utf-8">

<html>
    <head><title>Rechnung erfassen</title></head>
    <body>
        <h2> Neuen Rechnung erfassen </h2>
        <form method="post" action="neueRechnungen.php">
        Wohnungsnummer: <input type="text" name="Wohnungsnummer"/><br/>
        Rechnungstyp: <select name="Rechnungstyp" size="0">
            <option>Hauswart</option>
            <option>Öl</option>
            <option>Reparatur</option>
            <option>Strom</option>
            <option>Wasser</option>
        </select><br/>
        Betrag: <input type="text" name="Betrag"/><br/>
        Datum: <input type="date" name="Datum"/><br/>
        Kommentar: <textarea name="Kommentar" cols="30" rows="5" wrap="soft"></textarea><br/>
        bezahlt?: <input type="checkbox" name="Bezahlt" value="1"/><br/>
        <input type="submit" value="Absenden"/>
        <input type="reset" value="Löschen"/>
        </form>
        <a href="rechnungen.php">Zurück zu Rechnungen</a>
        
    </body>   
</html>

<?php
// Verbindung zu Datenbank herstellen
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
try {
    $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
    
    if(isset($_POST['Wohnungsnummer']) and isset($_POST['Rechnungstyp']) 
        and isset($_POST['Betrag']) and isset($_POST['Datum']) 
        and isset($_POST['Kommentar'])) {
        
        if (empty($_POST['Bezahlt'])){
            $_POST['Bezahlt'] = 0;
        }
        
        // noch anpassen auf Rechnungen
        $stmt = $dbh->prepare("INSERT INTO Rechnungen(Mieternummer,Wohnungsnummer,"
                . "Name,Vorname,Mietzins,Rechnungsadresse,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7)");
        $stmt->execute(array(':field1' => $_POST['Mieternummer'], ':field2' => $_POST['Wohnungsnummer'],
            ':field3' => $_POST['Name'], ':field4' => $_POST['Vorname'], ':field5' => $_POST['Mietzins'],
            ':field6' => $_POST['Rechnungsadresse'], ':field7' => $_POST['Aktiv']));
        $affected_rows = $stmt->rowCount();
        
        echo "Neuer Mieter ".$_POST['Name']." ".$_POST['Vorname']." wurde erfasst.<br/>";
    }
    else{
        echo 'Bitte füllen Sie alle Felder aus<br/>';
    }

    
   $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
?>

