<?php
    
    session_start();
    
    require_once("includes.php"); 
	
		Menu::includeHead();

    if($_SESSION["Runde"] == 0) {
      ?>
        <br><br>
        <div class="col-md-8 col-xs-12 col-md-offset-2">
          <div class="x_panel">
            <div class="x_title">
              <h2>Stammdatenblatt <small>Bitte geben Sie die Stammdaten Ihres Unternehmens an</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Name des Unternehmens</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" placeholder="Name des Unternehmens">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Rechtsform</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control">
                      <option>GmbH</option>
                      <option>Kommanditgesellschaft</option>
                      <option>GmbH & Co. KG</option>
                      <option>Aktiengesellschaft</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">1. Geschäftsführer</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Vorname">
                  </div>
                  <div class="col-md-5 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Nachname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">2. Geschäftsführer</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Vorname">
                  </div>
                  <div class="col-md-5 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Nachname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">3. Geschäftsführer</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Vorname">
                  </div>
                  <div class="col-md-5 col-sm-4 col-xs-12">
                    <input type="text" class="form-control" placeholder="Nachname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Startkapital </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" disabled="disabled" placeholder="10.000.000 €">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Neues Passwort</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="password" class="form-control" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Passwort bestätigen</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="password" class="form-control" value="">
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-9">
                    <button type="submit" class="btn btn-success">Stammdaten bestätigen</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

      <?php
    }
    else {
      ?>
        <script language="javascript">
            window.location.href = "neuigkeiten.php"
        </script>
      <?php
    }

?>





<?php

  Menu::createFooter();

?>
        
