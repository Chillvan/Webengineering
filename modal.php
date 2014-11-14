<?php

class modal {

    #################### Mieter Modal Forms #################### 
    #################### Neuer Mieter erfassen Modal #################### 
    public static function mieterErfassenModal(){
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
                              <label for="inputMieternummer">Mieternummer</label>
                              <input type="number" class="form-control" name="inputMieternummer" placeholder="Mieternummer" disabled="1">
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
    public static function mieterEditModal($dbh, $mr){
            
        echo '
            <div id="mieterEdit" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="mieterEdit.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Mieter anpassen</h4>
                  </div>
                  <div class="modal-body">
                          <div class="form-group">
                              <label for="inputMieternummer">Mieternummer</label>
                              <input type="number" class="form-control" name="inputMieternummer" placeholder="Mieternummer" disabled="1">
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
                    <button type="submit" value="'.$mr.'" name="edit'.$mr.'" class="btn btn-primary">Submit</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }

    #################### Mieter löschen Modal ####################
    public static function mieterDeleteModal($dbh, $mr, $name, $vorname){
        
               echo '
            <div id="mieterDelete'.$mr.'" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="mieterDelete.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Mieter löschen</h4>
                  </div>
                  <div class="modal-body">
                         <div class="form-group">
                              <p>'.$name." ".$vorname.'</p>
                          </div>
 
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="'.$mr.'" name="mieterdelete" class="btn btn-primary">Submit</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
            
    #################### Rechnungen Modal Forms ####################    
    #################### Rechnung erstellen Modal ####################
    public static function rechnungErfassenModal(){
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
                            <label for="inputRechnungsnummer">Rechnungsnummer</label>
                            <input type="number" class="form-control" name="inputRechnungsnummer" placeholder="Rechnungsnummer" disabled="1">
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
    #################### Rechnung löschen Modal ####################
    public static function rechnungDeleteModal($dbh, $rn, $name, $vorname, $typ, $betr){
        
               echo '
            <div id="rechnungDelete'.$rn.'" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form class="form" action="rechnungDelete.php" method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Mieter löschen</h4>
                  </div>
                  <div class="modal-body">
                         <div class="form-group">
                              <p>'.$name." ".$vorname."<br/>Rechnungstyp: ".$typ."<br/>Betrag: ".$betr.'</p>
                          </div>
 
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset">Reset</button>
                    <button type="submit" value="'.$rn.'" name="delete" class="btn btn-primary">Submit</button>
                  </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
}
 
