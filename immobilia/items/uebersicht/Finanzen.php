<?php

class Finanzen {

  public static function createKontostandEntwicklung($width) {

    $timeToAdd = $_SESSION["Runde"] - 1;

    ?>

    <div class=<?php echo "'col-md-$width col-sm-$width col-xs-12'"; ?>>
      <div class="x_panel">
        <div class="x_title">
          <h2>Kontostand<small>Aktuelles Jahr: <?php echo date('Y', strtotime("+" . $timeToAdd . " year")); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="kontostand"></canvas>
        </div>
      </div>
    </div>


    <?php
  }

  public static function createEinnahmenliste($year) {
  ?>
    <div class="col-md-3 col-sm-3 col-xs-3">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Einnahmen <small>2017</small></h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled scroll-view">
          <?php

          $sid = $_SESSION["SID"];
          $uid = $_SESSION["UID"];

          $query = "
          SELECT * 
          FROM Einnahmen
          WHERE SpielID = $sid AND UnternehmensID = $uid
          ;";
          $einnahmen = Database::sqlSelect($query);

          for($i = 0; $i < sizeof($einnahmen); $i++) {

          ?>
          <li class="media event">
            <a class="pull-left border-green profile_thumb">
              <i class="fa fa-eur green"></i>
            </a>
            <div class="media-body">
              <a class="title" href="#"><?php echo $einnahmen[$i]["Beschreibung"]; ?></a>
              <p><strong><?php echo number_format($einnahmen[$i]["Summe"], 2, ',', '.') . " €"; ?> </strong></p>
              <p> <small><?php echo $einnahmen[$i]["Details"];?></small>
              </p>
            </div>
          </li>
          <?php
          }

          ?>
        </ul>
      </div>
      <br><br><br>
    </div>
  <?php
  }





  public static function createAusgabenliste($year) {
  ?>
    <div class="col-md-3 col-sm-3 col-xs-3">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Ausgaben <small>2017</small></h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled scroll-view">
          <?php

          $sid = $_SESSION["SID"];
          $uid = $_SESSION["UID"];

          $query = "
          SELECT * 
          FROM Ausgaben
          WHERE SpielID = $sid AND UnternehmensID = $uid
          ;";
          $ausgaben = Database::sqlSelect($query);

          for($i = 0; $i < sizeof($ausgaben); $i++) {

          ?>
          <li class="media event">
            <a class="pull-left border-red profile_thumb">
              <i class="fa fa-eur red"></i>
            </a>
            <div class="media-body">
              <a class="title" href="#"><?php echo $ausgaben[$i]["Beschreibung"]; ?></a>
              <p><strong><?php echo "- " . number_format($ausgaben[$i]["Summe"], 2, ',', '.') . " €"; ?> </strong></p>
              <p> <small><?php echo $ausgaben[$i]["Details"];?></small>
              </p>
            </div>
          </li>
          <?php
          }

          ?>
        </ul>
      </div>
      <br><br><br>
    </div>
  <?php
  }





	
  public static function createFinanzenTopData($year) {

    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];

    $query = "
    SELECT * 
    FROM Einnahmen
    WHERE SpielID = $sid AND UnternehmensID = $uid
    ;";
    $einnahmen = Database::sqlSelect($query);

    $income = 0;

    for($i = 0; $i < sizeof($einnahmen); $i++) {
      $income += $einnahmen[$i]["Summe"];
    }

    $query = "
    SELECT * 
    FROM Ausgaben
    WHERE SpielID = $sid AND UnternehmensID = $uid
    ;";
    $ausgaben = Database::sqlSelect($query);

    $outcome = 0;

    for($i = 0; $i < sizeof($ausgaben); $i++) {
      $outcome += $ausgaben[$i]["Summe"];
    }

      $einnahmen = $income;
      $ausgaben = $outcome;
      $schuldtilgungsdauer = "Noch keine Daten";
      $gesamtkapitalrentabilität = "Noch keine Daten";

  ?>

	<div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-eur green"></i>  &nbsp; Einnahmen</span>
        <div class="count green" style="font-size:18pt"><?php echo number_format($einnahmen,2,',','.') . " €"; ?></div>
        <!--<span class="count_bottom"><i class="green">0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-eur red"></i>  &nbsp; Ausgaben</span>
        <div class="count red" style="font-size:18pt"><?php echo number_format($ausgaben,2,',','.') . " €"; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-clock-o"></i>  &nbsp; Schuldtilgungsdauer</span>
        <div class="count" style="font-size:18pt"><?php echo $schuldtilgungsdauer; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-money"></i>  &nbsp; Gesamtkapitalrentabilität</span>
        <div class="count" style="font-size:18pt"><?php echo $gesamtkapitalrentabilität; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
    </div>
		  
    <?php
  }

  public static function createFinanzJahresAnsicht(){
	
  ?>	
	<div class="clearfix"></div>
			
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Finanzdaten</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <p>Eine Übersicht all deiner finanziellen Eckdaten</p>
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 15%">Jahr</th>
                <th style="width: 15%">Cashflow</th>
	              <th style="width: 15%">Eigenkapitalquote</th>
	              <th style="width: 15%">Schuldtilgungsdauer</th>
                <th style="width: 10%">Gesamtkapitalrentabilität</th>
	              <th style="width: 15%"></th>
                <th style="width: 15%">Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <ul class="list-inline">
                    <li>
                      <small>2016</small><br>
                    </li>
                  </ul>
                </td>                          
	              <td>
                  <strong>21.002 €</strong>
                </td>
  						  <td>
  							  <small>123.50 %</small><br>
                </td>
  						  <td>
  							  <small>2,500 Monate</small><br>
                </td>
	              <td>
                  <p>4,567 %</p>
                </td>
	              <td>
		              <div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="12"></div>
                  </div>
	              </td>
                <td class="project_progress">

                  <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Details ansehen </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <?php
  }

}
?>