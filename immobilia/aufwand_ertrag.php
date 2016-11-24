<?php
    
    session_start();
    require_once("classes/includes.php"); 
		
?>
<?php 
		Menu::createMenu("Aufwand/Ertrag"); ?>
						
						
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
