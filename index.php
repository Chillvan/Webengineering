<?php
session_start();
session_regenerate_id();
?>

<html>
    <head>
        <title>Mietverwaltung 12-Familienhaus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="wrapper">
        
            <!-- ################### Modal für Login ################### -->
            <div id="login" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form" action="login.php" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Login</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input type="text" class="form-control" name="inputUsername" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="reset">Reset</button>
                            <button type="submit" value="send" name="loginsubmit" class="btn btn-primary">Login</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <!-- #################### Navbar #################### -->
            <div id="header">                                
                <?php
                include_once 'navbar.php';
                navbar::createNavbar($_SESSION['user']);
                ?>
            </div>
            
            <!-- ################### Main Content ###################-->
            <div id="content">            
                <div class="bg"></div>
                <div class="jumbotron">
                  <h1>Mietverwaltung Mehrfamilienhaus</h1>
                  <p class="lead">--> Webengineering WIVZ 3.51</p>
                </div>
            </div>
        
            <!-- ################### Footer ################### -->
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
