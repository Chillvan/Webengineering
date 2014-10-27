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
        <!-- Here goes our superb navbar -->
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
                <a class="navbar-brand" href="index.html">bendltd</a>
                </div>
                
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="mieter.php">Mieter</a></li>
                        <li><a href="rechnungen.php">Rechnungen</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Abrechnungen <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Gesamtabrechnung</a></li>
                                <li><a href="#">Heizkostenabrechnung</a></li>
                                <li><a href="#">Nebenkostenabrechnung</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Sign Up</a></li>
                        <li><a href="#">Sign In</a></li>
                    </ul>
                </div>
            </div>  
        </nav> 
        
        <!-- Mieterspiegel from database -->
        <div class="container">
            <?php
            $user = 'u566874539_admin';
            $pass = 'WEFHNW14';
            
            echo "<table class='table table-striped'>";
            echo "<tr><th>Rechnungsnummer</th><th>Wohnungsnummer</th><th>Name</th><th>Vorname</th><th>Rechnungstyp</th><th>Betrag</th><th>Bezahlt</th></tr>";
            
            try {
                $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
                foreach ($dbh->query('SELECT * from Rechnungen,Mieterspiegel '.'WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer') as $row) {
                
                    print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Wohnungsnummer'].
                            "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                            "</td><td>".$row['Rechnungstyp']."</td><td>".$row['Betrag'].
                            "</td><td>".$row['Bezahlt']."</td></tr>");
                }
                $dbh = null;
                } catch (PDOException $e) {
                   print "Error!: " . $e->getMessage() . "<br/>";
                   die();
                }
                echo "</table>";
                ?>
        </div>
        
        
        <!-- create button "Erfassen" -->
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                     <!--emtpy--> 
                </div>
                <div class="col-md-5">
                    <p>
                        <button type="button" class="btn btn-default btn-lg" href="#">Neuen Mieter erfassen</button>
                    </p>
                </div>
                <div class="col-md-5">
                     <!--emtpy--> 
                </div>
            </div>
        </div>
        
        
        <!-- little tiny footer -->
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
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
                    
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>