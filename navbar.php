<?php

class navbar {
    public static function createNavbar() {
        echo '    
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
                </nav>';
    }
}
?>


