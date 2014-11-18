<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Mieterspiegel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="wrapper">

            <!-- #################### Modalformular einfügen #################### -->
            <?php
            include_once 'modal.php';
            include_once 'configPDO.php';
            modal::mieterErfassenModal($dbh);
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
                <!-- #################### Mieter von Database #################### -->
                <div id="dbtable">
                    <?php

                    include_once 'modal.php';
                    include_once 'configPDO.php';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Mieter-<br/>nummer</th><th>Wohnungs-<br/>nummer</th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Mietzins</th><th>Aktiv</th><th></th></tr>";

                    foreach ($dbh->query('SELECT * from Mieterspiegel WHERE Aktiv=1 ORDER BY Mieternummer ASC') as $row) {                    

                        print_r("<tr><td>".$row['Mieternummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Strasse']."</td><td>".$row['PLZ'].
                            "</td><td>".$row['Ort']."</td><td>".$row['Mietzins'].
                            "</td><td>".$row['Aktiv'].
                            "</td><td><a data-target='#mieterEdit".$row['Mieternummer']."' role='button' class='btn btn-default btn-xs' data-toggle='modal'>edit</a>");
                        modal::mieterEditModal($dbh, $row['Mieternummer'], $row['Name'], 
                                $row['Vorname'], $row['Mietzins'], $row['Strasse'], $row['PLZ'], $row['Ort']);
                    }    

                    echo "</table>";

                    unset($dbh);
                    ?>
                </div>
        
        
                <!-- #################### Button Neuer Mieter #################### -->
                <div id="btnerfassen">
                        <div class="col-md-5">
                             <!--emtpy--> 
                        </div>
                        <div class="col-md-5">
                            <p>
                                <a data-target="#neuerMieter" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neuer Mieter erfassen</a>
                            </p>
                        </div>
                        <div class="col-md-5">
                             <!--emtpy--> 
                        </div>
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
