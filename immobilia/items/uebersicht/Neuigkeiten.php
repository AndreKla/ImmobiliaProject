<?php

class Neuigkeiten {

  public static function createNews($titel, $zeit, $autor, $text, $bild) {
    ?>

    <li>
      <div class="block col-md-12">
        <div class="block_content">
          <h2 class="title">
                            <a><?php echo $titel; ?></a>
                        </h2>
          <div class="byline">
            <span><?php echo $zeit; ?></span> von <a><?php echo $autor; ?></a>
          </div>
          <p class="excerpt col-md-8">
          <?php echo $text . $text; ?>
          </p>
          <img src=<?php echo "'$bild'"; ?> alt="News Bild" width="120px" height="85px">
        </div>
      </div>
    </li>

    <?php

  }
	
	
  public static function createNeuigkeiten($width, $aktuellesGeschäftsjahr) {

    $query = "
    SELECT *
    FROM Neuigkeiten
    WHERE Jahr = '" . $aktuellesGeschäftsjahr ."'
    ;";
    $aktuelleNeuigkeiten = Database::sqlSelect($query);

    $timeToAdd = $aktuellesGeschäftsjahr - 1;

    ?>

  	<div class=<?php echo "'col-md-$width col-sm-$width col-xs-12'"; ?>>
      <div class="x_panel">
        <div class="x_title">
          <h2>Aktuelle Neuigkeiten<small><?php echo date('Y', strtotime("+" . $timeToAdd . " year")); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
              
              <?php

                for($i = 0; $i < sizeof($aktuelleNeuigkeiten); $i++) {

                  $zeit = date('d.m.Y');

                  Neuigkeiten::createNews($aktuelleNeuigkeiten[$i]["Titel"], $zeit, $aktuelleNeuigkeiten[$i]["Autor"], $aktuelleNeuigkeiten[$i]["Beschreibung"], $aktuelleNeuigkeiten[$i]["Bild"]);

                }

              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  			
  <?php
  }
}
?>