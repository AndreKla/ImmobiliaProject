<?php
    
    session_start();
    require_once("includes.php");

	Menu::createMenu("Immobilien"); 

	if(isset($_GET["verkauf"])) {
		$immoID = $_GET["verkauf"];
		$summe = $_GET["preis"];
		$zeitpunkt = $_GET["zeitpunkt"];

		API::sellImmobilie($immoID, $summe, $zeitpunkt);
	}

	if(isset($_GET["vermieten"])) {
		$immoID = $_GET["vermieten"];
		$summe = $_GET["preis"];
		$zeitpunkt = $_GET["zeitpunkt"];

		API::rentImmobilie($immoID, $summe, $zeitpunkt);
	}

	if(isset($_GET["sanieren"])) {
		$immoID = $_GET["sanieren"];
		$summe = $_GET["preis"];
		$wertsteigerung = $_GET["wertsteigerung"];
		$zustand = $_GET["zustand"];

		API::renewImmobilie($immoID, $summe, $wertsteigerung, $zustand);
	}

	if(isset($_GET["bauen"])) {
		$immoID = $_GET["bauen"];
		$summe = $_GET["preis"];
		$wertsteigerung = $_GET["wertsteigerung"];
		$zustand = $_GET["zustand"];
		$dauer = $_GET["dauer"];

		API::buildImmobilie($immoID, $summe, $wertsteigerung, $zustand, $dauer);
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