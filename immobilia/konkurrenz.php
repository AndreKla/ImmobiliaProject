<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Konkurrenz");

	if(isset($_GET["konkurrenz"])) {

		$unternehmensID = $_SESSION["UID"];
		$spielID = $_SESSION["SID"];
		$runde = $_SESSION["Runde"];

		$query = "
		UPDATE Rundendaten
		SET Konkurrenz = 1
		WHERE UnternehmensID = $unternehmensID AND SpielID = $spielID AND Runde = $runde
		;";
		Database::sqlUpdate($query);
		API::addAusgabe(25000, "Konkurrenzanalyse", "Immobilienmarkt Analyse - Konkurrenz");

		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		?>
		<script>
			window.location = <?php echo "'" . $actual_link . "?konkurrenzbuy=1'";?>
		</script>
		<?php
	}

	if(isset($_GET["konkurrenzbuy"])) {
		Helper::showMessage("Konkurrenzanalyse gekauft", "Die Konkurrenzanalyse ist jetzt verfügbar", "success");
	}

?>
					
	<!-- page content -->
	<div class="right_col" role="main">
	<?php 
		if(Konkurrenz::checkForKonkurrenz()) {
			Konkurrenz::showKonkurrenz();
		}
		else {
			Konkurrenz::createKonkurrenz();
		}
	?>
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>