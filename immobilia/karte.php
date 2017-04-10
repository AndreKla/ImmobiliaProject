<link href="css/map.css" rel="stylesheet">

<?php
    
    session_start();
    
    require_once("includes.php"); 
    
    Menu::createMenu("Immobilienkarte"); 

    if(isset($_GET['immokauf'])) {

        API::buyImmobilie($_GET['immokauf']);

    }

    //Karte::createAccordionMap();
    
?>

    <div class="right_col" role="main" style="padding-bottom:55px;">

        <?php

        Karte::createMarkers();

        ?>

    </div>

<?php 
  Menu::createFooter(); 
?>
