<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
	Menu::createMenu("Strategie"); 
?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		<?php

			$aktuellesGeschäftsjahr = 1;

			Strategie::createStrategieListe($aktuellesGeschäftsjahr);
			Elements::createJumbotron();

		?>
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
