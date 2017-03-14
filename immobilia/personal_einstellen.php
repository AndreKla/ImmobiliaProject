<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Personal Einstellen"); 

	if(isset($_GET["hire"])) {
		
		$uid = $_SESSION["UID"];
		$sid = $_SESSION["SID"];
		$mid = $_GET["hire"];

		$currentMitarbeiter = Request::getMitarbeiter();

		if($currentMitarbeiter[0]["Mitarbeiter"] != "") {
			$mitarbeiterArray = $currentMitarbeiter[0]["Mitarbeiter"] . ";" . $mid;
		}
		else {
			$mitarbeiterArray = $mid;
		}
		
		Request::setMitarbeiter($mitarbeiterArray);
		$mitarbeiter = Request::getMitarbeiterByID($_GET["hire"]);
		API::addAusgabe($mitarbeiter[0]["Gehalt"], "Jahresgehalt", $mitarbeiter[0]["Name"] . " - " . $mitarbeiter[0]["Fachrichtung"]);
                API::createBuchungsAufgabe("Personalaufwendungen", "Bank", $mitarbeiter[0]["Gehalt"], "Jahresgehalt " . $mitarbeiter[0]["Name"] . " - " . $mitarbeiter[0]["Fachrichtung"]);
		?>
		<script language="javascript">
            window.location.href = "personal_bestand.php?hired=<?php echo $mid; ?>"
        </script>
        <?php
	}

?>			
	<!-- page content -->
	<div class="right_col" role="main">
		<?php
			Personal::einstellenActivity();
		?>
	</div>
	<!-- /page content -->
<?php 
	Menu::createFooter(); 
?>