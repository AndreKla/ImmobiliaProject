<?php
    
    session_start();
    require_once("includes.php"); 
    Menu::createMenu("Bestandskonten"); 
    
    API::checkBuchungenErledigt();
    Bestandskonten::createBuchungstool();	

?>

		
<?php 
    Menu::createFooter(); 
?>