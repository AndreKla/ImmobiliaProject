<?php

class Strategie {

  public static function createStrategieInfo($id) {
  
    $query = "
    SELECT *
    FROM Strategien
    ;";
    $strategien = Database::sqlSelect($query);

    $spielID = $_SESSION["SID"];
    $unternehmensID = $_SESSION["UID"];

    $query = "
    SELECT Runde
    FROM Rundendaten
    WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
    ORDER BY Runde DESC
    ;";
    $runde = Database::sqlSelect($query);
    $aktuelleRunde = $runde[0]["Runde"] - 1;

    $überschrift = $strategien[$id]["Titel"];
    $titel = $strategien[$id]["Kennzahl"];
    $beschreibung = $strategien[$id]["Beschreibung"];
    

?>

    <div class="col-md-6 col-sm-6 col-xs-12" id=<?php echo "div" . $id; ?> hidden>
      <div class="x_panel">
        <div class="x_title">
          <h2 id="ueberschrift"><?php echo $überschrift; ?> <small><?php echo date('Y', strtotime("+" . $aktuelleRunde . " year")); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="bs-example" data-example-id="simple-jumbotron">
            <div class="jumbotron">
              <h3 id="titel"><?php echo $titel; ?></h3>
              <span id="beschreibung"><?php echo $beschreibung; ?></span>
            </div>
          </div>

        </div>
      </div>
    </div>

  <?php

  }

  public static function createStrategie($titel, $id) {

    if(isset($_GET["1"])) {
          $checked = "checked";
        }
        else {
          if(sizeof($_GET) > 0) {
            $checked = "disabled";
          }
        }

    $spielID = $_SESSION["SID"];
    $unternehmensID = $_SESSION["UID"];

    $query = "
    SELECT Strategie1, Strategie2, Strategie3
    FROM Rundendaten
    WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
    ORDER BY Runde DESC
    ;";
    $unternehmensStrategie = Database::sqlSelect($query);

    if(sizeof($unternehmensStrategie) > 0) {
      if($unternehmensStrategie[0]["Strategie1"] != 0) {
        if($unternehmensStrategie[0]["Strategie1"] == $id) {
          $checked = "checked";
        }
        else if($unternehmensStrategie[0]["Strategie2"] == $id) {
          $checked = "checked";
        }
        else if($unternehmensStrategie[0]["Strategie3"] == $id) {
          $checked = "checked";
        }
        else {
          $checked = "disabled";
        }
      }
      else {
        $checked = "";
      }
    }

    

    ?>
      <li class="strategy_item" id=<?php echo "'" . $id . "'"; ?> style="cursor: pointer">
        <p>
          <input type="checkbox" class="flat tests" name=<?php echo "'" . $id . "' "; ?> id=<?php echo "'" . $id . "' " . $checked; ?>> <?php echo $titel; ?> 
        </p>
      </li>
    <?php
  }
	
	
  public static function createStrategieListe($aktuellesGeschäftsjahr) {

    $query = "
    SELECT *
    FROM Strategien
    ;";
    $strategien = Database::sqlSelect($query);

    $disabled = "";

    if(sizeof($_GET) > 0) {
      $disabled = "disabled";
    }

?>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Unternehmensstrategie für <?php echo date('Y', strtotime("+$aktuellesGeschäftsjahr year")); ?><small id="zielLabel">0 von 3 Zielen gewählt</small></h2>
			<!-- Hilfe Funktionalität / Text / Popup-->
		    <?php include 'help/strategie_unternehmensstrategie_help.php'; ?>
		  <div class="clearfix"></div>
        </div>
        <div class="x_content" id="unternehmensziele">
          <div class="">
            <ul class="to_do">
            <?php

              if(isset($_GET["1"])) {

                $unternehmensID = $_SESSION["UID"];
                $spielID = $_SESSION["SID"];
                $runde = $_SESSION["Runde"];

                $strat1 = $_GET["1"];
                $strat2 = $_GET["2"];
                $strat3 = $_GET["3"];
                $strat4 = $_GET["4"];

                $query = "
                UPDATE Rundendaten
                SET Strategie1 = '" . $strat1 . "', Strategie2 = '" . $strat2 ."', Strategie3 = '" . $strat3 ."', Begruendung = '" . $strat4 ."'
                WHERE UnternehmensID = $unternehmensID AND SpielID = $spielID AND Runde = $runde
                ;";
                Database::sqlUpdate($query);
              }

              for($i = 0; $i < sizeof($strategien); $i++) {
                Strategie::createStrategie($strategien[$i]["Titel"], $i+1);
              }
            ?>
            </ul>
          </div>
          <input type="button" id="ziele_speichern" class="btn_" value="Jahresziele festlegen" style="float: right;" <?php echo " " . $disabled; ?>>
        </div>
      </div>
    </div>
				
						  
<?php
}

    public static function createBegruendung($aktuellesGeschäftsjahr){
        
        
    ?>
      
    <div class="clearfix"></div>
    
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Begründung für <?php echo date('Y', strtotime("+$aktuellesGeschäftsjahr year")); ?></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="unternehmensziele">
            <div class="col-md-12">
	            <label for="message">Bitte gib hier deine Begründung ein:</label><br>
	            <label for="message"> - Wieso hast du dich dafür entschieden?</label>
	            <textarea id="message" required="required" class="form-control" 
	                      name="message" data-parsley-trigger="keyup" data-parsley-minlength="100" 
	                      data-parsley-maxlength="800" data-parsley-minlength-message="Bitte gebe hier deine Begründung ein"
	                      data-parsley-validation-threshold="10" style="resize:none; height: 200px;"> 
	            </textarea>
            </div>
        </div>        
      </div>
    </div>
      
    <?php
    }
}
?>