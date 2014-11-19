<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Nebenkostenabrechung</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        
        <div id="wrapper">

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

                    //include_once 'modal.php';
                    include_once 'configPDO.php';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Rechnungs-<br/>nummer</th><th>Rechnungstyp</th><th>Wohnungs-<br/>nummer</th><th>Name</th><th>Vorname</th><th>Betrag</th></tr>";

                    foreach ($dbh->query('SELECT * FROM Rechnungen, Mieterspiegel WHERE Rechnungen.Rechnungstyp!="Öl" AND Mieterspiegel.Mieternummer=Rechnungen.Mieternummer ORDER BY Rechnungsnummer ASC') as $row) {                    

                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Rechnungstyp'].
                            "</td><td>".$row['Wohnungsnummer']."</td><td>".$row['Name'].
                            "</td><td>".$row['Vorname']."</td><td>".$row['Betrag']."</td></tr>");
                    }    

                    $sth = ($dbh->query('SELECT SUM(Betrag) FROM Rechnungen WHERE Rechnungen.Rechnungstyp!="Öl"'));
                    $gesamt = $sth->fetchColumn();
                    print_r("<tr><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>".$gesamt."</tr>");

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
        </div>
        
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script> 
    </body>
</html>


