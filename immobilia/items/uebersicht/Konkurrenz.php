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
            <button disabled type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Konkurrenzanalyse im 1. Geschäftsjahr nicht verfügbar</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Marktanalyse</h4>
                  </div>
                  <div class="modal-body">
                    <h5>Marktanalyse - Immobilienmarkt Berlin 2017</h5>
                    <p>Kosten einmalig: 50.000 €</p>
                    <p>Wir bieten Ihnen einen Überblick über die aktuelle Lage und zukünftige Trends auf dem Immobilienmarkt in Berlin, insbesondere können wir Sie darüber aufklären was Ihre potentiellen Kunden derzeit beschäftigt und wie sich der Markt in Zukunft entwickeln könnte.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?social=1'; ?> class="btn btn-primary">Kaufen (20.000 €)</a>
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

}
?>