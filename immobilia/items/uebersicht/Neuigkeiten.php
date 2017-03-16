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
          <p class="excerpt col-md-12">
          <?php echo $text . $text; ?>
          </p>
          <!--<img src=<?php echo "'$bild'"; ?> alt="News Bild" width="120px" height="85px">-->
        </div>
      </div>
    </li>

    <?php
	/*
*/

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
		  <!-- Hilfe Funktionalität / Text / Popup-->
		  <?php include 'help/neuigkeiten_aktuell_help.php'; ?>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
              
              <?php

                for($i = 0; $i < sizeof($aktuelleNeuigkeiten); $i++) {

                  $zeit = date('d.m.Y', strtotime("+" . $timeToAdd . " year"));

                  Neuigkeiten::createNews($aktuelleNeuigkeiten[$i]["Titel"], $zeit, $aktuelleNeuigkeiten[$i]["Autor"], $aktuelleNeuigkeiten[$i]["Beschreibung"], $aktuelleNeuigkeiten[$i]["Bild"]);

                }

              ?>
            </ul>
          </div>
        </div>
      </div>
      <br><br><br><br>
    </div>
  <?php
  }

  public static function checkForFeed($aktuellesGeschäftsjahr) {
  
  $anzahlGewählteZiele = 0;

    $query = "
    SELECT Social
    FROM Rundendaten
    WHERE Runde = $aktuellesGeschäftsjahr
    ;";
    $social = Database::sqlSelect($query);

    ?>
      <div class="col-md-4">
        <div class="x_panel">
          <div class="x_title">
            <h2>Analyse <small>von Social Intelligence</small></h2>
			<!-- Hilfe Funktionalität / Text / Popup-->
                <?php include 'help/neuigkeiten_analyse_help.php'; ?>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php
            if($social[0]["Social"] == 1) {
              Neuigkeiten::createFeed();
            }
            else {
              if($_GET['social'] == 1) {  //purchased social feed

              $unternehmensID = $_SESSION["UID"];
              $spielID = $_SESSION["SID"];
              $runde = $_SESSION["Runde"];

              $query = "
                UPDATE Rundendaten
                SET Social = 1
                WHERE UnternehmensID = $unternehmensID AND SpielID = $spielID AND Runde = $runde
                ;";
                Database::sqlUpdate($query);
                API::addAusgabe(20000, "Marktforschung", "Social Intelligence Analysis");
                API::createBuchungsAufgabe("Sonstiges", "Bank", 20000, "Social Media Analyse - Marktforschung");
                Neuigkeiten::createFeed();
                $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
                ?>
                <script>
                window.location = <?php echo "'" . $actual_link . "?socialbuy=1'";?>
                </script>
                <?php
              }
              else {
                ?>
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Social Media Analyse kaufen</button>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Social Media Analyse</h4>
                        </div>
                        <div class="modal-body">
                          <h5>powered by Social Intelligence GmbH</h5>
                          <p>Kosten pro Jahr: 20.000 €</p>
                          <p>Wir bieten Ihnen einen Überblick über die aktuelle Lage in den sozialen Netzwerken, insbesondere können wir Sie darüber aufklären was Ihre potentiellen Kunden derzeit beschäftigt und wie sich der Markt in Zukunft entwickeln könnte.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                          <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?social=1'; ?> class="btn btn-primary">Kaufen (20.000 €)</a>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    <?php
  }

  public static function createRatgeber() {
    ?>
    <div class="col-md-4">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ratgeber <small>Immobilienwirtschaft</small></h2>
			<!-- Hilfe Funktionalität / Text / Popup-->
		    <?php include 'help/neuigkeiten_ratgeber_help.php'; ?>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul class="list-unstyled msg_list">

            <?php



            $downloadDirectory = "http://" . $_SERVER["HTTP_HOST"] . "" . $_SERVER["PHP_SELF"];
            $url = rtrim($downloadDirectory, "/neuigkeiten.php");

            $iLink = Request::getDownloadLink("Immobilien");
            $iFile = $iLink[0]["URL"];
            $immobilienURL = $url . $iFile;

            $bLink = Request::getDownloadLink("Buchfuehrung");
            $bFile = $bLink[0]["URL"];
            $buchfuehrungURL = $url . $bFile;
            
            $tLink = Request::getDownloadLink("Buchung");
            $tFile = $tLink[0]["URL"];
            $buchungURL = $url . $tFile;
            
            ?>

                <a href=<?php echo "'" . $immobilienURL . "'"; ?> class="btn btn-primary btn-success col-md-12">Ratgeber Immobilien</a>
                <br>
                <a href=<?php echo "'" . $buchfuehrungURL . "'"; ?> class="btn btn-primary btn-success col-md-12">Ratgeber Buchführung</a>
                <br>
                <a href=<?php echo "'" . $buchungURL . "'"; ?> class="btn btn-primary btn-success col-md-12">T-Konten Vorlage</a>


                  <!--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Social Media Analyse</h4>
                        </div>
                        <div class="modal-body">
                          <h5>powered by Social Intelligence GmbH</h5>
                          <p>Kosten pro Jahr: 20.000 €</p>
                          <p>Wir bieten Ihnen einen Überblick über die aktuelle Lage in den sozialen Netzwerken, insbesondere können wir Sie darüber aufklären was Ihre potentiellen Kunden derzeit beschäftigt und wie sich der Markt in Zukunft entwickeln könnte.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                          <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?social=1'; ?> class="btn btn-primary">Kaufen (20.000 €)</a>
                        </div>

                      </div>
                    </div>
                  </div>-->
            </ul>
          </div>
        </div>
      </div>
      <?php
  }

  public static function createFeed() {

    $query = "
    SELECT *
    FROM Posts
    ;";
    $posts = Database::sqlSelect($query);

    for($i = 0; $i < sizeof($posts); $i++) {        
    ?>
      <li style="list-style:none;">
        <a>
          <span class="image">
            <img src=<?php echo $posts[$i]["Bild"];?> alt="img" />
          </span>
          <span>
            <span><?php echo $posts[$i]["Titel"];?></span>
            <span class="time"><?php echo $posts[$i]["Zeit"];?></span>
          </span>
          <span class="message">
            <?php echo $posts[$i]["Beschreibung"];?>
          </span>
        </a>
      </li>
    <?php 
    }
    ?>
      <li style="list-style:none;">
        <div class="x_content">
          <canvas id="canvasDoughnut"></canvas>
        </div>
      </li>
      <li style="list-style:none;">
        <div class="x_content">
          <canvas id="lineChart"></canvas>
        </div>
      </li>
    <?php

  ?>
  <script src="vendors/Chart.js/dist/Chart.min.js"></script>
  <script>

  Chart.defaults.global.legend = {
    enabled: false
  };

  var ctx = document.getElementById("lineChart");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli"],
          datasets: [{
            label: "Posts - Immobilie kaufen",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [14, 22, 21, 28, 31, 29, 44]
          }]
        },
      });

  // Doughnut chart
      var ctx = document.getElementById("canvasDoughnut");
      var data = {
        labels: [
          "12345",
          "12345",
          "12345",
          "12345"
        ],
        datasets: [{
          data: [120, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          hoverBackgroundColor: [
            "#34495E",
            "#CFD4D8",
            "#36CAAB",
            "#49A9EA"
          ]
        }]
      };
      var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });
    </script>
    <?php
  }
}
?>