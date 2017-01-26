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
	
	$query = "
  SELECT *
  FROM Mitarbeiter
  ;";
  $aktuellesPersonal = Database::sqlSelect($query);


  $sid = $_SESSION["SID"];
  $uid = $_SESSION["UID"];

  $query = "
  SELECT Mitarbeiter
  FROM Unternehmen
  WHERE SID = $sid AND ID = $uid
  ;";
  $mitarbeiter = Database::sqlSelect($query);

  $meineMitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);

  for($i = 0; $i < sizeof($aktuellesPersonal); $i++) {

    $zeit = date('d.m.Y');
    if(!in_array($aktuellesPersonal[$i]["ID"], $meineMitarbeiter, true)) {
      Personal::einstellen($aktuellesPersonal[$i]["ID"], $aktuellesPersonal[$i]["Fachrichtung"], $aktuellesPersonal[$i]["Name"], $aktuellesPersonal[$i]["Faehigkeit"], $aktuellesPersonal[$i]["Beschreibung"], $aktuellesPersonal[$i]["Bild"]);
    }
  }

}

public static function bestand(){
	
  $sid = $_SESSION["SID"];
  $uid = $_SESSION["UID"];

  $query = "
  SELECT Mitarbeiter
  FROM Unternehmen
  WHERE SID = $sid AND ID = $uid
  ;";
  $mitarbeiter = Database::sqlSelect($query);

  if($mitarbeiter[0]["Mitarbeiter"] != "") {

    $mitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);

  ?>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Deine Mitarbeiter</h2>
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

                $query = "
                SELECT *
                FROM Mitarbeiter
                WHERE ID = $mid
                ;";
                $mib = Database::sqlSelect($query);

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
                  <a href="#" class="btn btn-primary btn-xs befoerdern col-md-6"><i class="fa fa-arrow-circle-o-up"></i> Befördern </a>
                  <a href="#" class="btn btn-info btn-xs weiterbilden col-md-6"><i class="fa fa-graduation-cap"></i> Weiterbilden </a>
                  <a href="#" class="btn btn-danger btn-xs kuendigen col-md-6"><i class="fa fa-times-circle-o"></i> Kündigen </a>
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

public static function createBarometer(){

?>

		<div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                      <h4>Profile Completion</h4>
                      <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left">$</span>
                        <span id="gauge-text" class="gauge-value pull-left">3,200</span>
                        <span id="goal-text" class="goal-value pull-right">$5,000</span>
                      </div>
                    </div>
                  </div>
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