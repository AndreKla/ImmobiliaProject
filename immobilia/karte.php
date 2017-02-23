<link href="css/map.css" rel="stylesheet">

<?php
    
    session_start();
    
    require_once("includes.php"); 
    
    Menu::createMenu("Immobilienkarte"); 

    if(isset($_GET['immokauf'])) {

        $unternehmensID = $_SESSION["UID"];
        $spielID = $_SESSION["SID"];
        $runde = $_SESSION["Runde"];

        API::buyImmobilie($_GET['immokauf']);

    }

    Karte::createAccordionMap();
    
?>

 <body class="nav-md footer_fixed">
    <div class="container body">
	
      <div class="main_container">
        <?php

        Karte::createMarkers();
        ?>

    </div>

<?php 
  Menu::createFooter(); 
?>
