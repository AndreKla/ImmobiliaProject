
<?php

class Menu {

public static function checkForCompletion() {

	$spielID = $_SESSION["SID"];
	$unternehmensID = $_SESSION["UID"];

	$query = "
	SELECT Strategie1
	FROM Rundendaten
	WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
	ORDER BY Runde DESC
	;";
	$result = Database::sqlSelect($query);

	if(sizeof($result) > 0) {
		if($result[0]["Strategie1"] != 0) {
			?>

				<script>

				$(document).ready(function() {

					$('#menu_strategie').css('color', '#1ABB9C');

				});

				</script>

			<?php
		}
	}

}
	
public static function includeHead() {
	date_default_timezone_set('Europe/Berlin');
	Database::databaseConnect();

	$spielID = $_SESSION["SID"];
	$unternehmensID = $_SESSION["UID"];

	$query = "
    SELECT Runde
    FROM Rundendaten
    WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
    ORDER BY Runde DESC
    ;";
    $runde = Database::sqlSelect($query);

    if(sizeof($runde) > 0) {
    	$aktuelleRunde = $runde[0]["Runde"];

    	$_SESSION["Runde"] = $aktuelleRunde;
    }
    else {
    	$_SESSION["Runde"] = 0;
    }
    

	include('includes_css.php');
}
	
public static function createMenu($titel) {

	// REMOVE THIS TO ACTIVATE LOGIN
	/*
	if($_SESSION["SID"] != 1 && $_SESSION["UID"] != 1) {

		$_SESSION["SID"] = 1;
		$_SESSION["UID"] = 1;

	}
	*/

	date_default_timezone_set('Europe/Berlin');
	Database::databaseConnect();

    $runde = Request::getRundendaten();
    $yearsToAdd = $runde[0]["Runde"] - 1;
    $aktuelleRunde = $runde[0]["Runde"];

    $_SESSION["Runde"] = $aktuelleRunde;

	$unternehmen = Request::getUnternehmen();

	$mitarbeiter = Request::getMitarbeiter();

	

	if($mitarbeiter[0]["Mitarbeiter"] != "") {
		$mitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);
	}
	else {
		$mitarbeiter = Array();
	}
	
	$bestand = Request::getBestand();

          
?>
<html lang="de">
  <head>
	<?php   include('includes_css.php'); ?>
	<style>
	.right_col{
		overflow:auto;
		height: 100%;
		margin-top:-20px;
	}
	
	body{
		overflow:hidden;
	}
	
	</style>
	
	<style>
		.main_container{
			height:100%;
			
		}
		.left_col{
			position:absolute;
			z-index:5;
			top:0;
			left:0;
			
		}
	</style>
	<meta charset="UTF-8">
	</head>
 <body class="nav-md footer_fixed">
    <div class="container body">


<div class="main_container" >
<div class="col-md-3 left_col" style="z-index:100">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="index.php" class="site_title" style="font-size:12pt"><span><?php echo $unternehmen[0]["Unternehmensname"]; ?></span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile">
	  <div class="profile_info">
		<h2><?php echo $unternehmen[0]["Spieler1"]; ?></h2>
	  </div>
	  	<span style="margin-left:10px; color: #9AC;"> <?php echo "Geschäftsjahr: " . $aktuelleRunde; ?> </span><br>
		<span style="margin-left:10px; color: #9AC;"> Kontostand:</span><span class="green"> <?php echo number_format($runde[0]["Kapital"], 2, ',', '.'); ?> € </span><br>
                <span style="margin-left:10px; color: #9AC;"> Immobilien: <?php echo sizeof($bestand);?></span><br>
		<span style="margin-left:10px; color: #9AC;"> Mitarbeiter: <?php echo sizeof($mitarbeiter); ?></span>
	</div>
	<!-- /menu profile quick info -->

	<br />


	
	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section" >
	  	<!--	<h3> <?php echo date('d.m.Y', strtotime("+" . $yearsToAdd . " year")) . " - " . $aktuelleRunde . ". Geschäftsjahr"; ?> </h3>-->
		
		<ul class="nav side-menu">
		  <li><a><i class="fa fa-cubes"></i> Management Cockpit <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="neuigkeiten.php">Neuigkeiten</a></li>
			  <li><a href="finanzen.php">Finanzen</a></li>
			  <li><a href="markt.php">Markt</a></li>
			  <li><a href="konkurrenz.php">Konkurrenz</a></li>
			  <li><a href="strategie.php" id="menu_strategie">Strategie</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-home"></i> Immobilien <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="karte.php">Karte</a></li>
			  <li><a href="bestand.php">Bestand</a></li>
			  <li><a href="auktion.php">Auktionen</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-users"></i> Personal <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="personal_bestand.php">Bestand</a></li>
			  <li><a href="personal_einstellen.php">Einstellen</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-exchange"></i> Buchungen <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="bestandskonten.php">Konten</a></li>
			  <li><a href="sbk.php">SBK </a></li>
			  <li><a href="gewinn_verlust.php">GV</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-spinner"></i> Geschäftsjahr abschließen</span></li></a>
		</ul>
	  </div>
	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons 
	<div class="sidebar-footer hidden-small">
	  <a data-toggle="tooltip" data-placement="top" title="Settings">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
		<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Lock">
		<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Logout">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	  </a>
	</div>
	 /menu footer buttons -->
	 
	 
  </div>
</div>

<?php

Menu::checkForCompletion();

}

public static function createFooter() {

	$spielID = $_SESSION["SID"];
	$unternehmensID = $_SESSION["UID"];

	$query = "
	SELECT Kapital
	FROM Rundendaten
	WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
	ORDER BY Runde DESC
    ;";
    $kapital = Database::sqlSelect($query);

?>

<!-- footer content 
<footer style="background-color:#EDEDED;z-index:30" >
  <div class="pull-right fixed" >
  	<p style="text-align: right"><i class="fa fa-bank"></i> Kontostand</p>
	<h4 style="color: #1ABB9C"><?php echo number_format($kapital[0]["Kapital"], 2, ',', ' '); ?> <i class="fa fa-euro"></i></h4>
  </div>
  <div class="clearfix"></div>
</footer>
-->

      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>

<?php
}}
?>




