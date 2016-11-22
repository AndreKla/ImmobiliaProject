<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
		require_once("menu.php");
		Menu::createMenu("Immobilien"); 
		
		$query = "
		SELECT * FROM Informationen;";
		$result = Database::sqlSelect($query);
		var_dump($result);
		
?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		<?php
		
			News::createInfoPage();
			Konkurrenz::createKonkurrenz();
		?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
