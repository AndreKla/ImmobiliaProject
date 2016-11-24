<?php
    
    session_start();
    require_once("classes/includes.php"); 
	include 'classes/includes_css.php'; 

		
?>
<?php 
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
			BuchungUebersicht::createUebersicht();
			Personal::bestand();
			Personal::einstellen();
			Personal::createBarometer();
		?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'classes/includes_js.php'; ?> 
	
  </body>
</html>
