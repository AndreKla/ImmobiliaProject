<?php

class Markt {
	
	public static function createMarktanalyse() {

    ?>
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Marktanalyse <small>Immobilienmarkt Berlin 2017</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul class="list-unstyled msg_list">
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
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Marktanalyse in Auftrag geben</button>

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
                <?php
              }
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
    <?php
	}

}

?>