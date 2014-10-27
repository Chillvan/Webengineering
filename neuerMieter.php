<meta http-equiv="content-type" content="text/html; charset=utf-8">

<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php
$user = 'u566874539_admin';
$pass = 'WEFHNW14';
try {
    $dbh = new PDO('mysql:host=mysql.hostinger.de;dbname=u566874539_ftw', $user, $pass);

echo '
<html>
    <head><title>Mieter erfassen</title></head>
    <body>
        <h2> Neuen Mieter erfassen </h2>
        <form method="post" action="neuerMieter.php">
        Mieternummer: <input type="text" name="Mieternummer" value="test" disabled="1"/><br/>
        Wohnungsnummer: <input type="text" name="Wohnungsnummer"/><br/>
        Name: <input type="text" name="Name"/><br/>
        Vorname: <input type="text" name="Vorname"/><br/>
        Mietzins: <input type="text" name="Mietzins"/><br/>
        Rechnungsadresse: <input type="text" name="Rechnungsadresse"/><br/>
        Aktiv: <input type="checkbox" name="Aktiv" value="1"/><br/>
        <input type="submit" value="Absenden"/>
        <input type="reset" value="Löschen"/>
        </form>
        <a href="mieter.php">Zurück zum Mieterspiegel</a>
        
    </body>   
</html>

';

if(!empty($_POST['Wohnungsnummer']) && !empty($_POST['Name']) && !empty($_POST['Vorname']) 
        && !empty($_POST['Mietzins']) && !empty($_POST['Rechnungsadresse']) && isset($_POST['submit'])) {
        
        if (empty($_POST['Aktiv'])){
            $_POST['Aktiv'] = 0;
        }
        
        $stmt = $dbh->prepare("INSERT INTO Mieterspiegel(Wohnungsnummer,"
            . "Name,Vorname,Mietzins,Rechnungsadresse,Aktiv)"
            . " VALUES(:field1,:field2,:field3,:field4,:field5,:field6)");
        $stmt->execute(array(':field1' => $_POST['Wohnungsnummer'],
            ':field2' => $_POST['Name'], ':field3' => $_POST['Vorname'], ':field4' => $_POST['Mietzins'],
            ':field5' => $_POST['Rechnungsadresse'], ':field6' => $_POST['Aktiv']));
        $affected_rows = $stmt->rowCount();
        
        echo "Neuer Mieter ".$_POST['Name']." ".$_POST['Vorname']." wurde erfasst.<br/>";
    }
    else{
        echo 'Bitte füllen Sie alle Felder aus<br/>';
    }
    
        $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
?>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>