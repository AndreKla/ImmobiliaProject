<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Immobilien"); 
				
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