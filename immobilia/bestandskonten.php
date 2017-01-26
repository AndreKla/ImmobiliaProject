<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Bestandskonten"); 
	Bestandskonten::createBuchungstool();			

?>

		
<?php 
	Menu::createFooter(); 
?>