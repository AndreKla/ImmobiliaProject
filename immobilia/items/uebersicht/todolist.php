<?php

class Strategie {

  public static function createStrategie($beschreibung) {
    ?>
      <li>
        <p>
          <input type="checkbox" class="flat"> <?php echo $beschreibung; ?> 
        </p>
      </li>
    <?php
  }
	
	
  public static function createStrategieListe($aktuellesGeschäftsjahr) {

    $anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Strategien
    ;";
    $strategien = Database::sqlSelect($query);

?>

				<div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Unternehmensstrategie für <?php echo date('Y', strtotime("+$aktuellesGeschäftsjahr year")); ?><small>0 von 3 Zielen gewählt</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                        <?php
                          for($i = 0; $i < sizeof($strategien); $i++) {
                            Strategie::createStrategie($strategien[$i]["Beschreibung"]);
                          }
                        ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
				
						  
<?php
}}
?>