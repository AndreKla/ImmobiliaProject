<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
		Menu::createMenu("Personal Einstellen"); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
			<?php
				Personal::einstellenActivity();

			?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
