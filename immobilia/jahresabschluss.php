<?php
    
    session_start();
    require_once("includes.php"); 
	
	//Schnick schnack schnuck
	// STEIN!
		
?>

<?php 
		require_once("menu.php");
		Menu::createMenu("Jahresabschluss"); 
		echo "Nuttensöhne gucken böse, ich bin back!";

?>

						
						
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
