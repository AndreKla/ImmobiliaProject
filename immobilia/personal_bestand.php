<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
		Menu::createMenu("Personal Bestand"); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
			<?php
			?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
