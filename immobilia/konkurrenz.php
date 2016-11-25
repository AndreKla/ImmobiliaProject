<?php
    
    session_start();
    require_once("includes.php"); 
		
?>

<?php 
	Menu::createMenu("Konkurrenz"); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		<?php
			TopListOverview::createTopList();
		?>
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
