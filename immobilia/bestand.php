<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Immobilien"); 
				
?>
					
	<!-- page content -->
	<div class="right_col" role="main">
	<?php

		$spielID = $_SESSION["SID"];
		$unternehmensID = $_SESSION["UID"];
		
		$query = "
		SELECT Runde
		FROM Rundendaten
		WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
		ORDER BY Runde DESC
		;";
		$result = Database::sqlSelect($query);

		$aktuellesGeschäftsjahr = $result[0]["Runde"];

		Bestand::createBestand($aktuellesGeschäftsjahr);

	?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>