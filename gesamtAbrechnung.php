<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Gesamtabrechnung</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        
        <div id="wrapper">
            
            <!--#################### Modalformular einfügen ####################--> 
            <?php
            include_once 'modal.php';
            modal::pdfDrucken();
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
                
                <!-- #################### Heizkostenrechnungen von Database #################### -->
                <div id="dbtable">
                    <?php

                    include_once 'configPDO.php';
                    
                    $anzeige = $_POST['anzeige'];
                    if($anzeige === null){
                        $anzeige = "";
                        $anzeigesum = "";
                    }
                    elseif($anzeige != ""){
                        $anzeigesum = "WHERE ".$anzeige;
                        $anzeige = "AND ".$anzeige;
                    }

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Rechnungs-Nr.</th><th>Rechnungstyp</th><th>Wohnungs-Nr.</th><th>Name</th>"
                    . "<th>Vorname</th><th>Betrag</th></tr>";
                    
                    foreach ($dbh->query('SELECT * FROM Rechnungen, Mieterspiegel WHERE Mieterspiegel.Mieternummer=Rechnungen.Mieternummer '
                            .$anzeige.'ORDER BY Rechnungsnummer ASC') as $row) {                    

                        print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Rechnungstyp'].
                                "</td><td>".$row['Wohnungsnummer']."</td><td>".$row['Name'].
                                "</td><td>".$row['Vorname']."</td><td>".$row['Betrag']."</td></tr>");
                        }
                        
                    $sth = ($dbh->query('SELECT SUM(Betrag) FROM Rechnungen '.$anzeigesum));
                    $gesamt = $sth->fetchColumn();
                    print_r("<tr><td></td><td></td><td></td><td></td><td></td><td>".$gesamt."</td></tr>");

                    echo "</table>";

                    unset($dbh);
                    ?>
                </div>
            
            
                <!-- #################### Button pdf ausdrucken #################### -->
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <a id="btn" data-target="#pdfDrucken" role="button" class="btn btn-default btn-lg" data-toggle="modal">Abrechnung als PDF ausdrucken</a>
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                
            <!-- #################### Anzeigeoptionen anzeigen #################### -->
            <?php
            echo '
                <form class="form" action="gesamtAbrechnung.php" method="post">
                    <label for="anzeige">Anzeigeoptionen</label>
                        <select class="form-control" name="anzeige">
                            <option value="">Alle Rechnungen anzeigen</option>
                            <option value="Bezahlt=1 ">Nur bezahlte Rechnungen anzeigen</option>
                            <option value="Bezahlt=0 ">Nur unbezahlte Rechnungen anzeigen</option>
                        </select>
                    <button type="submit" name="rechnungAnzeigen" class="btn btn-primary">Submit</button>
                </form>
                ';
            
            ?>
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


