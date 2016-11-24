<?php
    
    session_start();
    require_once("includes.php"); 

		
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
			
			Jahresuebersicht::createJahresuebersicht();
			TopListOverview::createTopList();
			ToDoList::createToDoList();
			RecentActivities::createActivities();
			ProjectDetails::createDetails();
			NetworkActivities::createActivity();
			
			GridSlider::createGridslider();
		?>
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
