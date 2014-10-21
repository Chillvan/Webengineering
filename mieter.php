<meta http-equiv="content-type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" href="mycss.css" type="text/css">
<title>Mietverwaltung 12-Familienhaus</title>
</head>
<body>
    <header>
        <div class="inner">
            <a href = "mieter.php">Mieter</a>
            <a href = "rechnungen.php">Rechnungen</a>
            <a href = "abrechnung.php">Abrechnung</a>
            <a href = "nebenabrechnungen.php">Heizkosten- und Nebenkostenabrechnung</a>
        </div>
    </header>
<h1>Mieter</h1>
<p class = "nav">
	<a href = "mieter.php">Mieter</a>
	<a href = "rechnungen.php">Rechnungen</a>
	<a href = "abrechnung.php">Abrechnung</a>
	<a href = "nebenabrechnung.php">Heizkosten- und Nebenkostenabrechnung</a>
</p>

<?php
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
try {
    $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
    foreach ($dbh->query('SELECT * from Mieterspiegel') as $row) {
    print_r("Mieternummer: ".$row['Mieternummer']." | Wohnungsnummer: ".$row['Wohnungsnummer'].
            " | Name: ".$row['Name']." | Vorname: ".$row['Vorname'].
            " | Mietzins: ".$row['Mietzins']."%"." | Rechnungsadresse: ".$row['Rechnungsadresse'].
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