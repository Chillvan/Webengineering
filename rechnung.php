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
            
            
        <!-- #################### Neue Rechnung Erfassen Modal Form #################### -->    
        <div id="neueRechnung" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Neue Rechnung erfassen</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="neueRechnung.php" method="post">
                        <div class="form-group">
                            <label for="inputRechnungsnummer">Rechnungsnummer</label>
                            <input type="number" class="form-control" name="inputRechnungsnummer" placeholder="Rechnungsnummer" disabled="1">
                        </div>
                        <div class="form-group">
                            <label for="inputWohnungsnummer">Wohnungsnummer</label>
                            <input type="number" class="form-control" name="inputWohnungsnummer" placeholder="Wohnungsnummer">
                        </div>
<!--                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" name="inputName" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="inputVorname">Vorname</label>
                            <input type="text" class="form-control" name="inputVorname" placeholder="Vorname">
                        </div>-->
                        <div class="form-group">
                            <label for="rechnung">Rechnungstyp</label>
                            <div class="radio">
                                <label><input type="radio" name="rechnung" value="Reparatur">Reparatur</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="rechnung" value="Öl">Öl</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="rechnung" value="Wasser">Wasser</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="rechnung" value="Strom">Strom</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="rechnung" value="Hauswart">Hauswart</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBetrag">Betrag</label>
                            <input type="number" class="form-control" name="inputBetrag" placeholder="Betrag">
                        </div>
                        <div class="form-group">
                            <label for="inputDatum">Fälligkeitsdatum</label>
                            <input type="date" class="form-control" name="inputDatum">
                        </div>
                        <div class="form-group">
                            <label for="inputKommentar">Kommentar</label>
                            <input type="text" class="form-control" name="inputKommentar" placeholder="Kommentar">
                        </div>
                      <div class="checkbox">
                          <label><input name="inputBezahlt" value="1" type="checkbox">Bezahlt</label>
                      </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="send" name="submit" class="btn btn-primary">Submit</button>
                </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
        
            
            <div id="header">                
                <!-- #################### Navbar #################### -->
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
                                <li><a href="rechnung.php">Rechnungen</a></li>
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
            </div>
            <div id="content">  
                
                <!-- #################### Rechnungen von Database #################### -->
                <div class="container">
                    <?php
                    $user = 'u566874539_admin';
                    $pass = 'WEFHNW14';

                    echo "<table class='table table-striped'>";
                    echo "<tr><th>Rechnungs-<br/>nummer</th><th>Wohnungs-<br/>nummer</th><th>Name</th><th>Vorname</th><th>Rechnungstyp</th><th>Kommentar</th><th>Betrag</th><th>Fälligkeits-<br/>datum</th><th>Bezahlt</th></tr>";

                    try {
                        $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);
                        foreach ($dbh->query("SELECT * , DATE_FORMAT(Datum,'%d.%m.%Y') as DDatum from Rechnungen,Mieterspiegel WHERE Rechnungen.Mieternummer = Mieterspiegel.Mieternummer ORDER BY Rechnungsnummer ASC") as $row) {

                            print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Wohnungsnummer'].
                                    "</td><td>".$row['Name']."</td><td>".$row['Vorname'].
                                    "</td><td>".$row['Rechnungstyp']."</td><td>".$row['Kommentar'].
                                    "</td><td>".$row['Betrag']."</td><td>".$row['DDatum']."</td><td>".$row['Bezahlt'].
                                    "</td><td><button type='button' value=".$row['Rechnungsnummer']." class='btn btn-default btn-xs'>edit</button></td><td>".
                                    "</td><td><button type='button' class='btn btn-default btn-xs'>delete</button></td></tr>");
                        }
                        $dbh = null;
                        } catch (PDOException $e) {
                           print "Error!: " . $e->getMessage() . "<br/>";
                           die();
                        }
                        echo "</table>";
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
