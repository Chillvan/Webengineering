<html>
    <head>
        <link rel="stylesheet" href="mycss.css" type="text/css">
        <title>Rechnungen</title>
    </head>
    <body>
    <h1>Rechnungen</h1>
    <ul>
        <li><a class="aheader" href = "mieter.php">//Mieter</a></li>
        <li><a class="aheader" href = "rechnungen.php">//Rechnungen</a></li>
        <li><a class="aheader" href = "abrechnung.php">//Abrechnung</a></li>
        <li><a class="aheader" href = "nebenabrechnungen.php">//Heizkosten- und Nebenkostenabrechnung</a></li>
        <li id="line">&nbsp;</li>
    </ul>
    
    <?php
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
try {
    $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
    foreach ($dbh->query('SELECT * from Rechnungen,Mieterspiegel '
            . 'WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer') as $row) {
    print_r("Rechnungsnummer: ".$row['Rechnungsnummer']." | Wohnungsnummer: ".$row['Wohnungsnummer'].
            " | Name: ".$row['Name']." | Vorname: ".$row['Vorname'].
            " | Rechnungstyp: ".$row['Rechnungstyp']." | Betrag: ".$row['Betrag'].
            " | bezahlt: ".$row['Bezahlt']."<br/>");
   }
   $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}

?>
<a align="right" href = "neueRechnung.php">Neue Rechnung erfassen</a>
    </body>
</html>