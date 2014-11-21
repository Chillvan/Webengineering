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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-table.min.css">
        <link rel="stylesheet" href="css/style.css">
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
                    
                    $anzeigen = $_POST['nurAktiveAnzeigen'];
                    if($anzeigen === null){
                        $anzeigen = "WHERE Aktiv=1 ";
                    }

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Mieter-Nr.</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Mietzins</th><th>Aktiv</th><th></th></tr>";
                    
                    foreach ($dbh->query('SELECT * from Mieterspiegel '.$anzeigen.'ORDER BY Mieternummer ASC') as $row) {                    

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
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <a id="btn" data-target="#neuerMieter" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neuer Mieter erfassen</a>
                        </p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            
            <!-- #################### Inaktive Mieter anzeigen #################### -->
            <?php
            if($anzeigen != ""){
                echo '
                <form action="mieter.php" method="post">
                    <button type="submit" value="" name="nurAktiveAnzeigen" class="btn btn-primary">Inaktive Mieter anzeigen</button>
                </form>
                ';
            }
            else{
                echo '
                <form action="mieter.php" method="post">
                    <button type="submit" value="WHERE Aktiv=1 " name="nurAktiveAnzeigen" class="btn btn-primary">Inaktive Mieter ausblenden</button>
                </form>
                ';
            }
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
        <script src="js/bootstrap-table.min.js"></script>
    </body>
</html>
