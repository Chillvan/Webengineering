<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Mieteingang erfassen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-table.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        
        <!-- #################### PW Change Modal #################### -->
        <?php
        include_once 'modal.php';
        modal::passwordChangeModal();
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
                <!-- #################### Aktive Mieter von Database #################### -->
                <div id="dbtable" class="tablesmall">
                    <?php

                    include_once 'modal.php';
                    include_once 'configPDO.php';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Mieter-Nr.</th><th>Wohnungs-Nr.</th><th>Name</th><th>Vorname</th><th>Mietzins</th><th></th></tr>";
                    
                    foreach ($dbh->query('SELECT * from Mieterspiegel WHERE Aktiv=1 ORDER BY Mieternummer ASC') as $row) {                    

                        print_r("<tr><td>".$row['Mieternummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Mietzins'].
                            "</td><td><a data-target='#mieteBezahlt".$row['Mieternummer']."' role='button' class='btn btn-default btn-xs' data-toggle='modal'>Eingang erfassen</a>");
                        modal::mieteBezahltModal($row['Mieternummer'], $row['Wohnungsnummer'], $row['Name'], 
                                $row['Vorname'], $row['Mietzins']);
                    }    
                    
                    echo "</table>";

                    unset($dbh);
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
