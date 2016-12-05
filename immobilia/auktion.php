
<?php 
		require_once("includes.php"); 
		// NOCH TO COME!
		Menu::createMenu("Auktion"); ?>

        <!-- page content -->
        <div class="right_col" role="main" >
			<?php
				Auktion::createAuktion();
			?>
		</div>


		<!-- /page content -->
          
	
<?php include 'includes_js.php'; ?>

		
<?php 
	Menu::createFooter(); 
?>