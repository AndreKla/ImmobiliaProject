<?php

class Personal {
    
    /*
     * TYPEN:
     * 
     * Bauingenieur -> 30k
     * Immobilienhändler -> 20k
     * Immobilienkaufmann -> 20k
     * Sachbearbeiter -> 10k
     * 
     */
	
	
public static function einstellen($id, $bezeichnung, $name, $skills, $rating, $bild, $gehalt) {
?>

    <div class="col-md-5 col-sm-5 col-xs-5 profile_details">
        <div class="well profile_view">
        <div class="col-sm-12">
          <h4 class="brief"><i><?php echo $bezeichnung; ?></i></h4>
          <div class="left col-xs-7">
            <h2><?php echo $name; ?></h2>
            <p><strong>Fähigkeiten: </strong></p>
            <ul class="list-unstyled">
              <li><p class="ratings">
              
              <?php 
                for($i = 1; $i < $skills / 2; $i++) {
                  ?>
                    <a href="#"><span class="fa fa-star"></span></a>
                  <?php
                }
                if($skills == 1 || $skills == 3 || $skills == 5 || $skills == 7 || $skills == 9) {
                  ?>
                  <a href="#"><span class="fa fa-star-half-o"></span></a>
                  <?php
                }
                else {
                  ?>
                  <a href="#"><span class="fa fa-star"></span></a>
                  <?php
                }
                if($skills == 8 || $skills == 7) {
                  ?>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <?php
                }
                if($skills == 6 || $skills == 5) {
                  ?>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <?php
                }
                if($skills == 4 || $skills == 3) {
                  ?>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <?php
                }
                if($skills == 2 || $skills == 1) {
                  ?>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <a href="#"><span class="fa fa-star-o"></span></a>
                  <?php
                }
              ?>
            </p></li><br>
              <li>Gehaltsvorstellungen: <?php echo number_format($gehalt, 2, ',', '.'); ?> €</li>
              <!--<li><button type="button" class="btn btn-xs col-md-12">Bewerbungsunterlagen</button></li>-->
            </ul>
          </div>
          <div class="right col-xs-5 text-center">
            <img src="<?php echo $bild?>" alt="" class="img-circle img-rounded img-responsive">
          </div>
        </div>
        <div class="col-xs-12 bottom text-center">
          <div class="col-xs-12 col-sm-12 emphasis">
            <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?hire=$id"; ?> class="btn btn-success btn-xs col-md-5 col-md-offset-1"> <i class="fa fa-user">
              </i> <i class="fa fa-comments-o"></i>Einstellen</a>
            <button onclick="window.open('https://www.xing.com/profile/Sabine_Rollinger/cv');" type="button" class="btn btn-primary btn-xs col-md-5">
              <i class="fa fa-user"> </i> Profil einsehen 
            </button>
          </div>
        </div>
      </div>
    </div>
<div class="clearfix">

<?php
}


public static function einstellenActivity(){
	
  $verfügbaresPersonal = Request::getFreieMitarbeiter();

  $mitarbeiter = Request::getMitarbeiter();

  $meineMitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);

  for($i = 0; $i < sizeof($verfügbaresPersonal); $i++) {

    $zeit = date('d.m.Y');
    if(!in_array($verfügbaresPersonal[$i]["ID"], $meineMitarbeiter, true)) {
      Personal::einstellen($verfügbaresPersonal[$i]["ID"], $verfügbaresPersonal[$i]["Fachrichtung"], $verfügbaresPersonal[$i]["Name"], $verfügbaresPersonal[$i]["Faehigkeit"], $verfügbaresPersonal[$i]["Beschreibung"], $verfügbaresPersonal[$i]["Bild"], $verfügbaresPersonal[$i]["Gehalt"]);
    }
  }

}

public static function bestand(){
	
  $mitarbeiter = Request::getMitarbeiter();

  if($mitarbeiter[0]["Mitarbeiter"] != "") {

    $mitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);

  ?>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Deine Mitarbeiter</h2>
    			<!-- Hilfe Funktionalität / Text / Popup-->
    			<?php include 'help/personal_bestand_help.php'; ?>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p>Eine Übersicht all deiner Mitarbeiter</p>
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 5%">Bild</th>
                <th style="width: 15%">Informationen</th>
	              <th style="width: 20%">Jahresgehalt</th>
                <th style="width: 15%">Motivation</th>
                <th style="width: 15%">Mehrwert</th>
                <th style="width: 30%; text-align:right">Aktionen</th>
              </tr>
            </thead>
            <tbody>
          	<?php 
          		for($i = 0; $i < sizeof($mitarbeiter); $i++) {

                $mid = $mitarbeiter[$i];

                $mib = Request::getMitarbeiterByID($mid);

          	?>
              <tr>
                <td>
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo $mib[0]["Bild"];?>" class="avatar" alt="Avatar">
                    </li>
                  </ul>
                </td>                          
                <td>
                  <p><?php echo $mib[0]["Name"];?></p>
                  <small><?php echo $mib[0]["Fachrichtung"];?></small>
                </td>
                <td>
                  <p><?php echo number_format($mib[0]["Gehalt"], 2, ',', '.') . " €";?></p>
                </td>
                <td class="project_progress">
                  <!--<div class="progress progress_sm">
                    <div class="progress-bar" style="background-color: green;" role="progressbar" data-transitiongoal="<?php $motivation = $mib[0]["Motivation"] * 10; echo $motivation;?>"></div>
                  </div>-->
                  
                  <span style="padding:10px;" class="col-md-8 label label-<?php if($mib[0]["Motivation"] < 4) { echo "danger"; } else if($mib[0]["Motivation"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($mib[0]["Motivation"] < 4) { echo "schlecht"; } else if($mib[0]["Motivation"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                </td>
                <!-- 
                Sachbearbeiter: +2 Gebäude
                Makler: +5% Mietpreise oder +5% Verkaufspreise
                Bauleiter: Bau von Gebäuden freigeschaltet
                Bauingenieur: Sanierung freigeschaltet
                -->
                <td><small style="font-size:10px">
                <?php 
                if($mib[0]["Fachrichtung"] == "Sachbearbeiterin") {
                  if($mib[0]["Faehigkeit"] > 6) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "+4 Gebäudeverwaltung";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "+3 Gebäudeverwaltung";
                    }
                    else {
                      echo "+2 Gebäudeverwaltung";
                    }
                  }
                  else if($mib[0]["Faehigkeit"] > 3) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "+3 Gebäudeverwaltung";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "+2 Gebäudeverwaltung";
                    }
                    else {
                      echo "+1 Gebäudeverwaltung";
                    }
                  }
                  else {
                    if($mib[0]["Motivation"] > 7) {
                      echo "+2 Gebäudeverwaltung";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "+1 Gebäudeverwaltung";
                    }
                    else {
                      echo "+0 Gebäudeverwaltung <i class='fa fa-frown-o'></i>";
                    }
                  }
                }
                else if($mib[0]["Fachrichtung"] == "Makler") {
                  if($mib[0]["Faehigkeit"] > 7) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+5% Verkaufspreise";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+3.5% Verkaufspreise";
                    }
                    else {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+1% Verkaufspreise";
                    }
                  }
                  else if($mib[0]["Faehigkeit"] > 3) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+3% Verkaufspreise";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+2% Verkaufspreise";
                    }
                    else {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+1% Verkaufspreise";
                    }
                  }
                  else {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+2% Verkaufspreise";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+1% Verkaufspreise";
                    }
                    else {
                      echo "Verkauf von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+0% Verkaufspreise <i class='fa fa-frown-o red'></i>";
                    }
                  }
                }
                else if($mib[0]["Fachrichtung"] == "Bauleiter") {
                  if($mib[0]["Faehigkeit"] > 7) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+5% Bauimmobilienwert";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+3.5% Bauimmobilienwert";
                    }
                    else {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+2% Bauimmobilienwert";
                    }
                  }
                  else if($mib[0]["Faehigkeit"] > 3) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+4% Bauimmobilienwert";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+2.5% Bauimmobilienwert";
                    }
                    else {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+1% Bauimmobilienwert";
                    }
                  }
                  else {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+3% Bauimmobilienwert";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Bau von Gebäuden möglich";
                      echo "<br>";
                      echo "+1.5% Bauimmobilienwert";
                    }
                    else {
                      echo "Bau von Gebäuden freigeschaltet";
                      echo "<br>";
                      echo "+0% Bauimmobilienwert <i class='fa fa-frown-o red'></i>";
                    }
                  }
                }
                else if($mib[0]["Fachrichtung"] == "Bauingenieur") {
                  if($mib[0]["Faehigkeit"] > 7) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-10% Sanierungskosten";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-7.5% Sanierungskosten";
                    }
                    else {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-5% Sanierungskosten";
                    }
                  }
                  else if($mib[0]["Faehigkeit"] > 3) {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-7.5% Sanierungskosten";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-5% Sanierungskosten";
                    }
                    else {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-2.5% Sanierungskosten";
                    }
                  }
                  else {
                    if($mib[0]["Motivation"] > 7) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-5% Sanierungskosten";
                    }
                    else if($mib[0]["Motivation"] > 3) {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-2.5% Sanierungskosten";
                    }
                    else {
                      echo "Sanierung von Gebäuden möglich";
                      echo "<br>";
                      echo "-0% Sanierungskosten <i class='fa fa-frown-o red'></i>";
                    }
                  }
                }

                ?></small></td>
                <td>
                  <button disabled type="button" class="btn btn-success btn-xs befoerdern col-md-6 pull-right" style="padding:5px;"><i class="fa fa-arrow-circle-o-up"></i> Gehaltserhöhung</button>
                  <!--  data-toggle="modal" data-target=<?php echo "'#befoerdern" . $mib[0]["ID"] . "'"; ?> -->
                  <!--<button type="button" class="btn btn-info btn-xs weiterbilden col-md-6 pull-right" data-toggle="modal" data-target=<?php echo "'#weiterbilden" . $mib[0]["ID"] . "'"; ?>><i class="fa fa-graduation-cap"></i> Weiterbilden</button>-->
                  <button type="button" class="btn btn-danger btn-xs kuendigen col-md-6 pull-right" style="padding:5px;" data-toggle="modal" data-target=<?php echo "'#entlassen" . $mib[0]["ID"] . "'"; ?>><i class="fa fa-times-circle-o"></i> Entlassen</button>
                </td>
              </tr>
          	  <?php 
                
          		}

          	  ?>
            </tbody>
          </table>
          
        </div>
      </div>

    </div>
    <?php
            $mitarbeiterListe = Request::getMitarbeiter();

            if($mitarbeiterListe[0]["Mitarbeiter"] != "") {

              $aktuelleMitarbeiter = explode(';', $mitarbeiterListe[0]["Mitarbeiter"]);

            }
            else {
              $aktuelleMitarbeiter = Array();
            }

            for($i = 0; $i < sizeof($aktuelleMitarbeiter); $i++) {
              Personal::createModalView("befoerdern" . $aktuelleMitarbeiter[$i], "Mitarbeiter/in befördern", $aktuelleMitarbeiter[$i]);
              Personal::createModalView("weiterbilden" . $aktuelleMitarbeiter[$i], "Mitarbeiter/in weiterbilden", $aktuelleMitarbeiter[$i]);
              Personal::createModalView("entlassen" . $aktuelleMitarbeiter[$i], "Mitarbeiter/in entlassen", $aktuelleMitarbeiter[$i]);
            }
              
          ?>
  </div>
<?php    
  }
  else {
    ?>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Deine Mitarbeiter</h2>
				<!-- Hilfe Funktionalität / Text / Popup-->
				<?php include 'help/personal_bestand_help.php'; ?>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p>Du hast noch keine Mitarbeiter eingestellt</p>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
}

public static function createModalView($id, $title, $mitarbeiterID) {
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

            if($id == "entlassen" . $mitarbeiterID) {

              $mitarbeiter = Request::getMitarbeiterByID($mitarbeiterID);

              $arbeitsqualität = "gute";
              $motivation = "durchschnittlich";

              if($mitarbeiter[0]["Motivation"] > 7) {
                $motivation = "außerordentlich";
              }
              else if($mitarbeiter[0]["Motivation"] > 5) {
                $motivation = "sehr";
              }
              else if($mitarbeiter[0]["Motivation"] > 4) {
                $motivation = "durchschnittlich";
              }
              else if($mitarbeiter[0]["Motivation"] > 2) {
                $motivation = "unterdurchschnittlich";
              }
              else if($mitarbeiter[0]["Motivation"] > 0) {
                $motivation = "gar nicht";
              }

              if($mitarbeiter[0]["Faehigkeit"] > 7) {
                $arbeitsqualität = "ausgezeichnete";
              }
              else if($mitarbeiter[0]["Faehigkeit"] > 5) {
                $arbeitsqualität = "sehr gute";
              }
              else if($mitarbeiter[0]["Faehigkeit"] > 4) {
                $arbeitsqualität = "gute";
              }
              else if($mitarbeiter[0]["Faehigkeit"] > 2) {
                $arbeitsqualität = "durchschnittliche";
              }
              else if($mitarbeiter[0]["Faehigkeit"] > 0) {
                $arbeitsqualität = "schlechte";
              }

              ?>
              <div class="modal-body col-md-12">
                  <div class="x_panel">

                      <div class="modal-content pull-right" style="width:150px; height:150px; border:none">
                        <img src=<?php echo $mitarbeiter[0]["Bild"]; ?> width="150px" height="150px">
                      </div>

                      <h2><?php echo $mitarbeiter[0]["Name"]; ?></h2>
                      <p><i><?php echo $mitarbeiter[0]["Fachrichtung"]; ?></i></p><br>
                      <p><b>Jahresgehalt:</b> <?php echo number_format($mitarbeiter[0]["Gehalt"], 2, ',', '.'); ?> €</p>
                      <p><b>Motivation:</b> <span class="green"><?php echo number_format($mitarbeiter[0]["Motivation"] * 10, 2, ',', '.'); ?> %</span></p>
                      <p><b>Fällige Abfindung bei fristloser Kündigung:</b> <span class="red"><?php echo number_format($mitarbeiter[0]["Gehalt"] * 0.75, 2, ',', '.'); ?> €</span></p>
                      <p><?php echo $mitarbeiter[0]["Name"]; ?> arbeitet seit 2017 als <?php echo $mitarbeiter[0]["Fachrichtung"]; ?> bei der Spire GmbH. <?php echo $mitarbeiter[0]["Name"]; ?> ist <?php echo $motivation; ?> motiviert und leistet <?php echo $arbeitsqualität; ?> Arbeit. Es wird ein Jahresgehalt von <?php echo number_format($mitarbeiter[0]["Gehalt"], 2, ',', '.'); ?> € ausgezahlt. Im Falle einer fristlosen Kündigung würde sofort eine Abfindung in Höhe von <?php echo number_format($mitarbeiter[0]["Gehalt"] * 0.75, 2, ',', '.'); ?> € fällig.<br><br>
                      <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?quit=$mitarbeiterID" ; ?> class="btn btn-primary btn-danger">fristlos Kündigen</a>
                    </div>
                      
              </div>
              <?php

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

}
?>