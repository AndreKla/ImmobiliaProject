<?php
    
    session_start();
    require_once("includes.php"); 

		
?>
<?php 
		Menu::createMenu("Immobilien"); 
				
?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		<?php
		
			Personal::einstellen();

		?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
