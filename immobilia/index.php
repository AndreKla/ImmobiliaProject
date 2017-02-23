<?php session_start(); ?>

<?php
    
    require_once("includes.php"); 
	
		Menu::includeHead();

    if(isset($_POST["unternehmensname"])) {
      
      $id = $_SESSION["UID"];
      $sid = $_SESSION["SID"];

      $unternehmensname = $_POST["unternehmensname"];

      if($_POST["rechtsform"] == "GmbH") {
        $unternehmensname = $unternehmensname . " GmbH";
      }
      else if($_POST["rechtsform"] == "Aktiengesellschaft") {
        $unternehmensname = $unternehmensname . " AG";
      }
      else if($_POST["rechtsform"] == "Kommanditgesellschaft") {
        $unternehmensname = $unternehmensname . " KG";
      }
      else if($_POST["rechtsform"] == "GmbH & Co. KG") {
        $unternehmensname = $unternehmensname . " GmbH & Co. KG";
      }
      if(isset($_POST["gf1"])) {

        if(isset($_POST["gf2"])) {

          if(isset($_POST["gf3"])) {
            $query = "UPDATE Unternehmen
            SET Unternehmensname = '" . $unternehmensname . "', Spieler1 = '" . $_POST['gf1'] . "', Spieler2 = '" . $_POST['gf2'] . "', Spieler3 = '" . $_POST['gf3'] . "', Passwort = '" . md5($_POST['passwort']) . "'
            WHERE ID = $id
            ;";
            Database::sqlUpdate($query);

            $query = "INSERT INTO Rundendaten (SpielID, UnternehmensID, Runde, Kapital, Strategie1, Strategie2, Strategie3, Social)
                    VALUES ('" . $sid . "', '" . $id . "', 1, 1000000, 0, 0, 0, 0);";
            Database::sqlInsert($query);
            ?>
              <script language="javascript">
                  window.location.href = "neuigkeiten.php"
              </script>
            <?php    
                    
          }
          else {
            $query = "UPDATE Unternehmen
            SET Unternehmensname = '" . $unternehmensname . "', Spieler1 = '" . $_POST['gf1'] . "', Spieler2 = '" . $_POST['gf2'] . "', Passwort = '" . md5($_POST['passwort']) . "'
            WHERE ID = $id
            ;";
            Database::sqlUpdate($query);

            $query = "INSERT INTO Rundendaten (SpielID, UnternehmensID, Runde, Kapital, Strategie1, Strategie2, Strategie3, Social)
                    VALUES ('" . $sid . "', '" . $id . "', 1, 1000000, 0, 0, 0, 0);";
            Database::sqlInsert($query);

            echo "sid: " . $sid . " id: " . $id;

          ?>
            <script language="javascript">
                //window.location.href = "neuigkeiten.php"
            </script>
          <?php
          }

        }
        else {
          $query = "UPDATE Unternehmen
          SET Unternehmensname = '" . $unternehmensname . "', Spieler1 = '" . $_POST['gf1'] . "', Passwort = '" . md5($_POST['passwort']) . "'
          WHERE ID = $id
          ;";
          Database::sqlUpdate($query);

          $query = "INSERT INTO Rundendaten (SpielID, UnternehmensID, Runde, Kapital, Strategie1, Strategie2, Strategie3, Social)
                    VALUES ('" . $sid . "', '" . $id . "', 1, 1000000, 0, 0, 0, 0);";
          Database::sqlInsert($query);

          echo "sid: " . $sid . " id: " . $id;

          ?>
            <script language="javascript">
                //window.location.href = "neuigkeiten.php"
            </script>
          <?php

        }

      }
      else {
        echo "Kein Geschäftsführer eingetragen";
      }

    }
    else {
      if($_SESSION["Runde"] == 0) {
        ?>
          <br><br>
          <div class="col-md-8 col-xs-12 col-md-offset-2">
            <div class="x_panel">
              <div class="x_title">
                <h2>Stammdatenblatt <small>Bitte legen Sie die Stammdaten Ihres Unternehmens an</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" action="index.php" method="POST">

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unternehmensname">Name des Unternehmens <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="unternehmensname" name="unternehmensname" required="required" placeholder="Name des Unternehmens" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rechtsform">Rechtsform <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" name="rechtsform">
                        <option>GmbH</option>
                        <option>Kommanditgesellschaft</option>
                        <option>GmbH & Co. KG</option>
                        <option>Aktiengesellschaft</option>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf1">1. Geschäftsführer <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gf1" placeholder="Vor- und Zuname" required="required" type="text">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf2">2. Geschäftsführer
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gf2" placeholder="Vor- und Zuname" type="text">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf3">3. Geschäftsführer 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gf3" placeholder="Vor- und Zuname" type="text">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="startkapital">Startkapital 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" class="form-control" disabled="disabled" placeholder="10.000.000 €" value="10000000" name="startkapital">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label for="password" class="control-label col-md-3">Neues Passwort</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="passwort" type="password" name="passwort" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Passwort bestätigen</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="passwort2" type="password" name="passwort2" data-validate-linked="passwort" class="form-control col-md-7 col-xs-12" required="required">
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
    }

  Menu::createFooter();

  ?>

    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.empty = 'Bitte ausfüllen!';
      validator.message.complete = 'Vor- und Nachname!';
      validator.message.password_repeat = 'Passwörter nicht gleich!';
      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);
      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });
      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }
        if (submit)
          this.submit();
        return false;
      });
    </script>
    <!-- /validator -->

  <?php

?>
        
