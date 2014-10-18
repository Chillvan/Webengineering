<meta http-equiv="content-type" content="text/html; charset=utf-8">

<html>
    <head><title>Mieter erfassen</title></head>
    <body>
        <h2> Neuen Mieter erfassen </h2>
        <form method="post" action="neuerMieter.php">
        Mieternummer: <input type="text" name="Mieternummer"/><br/>
        Wohnungsnummer: <input type="text" name="Wohnungsnummer"/><br/>
        Name: <input type="text" name="Name"/><br/>
        Vorname: <input type="text" name="Vorname"/><br/>
        Mietzins: <input type="text" name="Mietzins"/><br/>
        Rechnungsadresse: <input type="text" name="Rechnungsadresse"/><br/>
        Aktiv: <input type="checkbox" name="Aktiv" value="1"/><br/>
        <input type="submit" value="Absenden"/>
        <input type="reset" value="Löschen"/>
        </form>
        <a href="mieter.php">Zurück zum Mieterspiegel</a>
        
    </body>   
</html>

<?php
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
try {
    $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
    
    if(isset($_POST['Mieternummer']) and isset($_POST['Wohnungsnummer']) 
        and isset($_POST['Name']) and isset($_POST['Vorname']) 
        and isset($_POST['Mietzins']) and isset($_POST['Rechnungsadresse'])) {
        
        if (empty($_POST['Aktiv'])){
            $_POST['Aktiv'] = 0;
        }
        
        $stmt = $dbh->prepare("INSERT INTO Mieterspiegel(Mieternummer,Wohnungsnummer,"
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

