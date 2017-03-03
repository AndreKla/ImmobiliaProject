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

  public static function createKapitalbewegungen($year) {

  ?>
    <div class="col-md-9 col-sm-9 col-xs-9">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Umsätze <small><?php echo date('Y', strtotime("+" . $year . " year")); ?></small></h2>
			<!-- Hilfe Funktionalität / Text / Popup-->
		    <?php include 'help/finanzen_umsaetze_help.php'; ?>
          <div class="clearfix"></div>
        </div>
        <table class="table table-striped col-md-12" style="font-size: 10pt;">
          <tr>
            <th>Wertstellung</th>
            <th>Umsatzdetails</th>
            <th>Soll</th>
            <th>Haben</th>
            <th>Währung</th>
          </tr>
          <?php 

            $kapitalbewegung = Request::getKapitalbewegung();
            
            for($i = 0; $i < sizeof($kapitalbewegung); $i++) {

              $date = new DateTime($kapitalbewegung[$i]["Zeit"]);
              $formatedDate = $date->format('d.m.Y H:i:s');

              echo "<tr>";
              echo "<td>" . $formatedDate . "</td>";
              echo "<td>" . $kapitalbewegung[$i]["Details"] . "<br><i>" . $kapitalbewegung[$i]["Beschreibung"] . "</i></td>";
              if($kapitalbewegung[$i]["Typ"] == "Ausgabe") {
                echo "<td class='pull-right red'>" . number_format($kapitalbewegung[$i]["Summe"],2,',','.') . "</td>";
                echo "<td></td>";
              }
              else {
                echo "<td></td>";
                echo "<td class='pull-right green'>" . number_format($kapitalbewegung[$i]["Summe"],2,',','.') . "</td>";
              }
              echo "<td>EUR</td>";
              echo "</tr>";
            }

          ?>
        </table>
      </div>
      <br><br><br>
    </div>
  <?php
  }


  /**
     *
     * Creates list of spendings in "Finanzen" View
     *
     * @var Int $year -> current round in game
     */


  public static function createAusgabenliste($year) {

    $year -= 1;

  ?>
    <div class="col-md-3 col-sm-3 col-xs-3">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Ausgaben <small><?php echo date('Y', strtotime("+" . $year . " year")); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled scroll-view">
          <?php

          $sid = $_SESSION["SID"];
          $uid = $_SESSION["UID"];

          $ausgaben = Request::getAusgaben();

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


  /**
     *
     * Creates Fremdkapitalverwaltung in "Finanzen" View
     *
     * @var Int $year -> current round in game
     */

  public static function createBankview($year) {

    $rundendaten = Request::getRundendaten();

  ?>
    <div class="col-md-3 col-sm-3 col-xs-3">
      <div class="x_panel" style="height:auto">
        <div class="x_title">
          <h2>Bank <small>Kapitalverwaltung</small></h2>
			<!-- Hilfe Funktionalität / Text / Popup-->
		    <?php include 'help/finanzen_bank_help.php'; ?>
          <div class="clearfix"></div>
        </div>
        <button <?php if($rundendaten[0]["Kredit"] != 0) { echo "disabled"; } ?> type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#kredit">Kreditantrag stellen</button>
        <button <?php if($rundendaten[0]["Anlage"] != 0) { echo "disabled"; } ?> type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#anlegen">Geld anlegen</button>
        <button <?php echo "disabled"; ?> type="button" class="btn btn-primary col-md-12">Insolvenz anmelden</button>
      </div>
      <?php
      Finanzen::createModalView("kredit", "Kreditantrag wählen");
      Finanzen::createModalView("anlegen", "Anlageoption wählen")
      ?>
    </div>
  <?php
  }

  public static function createModalView($id, $title) {
    ?>
    <br><br><br>
      <div class="modal fade bs-example-modal-lg" id=<?php echo "'" . $id . "'";?> tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
            </div>
            <?php

            if($id == "kredit") {

              $kredite = Request::getKredite();

              for ($i = 0; $i < sizeof($kredite); $i++) {

                API::createCreditRequest($kredite[$i]["ID"], $kredite[$i]["Bankname"], $kredite[$i]["Kredittyp"], $kredite[$i]["Kreditsumme"], $kredite[$i]["Kreditzins"], $kredite[$i]["Laufzeit"], $kredite[$i]["Genehmigungswahrscheinlichkeit"]);

              }

            }
            else {

              $anlageoptionen = Request::getAnlageoptionen();

              for ($i = 0; $i < sizeof($anlageoptionen); $i++) {

                API::createAnlageRequest($anlageoptionen[$i]["ID"], $anlageoptionen[$i]["Name"], $anlageoptionen[$i]["Beschreibung"], $anlageoptionen[$i]["Summe"], $anlageoptionen[$i]["Ertrag"], $anlageoptionen[$i]["Dauer"], $anlageoptionen[$i]["Risiko"]);

              }

            }
            
            ?>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    <?php
  }

  /**
     *
     * Creates Fremdkapitalverwaltung in "Finanzen" View
     *
     * @var Int $year -> current round in game
     */

  
	
  public static function createFinanzenTopData($year) {

    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];

    $einnahmen = Request::getEinnahmen();

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
      SELECT Runde, Kapital, Fremdkapital, Anlagekapital
      FROM Rundendaten
      WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
      ORDER BY Runde DESC
      ;";
    $runde = Database::sqlSelect($query);

    $einnahmen = $income;
    $ausgaben = $outcome;
    $fremdkapital = $runde[0]["Fremdkapital"];
    $anlagekapital = $runde[0]["Anlagekapital"];

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
        <span class="count_top"><i class="fa fa-credit-card"></i>  &nbsp; Anlagekapital</span>
        <div class="count" style="font-size:18pt"><?php echo number_format($anlagekapital,2,',','.') . " €"; ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>-->
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-bank"></i>  &nbsp; Fremdkapital</span>
        <div class="count" style="font-size:18pt"><?php echo number_format($fremdkapital,2,',','.') . " €"; ?></div>
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