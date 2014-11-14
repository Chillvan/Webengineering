<html>
    <head>
        <title>Nebenkostenabrechung</title>
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
            modal::mieterErfassenModal();
            ?>

            <!-- #################### Navbar #################### -->
            <div id="header">                                
                <?php
                include_once 'navbar.php';
                navbar::createNavbar();
                ?>
            </div>
            
            
            
            <!-- #################### Heizkostenrechnungen von Database #################### -->
            <div class="container">
                <?php

                //include_once 'modal.php';
                include_once 'configPDO.php';

                echo "<table class='table table-striped'>";
                echo "<tr><th>Rechnungsnummer</th><th>Rechnungstyp</th><th>Wohnungsnummer</th><th>Name</th><th>Vorname</th><th>Betrag</th></tr>";

                foreach ($dbh->query('SELECT * FROM Rechnungen WHERE Rechnungstyp="Öl" ORDER BY Rechnungsnummer ASC') as $row) {                    

                print_r("<tr><td>".$row['Rechnungsnummer']."</td><td>".$row['Rechnungstyp'].
                        "</td><td>".$row['Wohnungsnummer']."</td><td>".$row['Name'].
                        "</td><td>".$row['Vorname']."</td><td>".$row['Betrag']);
                }    



                echo "</table>";
                echo "</div>";

                unset($dbh);
                ?>
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


