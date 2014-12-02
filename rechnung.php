<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Rechnungen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-table.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
            <!--#################### Modalformular einfügen #################### -->
            <?php
            include_once 'modal.php';
            include_once 'configPDO.php';
            modal::rechnungErfassenModal($dbh);
            ?>

            <!-- #################### Navbar #################### -->
            <div id="header">                                
                <?php
                include_once 'navbar.php';
                navbar::createNavbar($_SESSION['user']);
                ?>
            </div>
        
            <!-- ################### Main Content ###################-->
            <div id="content">  
                
                <!-- #################### Rechnungen von Database in Tabelle ausgeben #################### -->
                <div id="dbtable">
                <?php

                include_once 'modal.php';
                include_once 'configPDO.php';
                
                ### Dynamische Ausgabe je nach Anzeige-Selektion ###
                $anzeige = $_POST['anzeige'];
                if($anzeige === null){
                    $anzeige = "";
                }
                
                echo "<table class='table table-striped'>";
                echo "<tr><th>Rechnungs-Nr.</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Rechnungstyp</th>"
                . "<th>Kommentar</th><th>Betrag</th><th>Fälligkeitsdatum</th><th>Bezahlt</th><th></th><th></th></tr>";
                
                foreach ($dbh->query("SELECT * , DATE_FORMAT(Datum,'%d.%m.%Y') as DDatum from Rechnungen,Mieterspiegel "
                        . "WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer ".$anzeige."ORDER BY Rechnungsnummer ASC") as $row) {

                    if($row['Bezahlt'] == 1){
                        $bezahlt = 'Ja';
                    }
                    else{
                        $bezahlt = 'Nein';
                    }
                    
                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Rechnungstyp']."</td><td>".$row['Kommentar'].
                            "</td><td>".$row['Betrag']."</td><td>".$row['DDatum']."</td><td>".$bezahlt.
                            "</td><td><a data-target='#rechnungEdit".$row['Rechnungsnummer']."' role='button' class='btn btn-default btn-xs' value=".$row['Rechnungsnummer']." data-toggle='modal'>ändern</a>".
                            "</td><td><a data-target='#rechnungDelete".$row['Rechnungsnummer']."' role='button' class='btn btn-default btn-xs' value=".$row['Rechnungsnummer']." data-toggle='modal'>löschen</a>");
                    
                    ### Laden der Modale ###
                    modal::rechnungEditModal($dbh, $row['Rechnungsnummer'], $row['Betrag'], $row['Kommentar']);
                    modal::rechnungDeleteModal($row['Rechnungsnummer'], $row['Name'], $row['Vorname'], $row['Rechnungstyp'], $row['Betrag']);
                }

                echo "</table>";
                        
                unset($dbh);
                ?>
                </div>
        
        
                <!-- #################### Button Neue Rechnung + Anzeigeoption #################### -->
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <!-- #################### Anzeigeoptionen anzeigen #################### -->
                            <?php
                            echo '
                                <form class="form" action="rechnung.php" method="post">
                                    <label for="anzeige">Anzeigeoptionen</label>
                                        <select class="form-control" name="anzeige">
                                            <option value="">Alle Rechnungen anzeigen</option>
                                            <option value="AND Bezahlt=1 ">Nur bezahlte Rechnungen anzeigen</option>
                                            <option value="AND Bezahlt=0 ">Nur unbezahlte Rechnungen anzeigen</option>
                                        </select>
                                    <button id="btn-width-full" type="submit" name="rechnungAnzeigen" class="btn btn-primary">Absenden</button>
                                    <br/>
                                </form>
                                ';
                            ?>
                            <a id="btn-width-full" data-target="#neueRechnung" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neue Rechnung erfassen</a>
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        
        
            <!-- #################### Footer #################### -->
            <div id="footer">
                <?php
                include_once 'footer.php';
                footer::createFooter();
                ?>
            </div>
                    
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-table.min.js"></script>
    </body>
</html>
