<?php

class Menu {

public static function checkForCompletion() {

	$query = "
	SELECT Strategie1
	FROM Unternehmen
	WHERE ID = 1
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
	
	
public static function createMenu($titel) {

	Database::databaseConnect();

	$query = "
	SELECT * 
	FROM Unternehmen
	WHERE ID = 1
	;";
	$unternehmen = Database::sqlSelect($query);

?>

	<?php   include('includes_css.php'); ?>
	<style>
	.right_col{
		overflow:auto;
		height: 100%;
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
			z-index:50;
			top:0;
			left:0;
			
		}
	</style>
 <body class="nav-md footer_fixed" >
    <div class="container body">


<div class="main_container" >
<div class="col-md-3 left_col" style="z-index:100">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="index.php" class="site_title"><span><?php echo $unternehmen[0]["Unternehmensname"]; ?></span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile">
	  <div class="profile_pic">
		<img src="images/img.jpg" alt="..." class="img-circle profile_img">
	  </div>
	  <div class="profile_info">
		<span>Willkommen,</span>
		<h2><?php echo $unternehmen[0]["Spieler1"]; ?></h2>
	  </div>
	</div>
	<!-- /menu profile quick info -->

	<br />


	
	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section" >
		<h3> <?php echo date('d.m.Y'); ?> </h3>
		<ul class="nav side-menu">
		  <li><a><i class="fa fa-home"></i> Management Cockpit <span class="fa fa-chevron-down"></span></a>
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
			  <li><a href="map.php">Karte</a></li>
			  <li><a href="immobilien.php">Immobilien / Grundstücke</a></li>
			  <li><a href="auktion.php">Auktionen</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-home"></i> Personal <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="personal_bestand.php">Bestand</a></li>
			  <li><a href="personal_einstellen.php">Einstellen</a></li>
			</ul>
		  </li>
		  <li><a><i class="fa fa-windows"></i> Buchungen <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="bestandskonten.php">Bestands Konten</a></li>
			  <li><a href="aufwand_ertrag.php">Aufwand Ertrags Konten</a></li>
			  <li><a href="sbk.php">SBK </a></li>
			  <li><a href="gewinn_verlust.php">GV</a></li>
			</ul>
		  </li>
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

?>

<!-- footer content -->
<footer style="background-color:#EDEDED;z-index:30" >
  <div class="pull-right fixed" >
	Kapital: 10.000.000 <i class="fa fa-euro"></i></a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>

<?php
}}
?>




