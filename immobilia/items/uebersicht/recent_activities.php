<?php

class RecentActivities {

  public static function createNews($titel, $zeit, $autor, $text) {
    ?>

    <li>
      <div class="block">
        <div class="block_content">
          <h2 class="title">
                            <a><?php echo $titel; ?></a>
                        </h2>
          <div class="byline">
            <span><?php echo $zeit; ?></span> von <a><?php echo $autor; ?></a>
          </div>
          <p class="excerpt">
          <?php echo $text; ?>
          </p>
        </div>
      </div>
    </li>

    <?php

  }
	
	
  public static function createActivities($width, $numberOfNews, $aktuellesGeschäftsjahr) {

    $query = "
    SELECT *
    FROM Neuigkeiten
    WHERE Jahr = '" . $aktuellesGeschäftsjahr ."'
    ;";
    $aktuelleNeuigkeiten = Database::sqlSelect($query);

    ?>

  	<div class=<?php echo "'col-md-$width col-sm-$width col-xs-12'"; ?>>
      <div class="x_panel">
        <div class="x_title">
          <h2>Aktuelle Neuigkeiten<small><?php echo date('Y'); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
              
              <?php

                for($i = 0; $i < sizeof($aktuelleNeuigkeiten); $i++) {

                  $zeit = date('d.m.Y');

                  RecentActivities::createNews($aktuelleNeuigkeiten[$i]["Titel"], $zeit, $aktuelleNeuigkeiten[$i]["Autor"], $aktuelleNeuigkeiten[$i]["Beschreibung"]);

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