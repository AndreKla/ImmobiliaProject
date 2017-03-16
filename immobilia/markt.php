<?php
    
    session_start();
    require_once("includes.php"); 	
	Menu::createMenu("Markt"); 

?>
	<!-- page content -->
	<div class="right_col" role="main">
            
<?php
                if($_GET['marktanalyse'] == 1) {

			Helper::showMessage("Marktanalyse","Die Marktanalyse ist jetzt verfügbar!", "success");
		}
		Markt::createMarktanalyse();
?>		
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>
