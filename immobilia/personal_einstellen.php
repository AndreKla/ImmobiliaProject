<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Personal Einstellen"); 

?>
					
	<!-- page content -->
	<div class="right_col" role="main">
		<?php
			Personal::einstellenActivity();

		?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>