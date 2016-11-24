<?php
    
    session_start();
<<<<<<< HEAD
    require_once("classes/includes.php"); 
	
	//Schnick schnack schnuck
	// STEIN!
=======
    require_once("includes.php"); 
>>>>>>> origin/master
		
?>

<?php 
<<<<<<< HEAD

		Menu::createMenu("Jahresabschluss"); 
		echo "Nuttensöhne gucken böse, ich bin back!";

=======
		require_once("menu.php");
		Menu::createMenu("Jahresabschluss");
>>>>>>> origin/master
?>

						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'classes/includes_js.php'; ?> 
	
  </body>
</html>
