<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Personal Einstellen"); 

	if(isset($_GET["hire"])) {
		
		$uid = $_SESSION["UID"];
		$sid = $_SESSION["SID"];

		$mid = $_GET["hire"];

		$query = "
		SELECT Mitarbeiter
		FROM Unternehmen
		WHERE ID = $uid AND SID = $sid
		;";
		$currentMitarbeiter = Database::sqlSelect($query);


		if($currentMitarbeiter[0]["Mitarbeiter"] != "") {
			$mitarbeiterArray = $currentMitarbeiter[0]["Mitarbeiter"] . ";" . $mid;
		}
		else {
			$mitarbeiterArray = $mid;
		}
		
		$query = "
		UPDATE Unternehmen
		SET Mitarbeiter = '" . $mitarbeiterArray . "'
		WHERE ID = $uid AND SID = $sid
		;";
		Database::sqlUpdate($query);

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