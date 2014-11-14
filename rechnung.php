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
            
            
        <!-- #################### Modalformular einfügen #################### -->
            <?php
            include_once 'modal.php';
            modal::rechnungErfassenModal();
            ?>
        
        
            
            <!-- #################### Navbar #################### -->
            <div id="header">                                
                <nav class="navbar navbar-inverse navbar-static-top no-margin" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.html"><img id="logo" src="img/logo.png"></a>
                        </div>


                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="mieter.php">Mieter</a></li>
                                <li><a href="rechnung.php">Rechnungen</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Abrechnungen <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="gesamtAbrechnung.php">Gesamtabrechnung</a></li>
                                        <li><a href="heizkostenAbrechnung.php">Heizkostenabrechnung</a></li>
                                        <li><a href="nebenkostenAbrechnung.php">Nebenkostenabrechnung</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" data-target="#login" data-toggle="modal">Login</a></li>
                            </ul>
                        </div>
                    </div>  
                </nav>
            </div>
        
        
            <div id="content">  
                
                <!-- #################### Rechnungen von Database #################### -->
                <div class="container">
                <?php

                include_once 'modal.php';
                include_once 'configPDO.php';
                
                echo "<table class='table table-striped'>";
                echo "<tr><th>Rechnungs-<br/>nummer</th><th>Wohnungs-<br/>nummer</th><th>Name</th><th>Vorname</th><th>Rechnungstyp</th><th>Kommentar</th><th>Betrag</th><th>Fälligkeits-<br/>datum</th><th>Bezahlt</th></tr>";

                foreach ($dbh->query("SELECT * , DATE_FORMAT(Datum,'%d.%m.%Y') as DDatum from Rechnungen,Mieterspiegel WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer ORDER BY Rechnungsnummer ASC") as $row) {

                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Rechnungstyp']."</td><td>".$row['Kommentar'].
                            "</td><td>".$row['Betrag']."</td><td>".$row['DDatum']."</td><td>".$row['Bezahlt'].
                            "</td><td><a data-target='#rechnungEdit' role='button' class='btn btn-default btn-xs' data-toggle='modal'>edit</a></td><td>".
                            "</td><td><a data-target='#rechnungDelete".$row['Rechnungsnummer']."' role='button' class='btn btn-default btn-xs' value=".$row['Rechnungsnummer']." data-toggle='modal'>delete</a></td><td>");
                    modal::rechnungDeleteModal($dbh, $row['Rechnungsnummer'], $row['Name'], $row['Vorname'], $row['Rechnungstyp'], $row['Betrag']);
                }

                        echo "</table>";
                        
                        unset($dbh);
                        ?>
                </div>
        
        
        <!-- #################### Button Neue Rechnung #################### -->
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                     <!--emtpy--> 
                </div>
                <div class="col-md-5">
                    <p>
                        <a data-target="#neueRechnung" role="button" class="btn btn-default btn-lg" data-toggle="modal">Neue Rechnung erfassen</a>
                    </p>
                </div>
                <div class="col-md-5">
                     <!--emtpy--> 
                </div>
            </div>
        </div>
        
        
            <!-- #################### Footer #################### -->
            <div id="footer">
                <footer class="site-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <p>Designed and built with all the force in the world by Silvan Hoppler, Steven Bühler and Bastian End.</p>
                            </div>
                        </div>
                        <div class="bottom-footer">
                            <div class="col-md-5">
                                <p>&copy; Copyright by bendltd 2014 -
                                    <script language="JavaScript" type="text/javascript">
                                    now = new Date
                                    theYear=now.getYear()
                                    if (theYear < 1900)
                                    theYear=theYear+1900
                                    document.write(theYear)
                                    </script>
                                </p>
                            </div>
                            <div class="col-md-7">
                                <ul class="footer-nav">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Kontakt</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
                    
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
