<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Übersicht"); 

?>
				
	<!-- page content -->
	<div class="right_col" role="main">
	<?php

		$width = 8;
		$aktuellesGeschäftsjahr = 1;

		RecentActivities::createActivities($width, $aktuellesGeschäftsjahr);
	?>

	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>