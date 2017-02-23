<?php

class API {

	public static function addAusgabe($summe, $beschreibung, $details) {

        if(API::checkKontostand($summe)){

            $sid = $_SESSION["SID"];
            $uid = $_SESSION["UID"];
            $runde = $_SESSION["Runde"];

            $query = "
            INSERT INTO Ausgaben (SpielID, UnternehmensID, Runde, Summe, Beschreibung, Details)
            VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
            ;";
            Database::sqlInsert($query);

            $kapital = Request::getKontostand();

            $kontostand = $kapital - $summe;

            Request::setKontostand($kontostand);
            return true;
        }
        else {
            return false;
        }

	}

	public static function addEinnahme($summe, $beschreibung, $details) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

		$query = "
		INSERT INTO Einnahmen (SpielID, UnternehmensID, Runde, Summe, Beschreibung, Details)
		VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
		;";
		Database::sqlInsert($query);

        $kapital = Request::getKontostand();

		$kontostand = $kapital + $summe;

		Request::setKontostand($kontostand);

	}
	
	
	public function checkKontostand($summe){
		
		$kapital = Request::getKontostand();
                
        if ($kapital >= $summe) {

			return true;

		} else {

			return false;
            
		}
	}
	
	
	public static function buyImmobilie($immobilienId){
            
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
			
        $immobilie = Request::getImmobilie($immobilienId);

        if(API::addAusgabe($immobilie[0]["Kaufpreis"], "Immobilienkauf: " . $immobilie[0]["Beschreibung"], "Straße")) {
            
            $bestand = Request::getBestand();

            if ($bestand == "") {
                $bestandString = $immobilienId;
            }
            else {
                $bestandString = $bestand . ';' . $immobilienId;
            }

            Request::setBestand($bestandString);

        }
        else {

            Helper::showMessage("Kontostand zu gering", "Das Unternehmen hat die Bonitätsprüfung leider nicht bestanden", "error");

        }
        
    }

    public static function createCreditRequest($bank, $typ, $summe, $zins, $laufzeit, $chance) {
        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h5><?php echo $bank; ?></h5>
                <p><?php echo $typ; ?></p>
                <p>Kreditsumme: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Zins: <?php echo number_format($zins, 2, ',', '.'); ?> % p.a.</p>
                <p>Laufzeit: <?php echo $laufzeit; ?> Jahre</p>
                <p>Wahrscheinlichkeit: <?php echo $chance; ?> %</p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit=1'; ?> class="btn btn-primary">Kredit beantragen</a>
            </div>
        </div>
        <?php
    }


}
?>