<?php

class Menu {
	
	
public static function createMenu($titel) {


	Database::databaseConnect();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

	<?php   include('includes_css.php'); ?>

  </head>


 <body class="nav-md footer_fixed">
    <div class="container body">


<div class="main_container">
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="index.php" class="site_title"><span>Team Name</span></a>
	</div>

	<div class="clearfix"></div>

	<!-- menu profile quick info -->
	<div class="profile">
	  <div class="profile_pic">
		<img src="images/img.jpg" alt="..." class="img-circle profile_img">
	  </div>
	  <div class="profile_info">
		<span>Welcome,</span>
		<h2>John Doe</h2>
	  </div>
	</div>
	<!-- /menu profile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section" >
		<h3> - </h3>
		<ul class="nav side-menu">
		  <li><a><i class="fa fa-home"></i> Management Cockpit <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="uebersicht.php">Übersicht</a></li>
			  <li><a href="markt.php">Markt</a></li>
			  <li><a href="jahresabschluss.php">Jahresabschluss</a></li>
			  <li><a href="konkurrenz.php">Konkurrenz</a></li>
			  <li><a href="strategie.php">Strategie</a></li>
			</ul>
		  </li>
		  <li><a href="map.php"><i class="fa fa-edit"></i> Map</a>
		  </li>
		  <li><a href="immobilien.php"><i class="fa fa-home"></i> Immobilien / Grundstücke</a>
		  </li>
		  <li><a href="auktion.php"><i class="fa fa-edit"></i> Auktionen</span></a>
		  </li>
		</ul>
	  </div>
	  <div class="menu_section">
		<h3>Dein Unternehmen</h3>
		<ul class="nav side-menu">
		  <li><a><i class="fa fa-bug"></i> Personal <span class="fa fa-chevron-down"></span></a>
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

	<!-- /menu footer buttons -->
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
	<!-- /menu footer buttons -->
  </div>
</div>

<?php
}

public static function createFooter() {

?>

<!-- footer content -->
<footer style="background-color:#EDEDED">
  <div class="pull-right fixed" >
	Kapital: 10.000.000 €</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->

<?php
}}
?>




