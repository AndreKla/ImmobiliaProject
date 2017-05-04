<?php
    
    session_start();
    require_once("includes.php");

	Menu::createMenu("Immobilien"); 

	if(isset($_GET["verkauf"])) {
		if(API::canSell()) {
			$immoID = $_GET["verkauf"];
			$summe = $_GET["preis"];
			$zeitpunkt = $_GET["zeitpunkt"];

			API::sellImmobilie($immoID, $summe, $zeitpunkt);
		}
		else {
			Helper::showMessage("Keinen Makler", "Du hast keinen Makler angestellt und kannst daher keine Immobilien verkaufen", "error");
		}
	}

	if(isset($_POST["vermieten"])) {
		$immoID = $_POST["vermieten"];
		$summe = $_POST["preis"];
		$previousMiete = $_POST["previousMiete"];

		API::rentImmobilie($immoID, $summe, 0, $previousMiete);
	}

	if(isset($_GET["sanieren"])) {
		if(API::canRenew()) {
			$immoID = $_GET["sanieren"];
			$summe = $_GET["preis"];
			$wertsteigerung = $_GET["wertsteigerung"];
			$zustand = $_GET["zustand"];

			API::renewImmobilie($immoID, $summe, $wertsteigerung, $zustand);
		}
		else {
			Helper::showMessage("Keinen Bauingenieur", "Du hast keinen Bauingenieur angestellt und kannst daher keine Immobilien sanieren", "error");
		}	
	}

	if(isset($_GET["bauen"])) {
		if(API::canBuild()) {
			$immoID = $_GET["bauen"];
			$summe = $_GET["preis"];
			$wertsteigerung = $_GET["wertsteigerung"];
			$zustand = $_GET["zustand"];
			$dauer = $_GET["dauer"];

			API::buildImmobilie($immoID, $summe, $wertsteigerung, $zustand, $dauer);
		}
		else {
			Helper::showMessage("Keinen Bauleiter", "Du hast keinen Bauleiter angestellt und kannst daher keine Immobilien bauen", "error");
		}
		
	}
			
?>

	<div class="right_col" role="main">
	<?php
		
		$rundendaten = Request::getRundendaten();

		$aktuellesGeschäftsjahr = $rundendaten[0]["Runde"];

		Bestand::createBestand($aktuellesGeschäftsjahr);

	?>
	</div>
		
<?php 
	Menu::createFooter(); 
?>