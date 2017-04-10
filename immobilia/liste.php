<?php
    
    session_start();
    
    require_once("includes.php"); 
    
    Menu::createMenu("Immobilienliste"); 
    
?>

    <div class="right_col" role="main" style="padding-bottom:55px;">

        <?php

        Liste::createListe();

        ?>

    </div>

<?php 
  Menu::createFooter(); 
?>
