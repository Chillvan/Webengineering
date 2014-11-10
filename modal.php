<?php

class modal {

    public static function mietererfassenmodal(){
        echo '
            <div id="neuerMieter" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Neuer Mieter erfassen</h4>
                  </div>
                  <div class="modal-body">
                      <form class="form" action="neuerMieter.php" method="post">
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
                    <button type="submit" value="send" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
    
        public static function mietereditmodal(){
            
        echo '
            <div id="mieterEdit" class="modal fade" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Mieter anpassen</h4>
                  </div>
                  <div class="modal-body">
                      <form class="form" action="mieterEdit.php" method="post">
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
                    <button type="submit" value="send" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            ';
    }
}
