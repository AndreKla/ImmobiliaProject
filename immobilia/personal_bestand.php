<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Personal Bestand"); 

	if(isset($_GET["hired"])) {
		$mitarbeiter = Request::getMitarbeiterByID($_GET["hired"]);

		Helper::showMessage($mitarbeiter[0]["Name"] . " wurde erfolgreich eingestellt", $mitarbeiter[0]["Fachrichtung"], "success");
		
	}

	if(isset($_GET["quit"])) {
		$mitarbeiter = Request::getMitarbeiterByID($_GET["quit"]);

		API::addAusgabe($mitarbeiter[0]["Gehalt"] * 0.75, $mitarbeiter[0]["Name"] . " - " . $mitarbeiter[0]["Fachrichtung"], "Abfindung: Kündigung");

		API::removeMitarbeiter($_GET["quit"]);

	}

	if(isset($_GET['successquit'])) {

		$mitarbeiter = Request::getMitarbeiterByID($_GET['successquit']);

		Helper::showMessage("Kündigung erfolgreich","" . $mitarbeiter[0]["Name"] . " wurde fristlos gekündigt. Es wurde eine Abfindung fällig!", "error");
	}

?>
						
	<!-- page content -->
	<div class="right_col" role="main">
		<?php
			Personal::bestand();
		?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>