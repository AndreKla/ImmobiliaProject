<?php

class Bestand {
	

public static function createBestand($aktuellesGeschäftsjahr){
	
    $anzahlGewählteZiele = 0;
    
    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];
    $runde = $_SESSION["Runde"];

    $immobilien = Request::getBestand();

    $unternehmen = Request::getUnternehmen();
    
    $zeit = date('Y');
	
?>
    <div class="clearfix"></div>
			
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Immobilienbestand <small><?php echo $unternehmen[0]["Unternehmensname"]; ?></small></h2>
              <!-- Hilfe Funktionalität / Text / Popup-->
      		    <?php include 'help/bestand_immobilienbestand_help.php'; ?>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="table table-striped projects">
                
                <?php 
                    for($i = 0; $i < sizeof($immobilien); $i++) {	
                        
                        $immobilienID = $immobilien[$i]["ObjektID"];
                        
                        if($immobilien[$i]["Gekauft"] == 0 && $immobilien[$i]["Ersteigert"] == 0) {
                          $objekt = Request::getStartImmobilieByID($immobilienID);
                        }
                        else if($immobilien[$i]["Gekauft"] == 0 && $immobilien[$i]["Ersteigert"] == 1) {
                          $objekt = Request::getAuktionsobjektByID($immobilienID);
                        }
                        else {
                          $objekt = Request::getImmobilieByID($immobilienID);
                        }
                        

                        if($immobilien[$i]["Verkauft"] == 0) {
                          
                ?>
                <thead>
                  <tr>
                    <th style="max-width:10px;"></th>
                    <th></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:10%; text-align:center; min-width:100px;"></th>
                    <th style="width:10%; text-align:center; min-width:100px;"></th>
                    <th style="width:10%; text-align:center; min-width:100px;"></th>
                    <th style="width:10%; text-align:center; min-width:100px;"></th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td rowspan="3" width="200px">
                    <div class="modal-content" style="border:none;">
                        <img src="<?php echo $objekt[0]["Bild"];?>" width="200px" style="vertical-align:center;">
                    </div>
                    
                    <div class="x_panel" style="margin-top:15px; text-align:center;">
                        <?php
                            if($immobilien[$i]["Bau"] == 0) {
                                echo "<small><i class='fa fa-home'></i>  &nbsp; Wohneinheit</small>";
                            }
                            else {
                                echo "<small><i class='fa fa-tree'></i>  &nbsp; Baugrundstück</small>";
                            }
                        

                        ?>
                    </div>

                    <div class="x_panel" style="margin-top:5px; text-align:center;">
                        <?php
                            if($immobilien[$i]["Bau"] != 0) {
                                if($immobilien[$i]["Bau"] == 10) {
                                    echo "<small class='red'><i class='fa fa-flag'></i>  &nbsp; Unbebaut</small>";
                                }
                                else if($immobilien[$i]["Bau"] > 1){
                                    echo "<small class='yellow'><i class='fa fa-truck'></i>  &nbsp; Im Bau (" .$immobilien[$i]["Bau"] . " Jahre)</small>";
                                }
                                else {
                                    echo "<small class='yellow'><i class='fa fa-truck'></i>  &nbsp; Im Bau (" .$immobilien[$i]["Bau"] . " Jahr)</small>";
                                }
                            }
                            else {
                                if($immobilien[$i]["Vermietet"] == 0) {
                                    echo "<small class='red'><i class='fa fa-calendar-times-o'></i>  &nbsp; Leerstand</small>";
                                }
                                else {
                                    echo "<small class='green'><i class='fa fa-clipboard'></i>  &nbsp; Vermietet</small>";
                                } 
                            }
                        ?>
                        
                    </div>
                  </td>                          
                  <td colspan="2">
                    <a><small style="font-size:10pt"><strong><?php echo $objekt[0]["Beschreibung"]; ?></strong></small></a><br>
                    <a><small style="font-size:10pt"><?php echo $objekt[0]["Strasse"]; ?></small></a><br>
                    <a><small style="font-size:10pt"><?php echo $objekt[0]["PLZ"] . " " . $objekt[0]["Ort"]; ?></small></a>
                  </td>
                  <td></td>
                  <td style="text-align:center; padding-bottom:20px">
                    <a><small style="font-size:10pt;"><strong>Kaufpreis</strong></small></a><br><br>
                      <span class="label label-default"><?php echo number_format($immobilien[$i]["Kaufpreis"], 2, ',', '.') . " €"; ?></span>
                  </td>
                  <td style="text-align:center; padding-bottom:20px">
                      <a><small style="font-size:10pt;"><strong>Lage</strong></small></a><br><br>
                      <span class="label label-<?php if($objekt[0]["Lage"] < 4) { echo "danger"; } else if($objekt[0]["Lage"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($objekt[0]["Lage"] < 4) { echo "schlecht"; } else if($objekt[0]["Lage"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                  </td>
                  <!--<td style="text-align:center">
                      <a><small style="font-size:10pt;"><strong>Ausstattung</strong></small></a><br><br>
                      <span class="label label-<?php if($immobilien[$i]["Bau"] == 1) { echo "default"; } else if($immobilien[$i]["Zustand"] < 4) { echo "danger"; } else if($immobilien[$i]["Zustand"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($immobilien[$i]["Bau"] == 1) { echo "n/a"; } else if($immobilien[$i]["Zustand"] < 4) { echo "schlecht"; } else if($immobilien[$i]["Zustand"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                  </td>-->
                  <td style="text-align:center">
                      <a><small style="font-size:10pt;"><strong>Zustand</strong></small></a><br><br>
                      <span class="label label-<?php if($immobilien[$i]["Bau"] > 0) { echo "default"; } else if($immobilien[$i]["Zustand"] < 4) { echo "danger"; } else if($immobilien[$i]["Zustand"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($immobilien[$i]["Bau"] > 0) { echo "n/a"; } else if($immobilien[$i]["Zustand"] < 4) { echo "schlecht"; } else if($immobilien[$i]["Zustand"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                  </td>

                </tr>
                <tr>

                    <td colspan="6" style="padding-top:12px">
                        <div style="text-align:center">
                            <a href="#" class="btn btn-dark btn-xs weiterbilden col-md-2" <?php if($immobilien[$i]["Bau"] != 10) { echo "disabled";} else { echo "data-toggle='modal' data-target=#b$immobilienID"; } ?>><i class="fa fa-truck"></i>  &nbsp; Bebauen </a>

                            <a href="#" class="btn btn-dark btn-xs weiterbilden col-md-2" <?php if($immobilien[$i]["Bau"] != 0) { echo "disabled"; } else if($immobilien[$i]["Zustand"] >= 7) { echo "disabled"; } else { echo "data-toggle='modal' data-target=#r$immobilienID"; } ?>><i class="fa fa-caret-square-o-up"></i>  &nbsp; Sanieren </a>

                            <a href="#" class="btn btn-dark btn-xs weiterbilden col-md-2" <?php if($immobilien[$i]["Bau"] != 0) { echo "disabled"; } else if($immobilien[$i]["Vermietet"] != 0) { echo "disabled"; } else { echo "data-toggle='modal' data-target=#v$immobilienID"; } ?>><i class="fa fa-clipboard"></i>  &nbsp; Vermieten </a>
                        
                            <a href="#" class="btn btn-dark btn-xs kuendigen col-md-2" <?php if($immobilien[$i]["Bau"] > 0 && $immobilien[$i]["Bau"] != 10) { echo "disabled"; } else { echo "data-toggle='modal' data-target=#s$immobilienID"; } ?>><i class="fa fa-eur"></i>  &nbsp;Verkaufen </a>
                        </div>
                    </td>
                </tr>
                <tr>
                  <td colspan="1">
                    <small class="pull-left"><strong>Geschäftsjahr</strong></small><br><br>
                    <small class="pull-left">Verkehrswert: </small><br>
                    <small class="pull-left">Miete (p.a.): </small><br>
                    <small class="pull-left">Abschreibung (p.a.): </small>


                  </td>
                    <?php 
                        for($f = 0; $f < 5; $f++){
                        ?>
                            <td style="text-align:center;">
                            <small><strong> <?php echo date('Y', strtotime("+$f year")); ?></strong></small><br><br>
                        <?php
                            if($f < $runde){

                              $round = $f + 1;
                        ?>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo API::getBestandsImmobilienValueById($objekt[0]["ID"], $round); ?></small><br>
                                <small class="pull-right">  <?php echo number_format($immobilien[$i]["Miete"] + $objekt[0]["Mietentwicklung"] * $f, 2, ',', '.') . " €"; ?></small><br>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Abschreibung"], 2, ',', '.') . " €"; ?></small>
                            </td>
                        <?php 
                            }
                            else {
                        ?>
                            
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small><br>
                            </td>
                        <?php
                            }
                        }
                    ?>

                </tr>
                <?php 

                    

                }
                ?>
                </tbody>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php

    for($i = 0; $i < sizeof($immobilien); $i++) {

        $id = "s" . $immobilien[$i]["ObjektID"];

        Bestand::createModalViewSell($id, "Objekt verkaufen");

    }

    for($i = 0; $i < sizeof($immobilien); $i++) {

        $id = "v" . $immobilien[$i]["ObjektID"];

        Bestand::createModalViewRent($id, "Objekt vermieten");

    }

    for($i = 0; $i < sizeof($immobilien); $i++) {

        $id = "r" . $immobilien[$i]["ObjektID"];

        Bestand::createModalViewRenew($id, "Objekt sanieren");

    }

    for($i = 0; $i < sizeof($immobilien); $i++) {

        $id = "b" . $immobilien[$i]["ObjektID"];

        Bestand::createModalViewBuild($id, "Grundstück bebauen");

    }

}

public static function createModalViewSell($id, $title) {

    $immobilien = Request::getBestand();

    $immoID = ltrim($id, 's');

    $immobilie = Request::getBestandsimmobilieByID($immoID);
                        
    if($immobilie[0]["Gekauft"] == 0 && $immobilie[0]["Ersteigert"] == 0) {
      $objekt = Request::getStartImmobilieByID($immoID);
    }
    else if($immobilie[0]["Ersteigert"] == 1) {
      $objekt = Request::getAuktionsobjektById($immoID);
    }
    else {
      $objekt = Request::getImmobilieByID($immoID);
    }

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
            <div class="modal-body col-md-12">
                <div class="x_panel">

                    <div class="modal-content pull-right" style="width:200px; height:150px; border:none">
                        <img src=<?php echo $objekt[0]["Bild"]; ?> width="200px" height="150px">
                    </div>
                    <h2><?php echo $objekt[0]["Beschreibung"]; ?></h2>
                    <p><i><?php echo $objekt[0]["Strasse"]; ?></i><br>
                    <i><?php echo $objekt[0]["PLZ"] . " " . $objekt[0]["Ort"]; ?></i></p><br><br><br><br>
                    <?php

                        var_dump($objekt);

                        $kaeuferdaten = Request::getKaeuferdaten();

                        for($i = 0; $i < sizeof($kaeuferdaten); $i++) {
                          API::createSalesOffer($immoID, $kaeuferdaten[$i]["Name"], $objekt[0]["Wert"] * $kaeuferdaten[$i]["Preis"], $kaeuferdaten[$i]["Zahlungsdatum"], $kaeuferdaten[$i]["Bonitaet"]);
                        }

                    ?>
                </div>        
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    <?php
  }

  public static function createModalViewRent($id, $title) {

    $immoID = ltrim($id, 'v');

    $immobilie = Request::getBestandsimmobilieByID($immoID);
                        
    if($immobilie[0]["Gekauft"] == 0 && $immobilie[0]["Ersteigert"] == 0) {
      $objekt = Request::getStartImmobilieByID($immoID);
    }
    else if($immobilie[0]["Ersteigert"] == 1) {
      $objekt = Request::getAuktionsobjektById($immoID);
    }
    else {
      $objekt = Request::getImmobilieByID($immoID);
    }

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
            <div class="modal-body col-md-12">
                <div class="x_panel">

                    <div class="modal-content pull-right" style="width:200px; height:150px; border:none">
                        <img src=<?php echo $objekt[0]["Bild"]; ?> width="200px" height="150px">
                    </div>
                    <div style="margin-left:15px">
                    <h2><?php echo $objekt[0]["Beschreibung"]; ?></h2>
                    <p><i><?php echo $objekt[0]["Strasse"]; ?></i><br>
                    <i><?php echo $objekt[0]["PLZ"] . " " . $objekt[0]["Ort"]; ?></i></p>
                    <p>Vorjahresmiete: <i><?php echo number_format($objekt[0]["Miete"], 2, ',', '.') . " € p.a."; ?></i></p>
                    <p>Jede Immobilie kann pro Geschäftsjahr nur einmal auf dem Wohnungsmarkt zur Miete angeboten werden. Wenn sich zu der gewünschten Miete kein Mieter finden lässt, wird die Immobilie weiterhin leer stehen.
                    Daher ist es ratsam sich an realistischen Mietpreisentwicklungen zu orientieren.</p>
                    </div><br><br>
                    <form action="bestand.php" method="POST">
                    <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4 form-group has-feedback">
                      <input type="text" class="form-control has-feedback-left" name="preis" placeholder="gewünschte Jahresmiete">
                      <span class="fa fa-eur form-control-feedback left" aria-hidden="true"></span>
                      <input type="hidden" name="vermieten" value="<?php echo $immoID; ?>">
                    </div><br><br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <button type="submit" class="btn btn-primary col-md-offset-5 col-md-2">Vermieten</button>
                    </div>
                    </form>
                    


                    <?php
/*
                        $mieterdaten = Request::getMieterdaten();

                        for($i = 0; $i < sizeof($mieterdaten); $i++) {
                          API::createRentOffer($immoID, $mieterdaten[$i]["Name"], $immobilie[0]["Miete"] * $mieterdaten[$i]["Preis"], $mieterdaten[$i]["Einzugsdatum"], $mieterdaten[$i]["Sauberkeit"], $mieterdaten[$i]["Bonitaet"]);
                        }
*/
                    ?>
                </div>        
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    <?php
  }

  public static function createModalViewRenew($id, $title) {

    $immoID = ltrim($id, 'r');

    $immobilie = Request::getBestandsimmobilieByID($immoID);

    if($immobilie[0]["Gekauft"] == 0 && $immobilie[0]["Ersteigert"] == 0) {
      $objekt = Request::getStartImmobilieByID($immoID);
    }
    else if($immobilie[0]["Ersteigert"] == 1) {
      $objekt = Request::getAuktionsobjektById($immoID);
    }
    else {
      $objekt = Request::getImmobilieByID($immoID);
    }

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
            <div class="modal-body col-md-12">
                <div class="x_panel">

                    <div class="modal-content pull-right" style="width:200px; height:150px; border:none">
                        <img src=<?php echo $objekt[0]["Bild"]; ?> width="200px" height="150px">
                    </div>
                    <h2><?php echo $objekt[0]["Beschreibung"]; ?></h2>
                    <p><i><?php echo $objekt[0]["Strasse"]; ?></i><br>
                    <i><?php echo $objekt[0]["PLZ"] . " " . $objekt[0]["Ort"]; ?></i></p><br><br><br><br>
                    <?php

                          API::createRenewOption($immoID, "Oberflächliche Sanierung", "Eine schnelle, oberflächliche Sanierung. Es werden arbeiten durchgeführt wie z.B. Streichen und Tapezieren.", $objekt[0]["Wert"] * 0.05, $objekt[0]["Wert"] * 0.06, 2);
                          API::createRenewOption($immoID, "Gründliche Sanierung", "Eine gründliche Sanierung, die etwas mehr Aufwand erfordert. Es wird ein neuer Fußboden verlegt und besser isolierte Fenster verbaut.", $objekt[0]["Wert"] * 0.10, $objekt[0]["Wert"] * 0.15, 4);
                          API::createRenewOption($immoID, "Rundumerneuerung", "Die Immobilie wird rundum erneuert. Es wird eine neue Einbauküche verbaut und es werden schöne, neue Badmöbel gekauft.",$objekt[0]["Wert"] * 0.15, $objekt[0]["Wert"] * 0.25, 6);

                    ?>
                </div>        
              </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    <?php
  }

  public static function createModalViewBuild($id, $title) {

    $immoID = ltrim($id, 'b');

    $bestandsimmobilie = Request::getBestandsimmobilieByID($immoID);
    $immobilie = Request::getImmobilieByID($immoID);

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
            <div class="modal-body col-md-12">
                <div class="x_panel">

                    <div class="modal-content pull-right" style="width:200px; height:150px; border:none">
                        <img src=<?php echo $immobilie[0]["Bild"]; ?> width="200px" height="150px">
                    </div>
                    <h2><?php echo $immobilie[0]["Beschreibung"]; ?></h2>
                    <p><i><?php echo $immobilie[0]["Strasse"]; ?></i><br>
                    <i><?php echo $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"]; ?></i></p><br><br><br><br>
                    <?php

                          API::createBuildOption($immoID, "schlichtes Wohngebäude", $immobilie[0]["Wert"] * 1.05, $immobilie[0]["Wert"] * 1.66, 8, 1);
                          API::createBuildOption($immoID, "Mehrfamilienhaus", $immobilie[0]["Wert"] * 1.50, $immobilie[0]["Wert"] * 2.45, 9, 2);
                          API::createBuildOption($immoID, "Luxusapartements", $immobilie[0]["Wert"] * 2.15, $immobilie[0]["Wert"] * 4.25, 10, 3);

                    ?>
                </div>        
              </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            </div>

          </div>
        </div>
      </div>
    <?php
  }

}
?>