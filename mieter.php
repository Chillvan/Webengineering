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
                <!-- #################### Mieter von Database in Tabelle ausgeben #################### -->
                <div id="dbtable">
                    <?php

                    include_once 'modal.php';
                    include_once 'configPDO.php';
                    
                    ### Logik für anzeigen-Knopf ###
                    $anzeigen = $_POST['nurAktiveAnzeigen'];
                    if($anzeigen === null){
                        $anzeigen = "WHERE Aktiv=1 ";
                    }

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Mieter-Nr.</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Mietzins</th><th>Aktiv</th><th></th></tr>";
                    
                    foreach ($dbh->query('SELECT * from Mieterspiegel '.$anzeigen.'ORDER BY Mieternummer ASC') as $row) {                    

                        ### Umwandlung binäre Information zu Text Ja/Nein ###
                        if($row['Aktiv'] == 1){
                            $aktiv = 'Ja';
                        }
                        else{
                            $aktiv = 'Nein';
                        }
                        
                        print_r("<tr><td>".$row['Mieternummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Strasse']."</td><td>".$row['PLZ'].
                            "</td><td>".$row['Ort']."</td><td>".$row['Mietzins'].
                            "</td><td>".$aktiv.
                            "</td><td><a data-target='#mieterEdit".$row['Mieternummer']."' role='button' class='btn btn-default btn-xs' data-toggle='modal'>ändern</a>");
                        
                        ### Laden des Modals ###
                        modal::mieterEditModal($dbh, $row['Mieternummer'], $row['Name'], 
                                $row['Vorname'], $row['Mietzins'], $row['Strasse'], $row['PLZ'], $row['Ort']);
                    }    
                    
                    echo "</table>";

                    unset($dbh);
                    ?>
                </div>
        
        
                <!-- #################### Button Neuer Mieter + Toggle Aktive/Inaktive Mieter #################### -->
                <div class="container">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p>
                            <!-- #################### Inaktive Mieter anzeigen #################### -->
                            <?php
                            if($anzeigen != ""){
                                echo '
                                <form action="mieter.php" method="post">
                                    <button id="btn-width-full" type="submit" value="" name="nurAktiveAnzeigen" class="btn btn-primary">Inaktive Mieter anzeigen</button>
                                </form>
                                ';
                            }
                            else{
                                echo '
                                <form action="mieter.php" method="post">
                                    <button id="btn-width-full" type="submit" value="WHERE Aktiv=1 " name="nurAktiveAnzeigen" class="btn btn-primary">Inaktive Mieter ausblenden</button>
                                </form>
                                ';
                            }
                            ?>
                            <a id="btn-width-full" data-target="#neuerMieter" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neuer Mieter erfassen</a>
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
