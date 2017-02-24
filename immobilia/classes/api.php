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

    public static function addFremdkapital($summe) {
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $rundendaten = Request::getRundendaten();

        $fremdkapital = $rundendaten[0]["Fremdkapital"] + $summe;
        
        $query = "
        UPDATE Rundendaten
        SET Fremdkapital = $fremdkapital
        WHERE UnternehmensID = $uid AND SpielID = $sid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);
    }

    public static function removeFremdkapital() {

    }

    public static function addAnlagekapital($summe) {
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $rundendaten = Request::getRundendaten();

        $anlagekapital = $rundendaten[0]["Anlagekapital"] + $summe;
        
        $query = "
        UPDATE Rundendaten
        SET Anlagekapital = $anlagekapital
        WHERE UnternehmensID = $uid AND SpielID = $sid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);
    }
	
	
	public static function checkKontostand($summe){
		
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
			
        $immobilie = Request::getImmobilieByID($immobilienId);

        if(API::addAusgabe($immobilie[0]["Kaufpreis"], "Immobilienkauf: " . $immobilie[0]["Beschreibung"], "Straße")) {
            
            $bestand = Request::getBestand();

            if ($bestand == "") {
                $bestandString = $immobilienId;
            }
            else {
                $bestandString = $bestand . ';' . $immobilienId;
            }

            Request::setBestand($bestandString);

            API::addEinnahme($immobilie[0]["Miete"], "Mieteinnahmen: " . $immobilie[0]["Beschreibung"], "Straße");

        }
        else {

            Helper::showMessage("Kontostand zu gering", "Das Unternehmen hat die Bonitätsprüfung leider nicht bestanden", "error");

        }
        
    }

    public static function createCreditRequest($id, $bank, $typ, $summe, $zins, $laufzeit, $chance) {
        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h5><?php echo $bank; ?></h5>
                <p><?php echo $typ; ?></p>
                <p>Kreditsumme: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Zins: <?php echo number_format($zins, 2, ',', '.'); ?> % p.a.</p>
                <p>Laufzeit: <?php echo $laufzeit; ?> Jahre</p>
                <p>Wahrscheinlichkeit: <?php echo $chance; ?> %</p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?credit="' . $id .'"'; ?> class="btn btn-primary">Kredit beantragen</a>
            </div>
        </div>
        <?php
    }


    public static function createAnlageRequest($id, $name, $beschreibung, $summe, $ertrag, $laufzeit, $risiko) {
        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h5><?php echo $name; ?></h5>
                <p><?php echo $beschreibung; ?></p>
                <p>Anlagesumme: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>möglicher Ertrag: <?php echo number_format($ertrag, 2, ',', '.'); ?> % p.a.</p>
                <p>Laufzeit: <?php echo $laufzeit; if($laufzeit == 1) { echo " Jahr"; } else { echo " Jahre"; }?></p>
                <p>Risiko: <?php echo $risiko; ?></p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?anlage="' . $id .'"'; ?> class="btn btn-primary">Geld anlegen</a>
            </div>
        </div>
        <?php
    }

    
    //Das müssen wir bei jeder buy function eigentlich mit in die BuchungsAufgaben mit reintragen?!
    public static function createBuchungsAufgabe($sollkonto,$habenkonto,$summe, $beschreibung){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
        $query = "
        INSERT INTO Buchungsaufgaben (SpielID, UnternehmensID, Runde, Sollkonto, Habenkonto, Summe, Beschreibung)
        VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $sollkonto . "', '" . $habenkonto . "', '" . $summe . "', '" . $beschreibung ."')
        ;";
        Database::sqlInsert($query);
        
        
    }
    
    
    public static function checkBuchungsAntrag($sollkonto,$habenkonto,$summe){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
                
        $query = "
        SELECT SUM(Summe) FROM Buchungsaufgaben WHERE UnternehmensID='" . $uid . 
            "' AND SpielID='" . $sid . "' AND Runde='" . $runde . "' AND Sollkonto='" . $sollkonto . "' AND Habenkonto='" . $habenkonto . "';";
        $zuZahlen = Database::sqlSelect($query);      
             
        if($summe == $zuZahlen){
            $query = "
            INSERT INTO Buchungsaufgaben (Bezahlt)
            VALUES (TRUE)
            ;";
                        
            
            Helper::showMessage("Erfolgreiche Buchung", "Diese Buchung war erfolgreich!", "success");

        }else{
            Helper::showMessage("Buchungsfehler", "Leider falsche Buchung!", "error");
        }
        
    }


}
?>