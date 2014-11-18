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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="wrapper">
   
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
                
                <!-- #################### Rechnungen von Database #################### -->
                <div id="dbtable">
                <?php

                include_once 'modal.php';
                include_once 'configPDO.php';
                
                echo "<table class='table table-striped'>";
                echo "<tr><th>Rechnungs-<br/>nummer</th><th>Wohnungs-<br/>nummer</th><th>Name</th><th>Vorname</th><th>Rechnungstyp</th><th>Kommentar</th><th>Betrag</th><th>Fälligkeits-<br/>datum</th><th>Bezahlt</th><th></th><th></th></tr>";

                foreach ($dbh->query("SELECT * , DATE_FORMAT(Datum,'%d.%m.%Y') as DDatum from Rechnungen,Mieterspiegel WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer ORDER BY Rechnungsnummer ASC") as $row) {

                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Rechnungstyp']."</td><td>".$row['Kommentar'].
                            "</td><td>".$row['Betrag']."</td><td>".$row['DDatum']."</td><td>".$row['Bezahlt'].
                            "</td><td><a data-target='#rechnungEdit".$row['Rechnungsnummer']."' role='button' class='btn btn-default btn-xs' value=".$row['Rechnungsnummer']." data-toggle='modal'>edit</a>".
                            "</td><td><a data-target='#rechnungDelete".$row['Rechnungsnummer']."' role='button' class='btn btn-default btn-xs' value=".$row['Rechnungsnummer']." data-toggle='modal'>delete</a>");
                    modal::rechnungEditModal($dbh, $row['Rechnungsnummer'], $row['Betrag'], $row['Kommentar']);
                    modal::rechnungDeleteModal($row['Rechnungsnummer'], $row['Name'], $row['Vorname'], $row['Rechnungstyp'], $row['Betrag']);
                }

                echo "</table>";
                        
                unset($dbh);
                ?>
                </div>
        
        
                <!-- #################### Button Neue Rechnung #################### -->
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <a id="btn" data-target="#neueRechnung" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neue Rechnung erfassen</a>
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
        </div>
                    
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
