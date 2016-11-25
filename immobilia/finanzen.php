<?php  
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Jahresabschluss"); 
?>
	
	<!-- page content -->
	<div class="right_col" role="main">
	<?php
		Finanzen::createFinanzenTopData();
	?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>