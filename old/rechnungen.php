<html>
    <head>
        <title>Rechnungen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
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