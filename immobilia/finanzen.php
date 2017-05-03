<?php  
  session_start();
  require_once("includes.php"); 
	Menu::createMenu("Jahresabschluss"); 
?>


	<div class="right_col" role="main">
		
	<?php


        
    if(isset($_POST["kreditsumme"])) {
        
        $summe = $_POST["kreditsumme"];
        API::checkCreditZulassung($summe);

        /*
      $kredit = Request::getKreditByID($_GET["credit"]);

      $random = rand(0, 100);

      if($kredit[0]["Genehmigungswahrscheinlichkeit"] > $random) {
        Helper::showMessage("Kreditantrag genehmigt", "Dein Kreditantrag wurde akzeptiert!", "success");
        API::addEinnahme($kredit[0]["Kreditsumme"], $kredit[0]["Kredittyp"], $kredit[0]["Bankname"]);
        API::addFremdkapital($kredit[0]["Kreditsumme"]);
        Request::setKreditForRound();
      }
      else {
        Helper::showMessage("Kreditantrag abgelehnt", "Dein Kreditantrag wurde leider nicht angenommen!", "error");
      }*/
    }

    if(isset($_GET["anlage"])) {
      $anlage = Request::getAnlageoptionByID($_GET["anlage"]);

      if(API::checkKontostand($anlage[0]["Summe"])) {
        Helper::showMessage("Geld angelegt", "Du hast dein Geld erfolgreich angelegt!", "success");
        API::addAusgabe($anlage[0]["Summe"], "Geldanlage",$anlage[0]["Name"]);
        API::addAnlagekapital($anlage[0]["Summe"]);
        Request::setAnlageForRound();
      }
      else {
        Helper::showMessage("Geld nicht angelegt", "Du hast nicht genug Kapital um so viel Geld anzulegen!", "error");
      }

    }

    Finanzen::createFinanzenTopData(sizeof($rundendaten));
    Finanzen::createBankview(sizeof($rundendaten));
    API::creditKonditionenModal();
    Finanzen::createCashflowGraph();
	?>

	</div>
		
<?php 
	Menu::createFooter(); 
?>