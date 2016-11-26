<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Personal Bestand"); 

?>
						
	<!-- page content -->
	<div class="right_col" role="main">
		<?php
			Personal::bestand();
		?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>