<?php

class Strategie {

  public static function createStrategieInfo($id) {
  
    $query = "
    SELECT *
    FROM Strategien
    ;";
    $strategien = Database::sqlSelect($query);

    $überschrift = $strategien[$id]["Titel"];
    $titel = $strategien[$id]["Kennzahl"];
    $beschreibung = $strategien[$id]["Beschreibung"];

?>

    <div class="col-md-6 col-sm-6 col-xs-12" id=<?php echo "div" . $id; ?> hidden>
      <div class="x_panel">
        <div class="x_title">
          <h2 id="ueberschrift"><?php echo $überschrift; ?> <small><?php echo date('Y'); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="bs-example" data-example-id="simple-jumbotron">
            <div class="jumbotron">
<<<<<<< Updated upstream
              <h1><?php echo $strategien[0]["Titel"]; ?></h1>
              <p><?php echo $strategien[0]["Beschreibung"]; ?></p>
=======
              <h3 id="titel"><?php echo $titel; ?></h3>
              <span id="beschreibung"><?php echo $beschreibung; ?></span>
>>>>>>> Stashed changes
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

    $query = "
    SELECT Strategie1, Strategie2, Strategie3
    FROM Unternehmen
    WHERE ID = 1
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
          <div class="clearfix"></div>
        </div>
        <div class="x_content" id="unternehmensziele">
          <div class="">
            <ul class="to_do">
            <?php

              if(isset($_GET["1"])) {
                $strat1 = $_GET["1"];
                $strat2 = $_GET["2"];
                $strat3 = $_GET["3"];

                $query = "
                UPDATE Unternehmen
                SET Strategie1 = '" . $strat1 . "', Strategie2 = '" . $strat2 ."', Strategie3 = '" . $strat3 ."'
                WHERE ID = 1
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
}}
?>