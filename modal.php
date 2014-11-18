<?php

class modal {

    #################### Mieter Modal Forms #################### 
    #################### Neuer Mieter erfassen Modal #################### 
    public static function mieterErfassenModal($dbh){
        
        $stmt = ($dbh->query("SELECT Mieternummer FROM Mieterspiegel ORDER BY Mieternummer DESC LIMIT 1"));
        $nextMieternr = $stmt->fetchColumn() +1;
        
        echo '
            <div id="neuerMieter" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="neuerMieter.php" method="post">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Neuer Mieter erfassen</h4>
                    </div>
                <div class="modal-body">
                          <div class="form-group">
                              <label>Mieternummer '.$nextMieternr.'</label>
                          </div>
                          <div class="form-group">
                              <label for="inputWohnungsnummer">Wohnungsnummer</label>
                              <input type="number" class="form-control" name="inputWohnungsnummer" placeholder="Wohnungsnummer">
                          </div>
                          <div class="form-group">
                              <label for="inputName">Name</label>
                              <input type="text" class="form-control" name="inputName" placeholder="Name">
                          </div>
                          <div class="form-group">
                              <label for="inputVorname">Vorname</label>
                              <input type="text" class="form-control" name="inputVorname" placeholder="Vorname">
                          </div>
                          <div class="form-group">
                              <label for="inputMietzins">Mietzins</label>
                              <input type="number" class="form-control" name="inputMietzins" placeholder="Mietzins">
                          </div>
                          <div class="form-group">
                              <label for="inputStrasse">Strasse</label>
                              <input type="text" class="form-control" name="inputStrasse" placeholder="Strasse & Hausnummer">
                          </div>
                          <div class="form-group">
                              <label for="inputPLZ">PLZ</label>
                              <input type="text" class="form-control" name="inputPLZ" placeholder="PLZ">
                          </div>
                          <div class="form-group">
                              <label for="inputOrt">Ort</label>
                              <input type="text" class="form-control" name="inputOrt" placeholder="Ort">
                          </div>
                          <div class="checkbox">
                              <label>
                              <input name="inputAktiv" value="1" type="checkbox">Aktiv
                              </label>
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="send" name="eintragsubmit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
    
    #################### Mieter editieren Modal ####################
    public static function mieterEditModal($dbh, $mnr, $wnr, $name, $vname, $zins, $str, $plz, $ort){
            
        echo '
            <div id="mieterEdit'.$mnr.'" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="mieterEdit.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Mieter Nr. '.$mnr.' anpassen</h4>
                  </div>
                  <div class="modal-body">
                          <div class="form-group">
                              <label for="inputWohnungsnummer">Wohnungsnummer</label>
                              <input type="number" class="form-control" name="inputWohnungsnummer" placeholder="'.$wnr.'">
                          </div>
                          <div class="form-group">
                              <label for="inputName">Name</label>
                              <input type="text" class="form-control" name="inputName" placeholder="'.$name.'">
                          </div>
                          <div class="form-group">
                              <label for="inputVorname">Vorname</label>
                              <input type="text" class="form-control" name="inputVorname" placeholder="'.$vname.'">
                          </div>
                          <div class="form-group">
                              <label for="inputMietzins">Mietzins</label>
                              <input type="number" class="form-control" name="inputMietzins" placeholder="'.$zins.'">
                          </div>
                          <div class="form-group">
                              <label for="inputStrasse">Strasse</label>
                              <input type="text" class="form-control" name="inputStrasse" placeholder="'.$str.'">
                          </div>
                          <div class="form-group">
                              <label for="inputPLZ">PLZ</label>
                              <input type="text" class="form-control" name="inputPLZ" placeholder="'.$plz.'">
                          </div>
                          <div class="form-group">
                              <label for="inputOrt">Ort</label>
                              <input type="text" class="form-control" name="inputOrt" placeholder="'.$ort.'">
                          </div>
                          <div class="checkbox">
                              <label>
                              <input name="inputAktiv" value="1" type="checkbox">Aktiv
                              </label>
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="'.$mnr.'" name="mieteredit" class="btn btn-primary">Submit</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
            
    #################### Rechnungen Modal Forms ####################    
    #################### Rechnung erstellen Modal ####################
    public static function rechnungErfassenModal($dbh){
        
        $stmt = ($dbh->query("SELECT Rechnungsnummer FROM Rechnungen ORDER BY Rechnungsnummer DESC LIMIT 1"));
        $nextnr = $stmt->fetchColumn() +1;
        
        echo '
            <div id="neueRechnung" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="neueRechnung.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Neue Rechnung erfassen</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label>Rechnungsnummer '.$nextnr.'</label>
                        </div>
                        <div class="form-group">
                            <label for="inputWohnungsnummer">Wohnungsnummer</label>
                            <input type="number" class="form-control" name="inputWohnungsnummer" placeholder="Wohnungsnummer">
                        </div>
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
                    <button type="submit" value="send" name="rechnungsubmit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        ';
    }
    
    #################### Rechnung editieren Modal ####################
    public static function rechnungEditModal($rnr, $wnr, $betrag, $komm){
        
        echo '
            <div id="rechnungEdit'.$rnr.'" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="rechnungEdit.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Rechnung Nr. '.$rnr.' bearbeiten</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="inputWohnungsnummer">Wohnungsnummer</label>
                            <input type="number" class="form-control" name="inputWohnungsnummer" placeholder="'.$wnr.'">
                        </div>
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
                            <input type="number" class="form-control" name="inputBetrag" placeholder="'.$betrag.'">
                        </div>
                        <div class="form-group">
                            <label for="inputDatum">Fälligkeitsdatum</label>
                            <input type="date" class="form-control" name="inputDatum">
                        </div>
                        <div class="form-group">
                            <label for="inputKommentar">Kommentar</label>
                            <input type="text" class="form-control" name="inputKommentar" placeholder="'.$komm.'">
                        </div>
                      <div class="checkbox">
                          <label><input name="inputBezahlt" value="1" type="checkbox">Bezahlt</label>
                      </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="'.$rnr.'" name="rechnungsedit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        ';
    }
    
    #################### Rechnung löschen Modal ####################
    public static function rechnungDeleteModal($rnr, $name, $vorname, $typ, $betr){
        
               echo '
            <div id="rechnungDelete'.$rnr.'" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="rechnungDelete.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Rechnung löschen</h4>
                  </div>
                  <div class="modal-body">
                         <div class="form-group">
                              <p>'.$name." ".$vorname."<br/>Rechnungstyp: ".$typ."<br/>Betrag: ".$betr.'</p>
                          </div>
 
                  <div class="modal-footer">
                    <button type="submit" value="'.$rnr.'" name="rechnungdelete" class="btn btn-primary">Ok</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
    
    #################### PDF ausdrucken ####################
    public static function pdfDrucken() {
        echo '
            <div id="pdfDrucken" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="pdfDrucken.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Gesamtabrechnung als PDF drucken</h4>
                  </div>
                  <div class="modal-body">
                    <p>Sind Sie sicher, dass Sie die Gesamtabrechnung als PDF drucken wollen?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
                    <button type="button" class="btn btn-primary">Ja</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
}
 
