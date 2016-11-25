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
			$numberOfNews = 5;

			RecentActivities::createActivities($width, $numberOfNews);
		?>

		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
