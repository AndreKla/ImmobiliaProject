<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Aufwand/Ertrag"); 

?>
				
	<!-- page content -->
	<div class="right_col" role="main">
	
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>