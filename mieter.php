<meta http-equiv="content-type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" href="mycss.css" type="text/css">
<title>Mietverwaltung 12-Familienhaus</title>
</head>
<body>
    <h1>Mieterspiegel</h1>
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
    foreach ($dbh->query('SELECT * from Mieterspiegel') as $row) {
    print_r("Mieternummer: ".$row['Mieternummer']." | Wohnungsnummer: ".$row['Wohnungsnummer'].
            " | Name: ".$row['Name']." | Vorname: ".$row['Vorname'].
            " | Mietzins: ".$row['Mietzins']." | Rechnungsadresse: ".$row['Rechnungsadresse'].
            " | Aktiv: ".$row['Aktiv']."<br/>");
   }
   $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}

?>
<a align="right" href = "neuerMieter.php">Neuen Mieter erfassen</a>
</body>
</html>