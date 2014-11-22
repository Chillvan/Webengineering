<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Heizkostenabrechnung</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
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
                <div class="tablesmall" id="dbtable">
                    <?php

                    //include_once 'modal.php';
                    include_once 'configPDO.php';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Rechnungs-Nr.</th><th>Rechnungstyp</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Betrag</th></tr>";

                    foreach ($dbh->query('SELECT * FROM Rechnungen, Mieterspiegel WHERE Rechnungen.Rechnungstyp="Öl" AND Mieterspiegel.Mieternummer=Rechnungen.Mieternummer ORDER BY Rechnungsnummer ASC') as $row) {                    

                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Rechnungstyp'].
                            "</td><td>".$row['Wohnungsnummer']."</td><td>".$row['Name'].
                            "</td><td>".$row['Vorname']."</td><td>".$row['Betrag']."</td></tr>");
                    }  

                    $sth = ($dbh->query('SELECT SUM(Betrag) FROM Rechnungen WHERE Rechnungen.Rechnungstyp="Öl"'));
                    $gesamt = $sth->fetchColumn();
                    print_r("<tr><td><b>Total</b></td><td></td><td></td><td></td><td></td><td><b>".$gesamt."</b></td></tr>");




                    echo "</table>";
                    echo "</div>";

                    unset($dbh);
                    ?>
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
    </body>
</html>


