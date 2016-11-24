<?php
    
    session_start();
    require_once("includes.php"); 
		
?>

<?php 
		require_once("menu.php");
		Menu::createMenu("Jahresabschluss"); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
