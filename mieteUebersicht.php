<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Übersicht Mieteingänge</title>
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
                
                <!-- #################### Mieteingänge von Database #################### -->
                <div id="dbtable">
                    <?php

                    include_once 'configPDO.php';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Jahr</th><th>Monat</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Betrag</th></tr>";

                    foreach ($dbh->query('SELECT * FROM Miete, Mieterspiegel WHERE Mieterspiegel.Mieternummer=Miete.Mieternummer ORDER BY Jahr ASC') as $row) {                    

                        print_r("<tr><td>".$row['Jahr']."</td><td>".$row['Monat'].
                                "</td><td>".$row['Wohnungsnummer']."</td><td>".$row['Name'].
                                "</td><td>".$row['Vorname']."</td><td>".$row['Mietzins']."</td></tr>");
                        }
                        
                    $sth = ($dbh->query('SELECT SUM(Mietzins) FROM Miete'));
                    $gesamt = $sth->fetchColumn();
                    print_r("<tr><td><b>Total</b></td><td></td><td></td><td></td><td></td><td>".$gesamt."</td></tr>");

                    echo "</table>";

                    unset($dbh);
                    ?>
                </div>
            
            
                <!-- #################### Button pdf ausdrucken #################### -->
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <a id="btn" data-target="#pdfDrucken" role="button" class="btn btn-default btn-lg" data-toggle="modal">Übersicht Miete als PDF ausdrucken</a>
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


