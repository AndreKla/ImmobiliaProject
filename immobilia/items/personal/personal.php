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
	
	
public static function einstellen($bezeichnung, $name, $skills, $rating) {


?>


                            <h4 class="brief"><i><?php echo $bezeichnung; ?></i></h4>
                            <div class="left col-xs-7">
                              <h2><?php echo $name; ?></h2>
                              <p><strong>Skills: </strong> <?php echo $skills; ?></p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a><?php echo $rating; ?></a><br>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star-o"></span></a>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                </i> <i class="fa fa-comments-o"></i> Einstellen </button><br>
                              <button onclick="window.open('https://www.xing.com/profile/Sabine_Rollinger/cv');" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Profil angucken 
                              </button>


                      

<?php
}


public static function einstellenActivity(){
	
	$query = "
    SELECT *
    FROM Mitarbeiter
    ;";
    $aktuellesPersonal = Database::sqlSelect($query);

	
?>
	  <div class="clearfix"></div>

		  <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
			<div class="well profile_view">
			  <div class="col-sm-12">
			  
				  <?php

					for($i = 0; $i < sizeof($aktuellesPersonal); $i++) {

					  $zeit = date('d.m.Y');

					  Personal::einstellen($aktuellesPersonal[$i]["Fachrichtung"], $aktuellesPersonal[$i]["Name"], $aktuellesPersonal[$i]["Faehigkeit"], $aktuellesPersonal[$i]["Beschreibung"]);

					}

				  ?>
				
		
				</div>
			  </div>
			</div>
		  </div>


<?php
}

public static function bestand(){
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Mitarbeiter
    ;";
    $mitarbeiter = Database::sqlSelect($query);
	
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
                          <th style="width: 15%">Berufsbezeichnung</th>
						  <th style="width: 20%">Beschreibung</th>
                          <th style="width: 15%">Zufriedenheit</th>
                          <th style="width: 15%">Status</th>
                          <th style="width: 30%">Optionen</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php 
							for($i = 0; $i < sizeof($mitarbeiter); $i++) {
							
						?>
                        <tr>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>                          
						  <td>
                            <a><?php echo $mitarbeiter[$i]["Fachrichtung"];?></a>
                            <br />
                            <small><?php echo $mitarbeiter[$i]["Name"];?> - <?php echo $mitarbeiter[$i]["Gehalt"];?> €</small>
                          </td>
						  <td>
                            <p><?php echo $mitarbeiter[$i]["Beschreibung"];?></p>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $mitarbeiter[$i]["Motivation"];?>"></div>
                            </div>
                            <small><?php echo $mitarbeiter[$i]["Motivation"]." %";?></small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">Erfolgreich</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Befördern </a>
                            <a href="#" class="btn btn-info btn-xs weiterbilden"><i class="fa fa-pencil"></i> Weiterbilden </a>
                            <a href="#" class="btn btn-danger btn-xs kuendigen"><i class="fa fa-trash-o"></i> Kündigen </a>
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