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



  }

}
?>