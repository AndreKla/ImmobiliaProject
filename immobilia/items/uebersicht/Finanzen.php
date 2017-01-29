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
            
            
            <!--out commenten -->
            
            <li class="media event">
            <a class="pull-left border-green profile_thumb">
              <i class="fa fa-eur green"></i>
            </a>
            <div class="media-body">
              <a class="title" href="#"> Startkapital</a>
              <p><strong> 1.000.000,00 </strong></p>
              <p> <small> Dein Anfangskapital</small>
              </p>
            </div>
          </li>
          

            
            
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


  public static function createBankview($year) {
  ?>
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Bank <small>Fremdkapitalverwaltung</small></h2>
          <div class="clearfix"></div>
        </div>
        <button <?php if($_GET["credit"] == 1) { echo "disabled"; } ?> type="button" class="btn btn-primary col-md-5" data-toggle="modal" data-target=".bs-example-modal-lg">Kreditantrag stellen</button>
        <button type="button" class="btn btn-primary pull-right col-md-5 data-toggle="modal" data-target=".bs-example-modal-lg">Geld anlegen</button>
      </div>
      <br><br><br>
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Kreditantrag wählen</h4>
            </div>
            <div class="modal-body col-md-4">
              <div class="x_panel">
                <h5>Vereinigte Volksbank e.G.</h5>
                <p>Annuitätendarlehen</p>
                <p>Kreditsumme: 2.000.000,00 €</p>
                <p>Zins: 7,50 % p.a.</p>
                <p>Laufzeit: 5 Jahre</p>
              <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
              </div>
            </div>
            
            <div class="modal-body col-md-4">
              <div class="x_panel">
                <h5>Deutsche Bank AG</h5>
                <p>endfälliger Kredit</p>
                <p>Kreditsumme: 500.000,00 €</p>
                <p>Zins: 10,00 % p.a.</p>
                <p>Laufzeit: 2 Jahre</p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
              </div>
            </div>

            <div class="modal-body col-md-4">
              <div class="x_panel">
                <h5>Commerzbank</h5>
                <p>endfälliger Kredit</p>
                <p>Kreditsumme: 750.000,00 €</p>
                <p>Zins: 9,50 % p.a.</p>
                <p>Laufzeit: 3 Jahre</p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  <?php
  }

  public static function createKontoview($year) {
  ?>
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Finanzen <small>Überblick</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h5>Cashflow<br><br><small class="red"> -300.000,00 €</small></h5>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <canvas id="cashflow"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h5>Eigenkapitalquote<br><br><small class="green"> 100% </small></h5>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <canvas id="eigenkapitalquote"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h5>Schuldtilgungsdauer<br><br><small> 0 Jahre </small></h5>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <canvas id="schuldtilgungsdauer"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h5>Gesamtkapitalrentabilität<br><br><small class="green"> 5,5 % </small></h5>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <canvas id="gesamtkapitalrentabilität"></canvas>
              </div>
            </div>
          </div>
      </div>
      <button <?php if($_GET["credit"] == 1) { echo "disabled"; } ?> type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Detailansicht</button>
      <button <?php if($_GET["credit"] == 1) { echo "disabled"; } ?> type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Kreditantrag stellen</button>
      
      <br><br><br><br><br><br><br>
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Kreditantrag wählen</h4>
            </div>
            <div class="modal-body col-md-4">
              <h5>Vereinigte Volksbank e.G.</h5>
              <p>Annuitätendarlehen</p>
              <p>Kreditsumme: 2.000.000,00 €</p>
              <p>Zins: 7,50 % p.a.</p>
              <p>Laufzeit: 5 Jahre</p>
              <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
            </div>
            
            <div class="modal-body col-md-4">
              <h5>Deutsche Bank AG</h5>
              <p>endfälliger Kredit</p>
              <p>Kreditsumme: 500.000,00 €</p>
              <p>Zins: 10,00 % p.a.</p>
              <p>Laufzeit: 2 Jahre</p>
              <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
            </div>

            <div class="modal-body col-md-4">
              <h5>Commerzbank</h5>
              <p>endfälliger Kredit</p>
              <p>Kreditsumme: 750.000,00 €</p>
              <p>Zins: 9,50 % p.a.</p>
              <p>Laufzeit: 3 Jahre</p>
              <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    </div>
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var ctx = document.getElementById("cashflow");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php echo date('Y', strtotime("-1 year")) . "," . date('Y') . "," . date('Y', strtotime("+1 year")) . "," . date('Y', strtotime("+2 years")) . "," . date('Y', strtotime("+3 years")) . "," . date('Y', strtotime("+4 years")); ?>],
          datasets: [{
            label: "Cashflow in €",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [0, -300000]
          }]
        },
      });

      var ctx = document.getElementById("eigenkapitalquote");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php echo date('Y', strtotime("-1 year")) . "," . date('Y') . "," . date('Y', strtotime("+1 year")) . "," . date('Y', strtotime("+2 years")) . "," . date('Y', strtotime("+3 years")) . "," . date('Y', strtotime("+4 years")); ?>],
          datasets: [{
            label: "Eigenkapitalquote in %",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [100, 100]
          }]
        },
      });

      var ctx = document.getElementById("schuldtilgungsdauer");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php echo date('Y', strtotime("-1 year")) . "," . date('Y') . "," . date('Y', strtotime("+1 year")) . "," . date('Y', strtotime("+2 years")) . "," . date('Y', strtotime("+3 years")) . "," . date('Y', strtotime("+4 years")); ?>],
          datasets: [{
            label: "Schuldtilgungsdauer in Jahren",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [0, 0]
          }]
        },
      });

      var ctx = document.getElementById("gesamtkapitalrentabilität");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php echo date('Y', strtotime("-1 year")) . "," . date('Y') . "," . date('Y', strtotime("+1 year")) . "," . date('Y', strtotime("+2 years")) . "," . date('Y', strtotime("+3 years")) . "," . date('Y', strtotime("+4 years")); ?>],
          datasets: [{
            label: "Gesamtkapitalrentabilität in %",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [0, 5.5]
          }]
        },
      });
      </script>
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

    $spielID = $_SESSION["SID"];
    $unternehmensID = $_SESSION["UID"];

    $query = "
      SELECT Runde, Kapital
      FROM Rundendaten
      WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
      ORDER BY Runde DESC
      ;";
    $runde = Database::sqlSelect($query);

    $einnahmen = $income;
    $ausgaben = $outcome;
    $fremdkapital = 0;
    $kontostand = $runde[0]["Kapital"];

  ?>

	<div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-credit-card"></i>  &nbsp; Kontostand</span>
        <div class="count" style="font-size:18pt"><?php echo number_format($kontostand,2,',','.') . " €"; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-bank"></i>  &nbsp; Fremdkapital</span>
        <div class="count" style="font-size:18pt"><?php echo number_format($fremdkapital,2,',','.') . " €"; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
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