<?php
    
    session_start();
    require_once("includes.php"); 
		
?>

<?php 
	
	Menu::createMenu("Übersicht"); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		<?php

			$width = 10;
			$aktuellesGeschäftsjahr = 1;

			RecentActivities::createActivities($width, $numberOfNews, $aktuellesGeschäftsjahr);
		?>

		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>