<?php
    
    session_start();
    require_once("includes.php"); 	
	Menu::createMenu("Markt"); 

?>
	<!-- page content -->
	<div class="right_col" role="main">
<?php
		Markt::createMarktanalyse();
?>		
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>
