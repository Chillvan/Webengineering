<?php

class footer {
    public static function createFooter() {
        
        echo '                
            <footer class="site-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <p>Designed and built by Silvan Hoppler, Steven Bühler and Bastian End.</p>
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
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Kontakt</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>';        
    }
}
?>


