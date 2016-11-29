<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Konkurrenz");

?>
					
	<!-- page content -->
	<div class="right_col" role="main">
	<?php Konkurrenz::createKonkurrenz();?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>