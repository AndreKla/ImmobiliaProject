<?php
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Übersicht"); 
?>		
	<!-- page content -->
	<div class="right_col" role="main">
	<?php

		if($_GET['socialbuy'] == 1) {

			Helper::showMessage("Social Media Analyse","Die Analyse der Social Intelligence GmbH ist jetzt verfügbar!", "success");
		}

		$spielID = $_SESSION["SID"];
		$unternehmensID = $_SESSION["UID"];

		$query = "
		SELECT Runde
		FROM Rundendaten
		WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
		ORDER BY Runde DESC
		;";
		$result = Database::sqlSelect($query);

		$width = 7;
		$aktuellesGeschäftsjahr = $result[0]["Runde"];

		Neuigkeiten::createNeuigkeiten($width, $aktuellesGeschäftsjahr);
		Neuigkeiten::createRatgeber();
		Neuigkeiten::checkForFeed($aktuellesGeschäftsjahr);
	?>

	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter();
?>