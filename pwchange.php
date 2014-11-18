<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <title>Passwort ändern</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" href="css/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div id="wrapper">

            <!-- #################### Navbar #################### -->
            <div id="header">                                
                <?php
                include_once 'navbar.php';
                navbar::createNavbar($_SESSION['user']);
                ?>
            </div>
        
            <!-- ################### Main Content ###################-->
            <div id="content">  

<?php
include_once 'dbfunctions.php';                
include_once 'configPDO.php';

if(dbfunctions::pwcheck($dbh, $_SESSION['user'], $_POST['altesPw'], $_POST['neuesPw'], $_POST['erneutPw'])){
    dbfunctions::pwchange($dbh, $_SESSION['user'], $_POST['neuesPw']);
    
    echo 'Das Passwort wurde erfolgreich geändert.';
}
else{
    echo 'Das Passwort konnte nicht geändert werden. Bitte versuchen Sie es erneut.';
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
    </body>
</html>


