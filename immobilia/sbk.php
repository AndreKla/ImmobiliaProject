<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("SBK");

?>
					
	<!-- page content -->
	<div class="right_col" role="main">
	
        <?php
            SBK::createSBK();
        ?>
           
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>