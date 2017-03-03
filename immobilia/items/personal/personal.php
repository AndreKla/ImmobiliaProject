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
	
	
public static function einstellen($id, $bezeichnung, $name, $skills, $rating, $bild) {
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
              <a><?php echo $rating; ?></a>
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
              <li><button type="button" class="btn btn-xs col-md-12">Bewerbungsunterlagen</button></li>
            </ul>
          </div>
          <div class="right col-xs-5 text-center">
            <img src="<?php echo $bild?>" alt="" class="img-circle img-rounded img-responsive">
          </div>
        </div>
        <div class="col-xs-12 bottom text-center">
          <div class="col-xs-12 col-sm-12 emphasis">
            <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?hire=$id"; ?> class="btn btn-success btn-xs col-md-5 col-md-offset-1"> <i class="fa fa-user">
              </i> <i class="fa fa-comments-o"></i>Einladen</a>
            <button onclick="window.open('https://www.xing.com/profile/Sabine_Rollinger/cv');" type="button" class="btn btn-primary btn-xs col-md-5">
              <i class="fa fa-user"> </i> Profil einsehen 
            </button>
          </div>
        </div>
      </div>
    </div>

<?php
}


public static function einstellenActivity(){
	
  $verfügbaresPersonal = Request::getFreieMitarbeiter();

  $mitarbeiter = Request::getMitarbeiter();

  $meineMitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);

  for($i = 0; $i < sizeof($verfügbaresPersonal); $i++) {

    $zeit = date('d.m.Y');
    if(!in_array($verfügbaresPersonal[$i]["ID"], $meineMitarbeiter, true)) {
      Personal::einstellen($verfügbaresPersonal[$i]["ID"], $verfügbaresPersonal[$i]["Fachrichtung"], $verfügbaresPersonal[$i]["Name"], $verfügbaresPersonal[$i]["Faehigkeit"], $verfügbaresPersonal[$i]["Beschreibung"], $verfügbaresPersonal[$i]["Bild"]);
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
                <th style="width: 15%"></th>
                <th style="width: 30%">Aktionen</th>
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
                  <div class="progress progress_sm">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php $motivation = $mib[0]["Motivation"] * 10; echo $motivation;?>"></div>
                  </div>
                  <small><?php 
                    echo $motivation." %";
                  ?></small>
                </td>
                <td>
                  <button type="button" class="btn btn-success btn-xs">Zufrieden</button>
                </td>
                <td>
                  <button type="button" class="btn btn-primary btn-xs befoerdern col-md-6" data-toggle="modal" data-target=<?php echo "'#befoerdern" . $mib[0]["ID"] . "'"; ?>><i class="fa fa-arrow-circle-o-up"></i> Befördern</button>
                  <button type="button" class="btn btn-info btn-xs weiterbilden col-md-6" data-toggle="modal" data-target=<?php echo "'#weiterbilden" . $mib[0]["ID"] . "'"; ?>><i class="fa fa-graduation-cap"></i> Weiterbilden</button>
                  <button type="button" class="btn btn-danger btn-xs kuendigen col-md-6" data-toggle="modal" data-target=<?php echo "'#entlassen" . $mib[0]["ID"] . "'"; ?>><i class="fa fa-times-circle-o"></i> Entlassen</button>
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

public static function befoerdern(){ 

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke für die Bestellung...")
	</script>  

<?php
}

public static function weiterbilden(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke für die Bestellung...")
	</script>  
<?php

}
public static function kuendigen(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke für die Bestellung...")
	</script>  
<?php
}}
?>