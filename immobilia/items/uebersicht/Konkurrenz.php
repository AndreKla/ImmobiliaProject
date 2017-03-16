<?php

class Konkurrenz {
	
  public static function createKonkurrenz() {
  ?>
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Konkurrenzanalyse <small>Konkurrenzsituation Berlin 2017</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <ul class="list-unstyled msg_list">

          <?php 

            $runde = $_SESSION["Runde"];

            if($runde > 0) {
              ?>
              <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#konkurrenzanalyse">Konkurrenzanalyse kaufen</button>
              <?php
            }
            else {
              ?>

              <button disabled type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#konkurrenzanalyse">Konkurrenzanalyse im 1. Geschäftsjahr nicht verfügbar</button>

              <?php
            }

          ?>
            

            <div class="modal fade bs-example-modal-lg" id="konkurrenzanalyse" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Konkurrenzanalyse</h4>
                  </div>
                  <div class="modal-body">
                    <h5>Konkurrenzanalyse - Immobilienmarkt Berlin 2017</h5>
                    <p>Kosten einmalig: 25.000 €</p>
                    <p>Wir analysieren für Sie konkurrierende Unternehmen im Immobilienmarkt in und um Berlin. Sie erhalten innerhalb von Sekunden einen detaillierten Report über die Geschehnisse des letzten Jahres.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?konkurrenz=1'; ?> class="btn btn-primary">Kaufen (25.000 €)</a>
                  </div>

                </div>
              </div>
            </div>
          </ul>
        </div>
      </div>
    </div>	
  <?php
  }

  public static function checkForKonkurrenz() {

    $konkurrenz = Request::getRundendaten();

    if($konkurrenz[0]["Konkurrenz"] == 1) {
      return true;
    }
    else {
      return false;
    }

  }

  /*

  Marktanteil (in Wert)
  Anzahl Immobilien
  Anzahl Mitarbeiter
  Strategien
  Social Media Analyse gekauft
  Marktanalyse gekauft
  Kredit genommen

  */

  public static function showKonkurrenz() {

    ?>

    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Konkurrenzanalyse <small>Konkurrenzsituation Berlin 2017</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="x_panel col-md-12">
          <div class="x_title">
            <h2>Überblick</h2>
            <div class="clearfix"></div>
          </div>

            <!-- Gesamtanalyse -->
              <div class="x_panel">
              <?php

                $playerData = Request::getKonkurrenzData();

                $playerBestandsWerte = Array();

                for($i = 0; $i < sizeof($playerData); $i++) {

                  $immobilienBestand = Request::getBestandByPlayer($playerData[$i]["ID"]);

                  $bestandsWert = 0;

                  for($n = 0; $n < sizeof($immobilienBestand); $n++) {
                    $bestandsWert += $immobilienBestand[$i]["Wert"];
                  }

                  array_push($playerBestandsWerte, $bestandsWert);
                  

                }

                $marktvolumen = Request::getMarktvolumen();

                $restmarktvolumen = $marktvolumen;

                for($i = 0; $i < sizeof($playerBestandsWerte); $i++) {
                  $restmarktvolumen -= $playerBestandsWerte[$i];
                }

                echo $restmarktvolumen;
                ?>
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Marktanteil<small>geschätzte Immobilienwerte</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <canvas id="pieChart"></canvas>
                      <br><br>
                    </div>
                    <br><br><br>
                    <div id="legend" class="col-md-12">
                        <span class="label label-danger" style="background-color:#BDC3C7; padding:5px; margin:2px;">Neutral</span>
                        <?php
                        $colorArray = ["#455C73", "#26B99A", "#3498DB"];

                        for($i = 0; $i < sizeof($playerData); $i++) {

                          echo "<span class='label label-danger' style='background-color:" . $colorArray[$i] . ";padding:5px; margin:2px;'>" . $playerData[$i]["Unternehmensname"] . "</span>";

                        }

                        ?>
                      </div>
                  </div>

                </div>
              </div>
            <!-- Einzelner Konkurrent -->

            <div class="x_title">
              <h2>Einzelanalyse</h2>
              <div class="clearfix"></div>
            </div>
            <div class="col-md-4">
              <div class="x_panel">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

      $numberOfPlayers = Request::getNumberOfPlayers();


    ?>

    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <script>

    Number.prototype.formatMoney = function(c, d, t){
    var n = this, 
        c = isNaN(c = Math.abs(c)) ? 2 : c, 
        d = d == undefined ? "." : d, 
        t = t == undefined ? "," : t, 
        s = n < 0 ? "-" : "", 
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
        j = (j = i.length) > 3 ? j % 3 : 0;
       return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
     };

    var options = {
        // String - Template string for single tooltips
        tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' %' %>",
        // String - Template string for multiple tooltips
        multiTooltipTemplate: "<%= value + ' %' %>",
    };

    Chart.defaults.global.legend = {
      enabled: false
    };

    // Doughnut chart
      var ctx = document.getElementById("pieChart");
      var data = {
        labels: [
          "Neutral",
          <?php for($i = 0; $i < $numberOfPlayers; $i++) { if($i != $numberOfPlayers - 1) { echo '"' . $playerData[$i]["Unternehmensname"] . '",';  } else { echo '"' . $playerData[$i]["Unternehmensname"] . '"'; } } ?>
        ],
        datasets: [{
          data: [<?php echo $restmarktvolumen . ","; for($i = 0; $i < sizeof($playerBestandsWerte); $i++) { if($i != sizeof($playerBestandsWerte) - 1) { echo $playerBestandsWerte[$i] . ","; } else { echo $playerBestandsWerte[$i]; }}?>],
          backgroundColor: [
            "#BDC3C7",
            "#455C73",
            "#26B99A",
            "#3498DB"
          ],
          hoverBackgroundColor: [
            "#CFD4D8",
            "#34495E",
            "#36CAAB",
            "#49A9EA"
          ]
        }]
      };
      var pieChart = new Chart(ctx, {
        type: 'pie',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data,
        options: {
            tooltips: {
                enabled: true,
                mode: 'single',
                callbacks: {
                    label: function(tooltipItems, data) { 
                        return data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].formatMoney(2, ',', '.') + ' €';
                    }
                }
            },
        }
      });

    </script>

    <?php

  }

}
?>