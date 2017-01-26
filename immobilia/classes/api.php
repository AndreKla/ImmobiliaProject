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

            $query = "
            SELECT Kapital
            FROM Rundendaten
            WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
            ;";
            $kapital = Database::sqlSelect($query);

            $kontostand = $kapital[0]["Kapital"] - $summe;

            $query = "
            UPDATE Rundendaten
            SET Kapital = $kontostand
            WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
            ;";
            Database::sqlUpdate($query);
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

		$kontostand = $kapital[0]["Kapital"] + $summe;

		$query = "
		UPDATE Rundendaten
		SET Kapital = $kontostand
		WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
		;";
		Database::sqlUpdate($query);

	}
	
	
	public function checkKontostand($summe){
		
		$sid = $_SESSION["SID"];
		$uid = $_SESSION["UID"];
		$runde = $_SESSION["Runde"];
                
        $query = "
		SELECT Kapital
		FROM Rundendaten
		WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
		;";
		$kapital = Database::sqlSelect($query);
                
        if ($kapital[0]["Kapital"] >= $summe) {
			return true;
		} else {
			return false;
		}
	}
	
	
	public static function buyImmobilie($immobilienId){
            
            $sid = $_SESSION["SID"];
            $uid = $_SESSION["UID"];
            $runde = $_SESSION["Runde"];
				
            $query = "
            SELECT * FROM Objekt
            WHERE ID = $immobilienId
            ;";
            $immobilie = Database::sqlSelect($query);


            $beschreibung = "Kauf Immobilie " . $immobilie[0]["Beschreibung"] ;
            $summe = $immobilie[0]["Kaufpreis"];
            $details = "Details";

           
            if(API::checkKontostand($summe)==true){
                
            API::addAusgabe($summe, $beschreibung, $details);

            $query = "
            SELECT Bestand FROM Unternehmen
            WHERE ID = $uid
            ;";
            $bestand = Database::sqlSelect($query);

            if ($bestand[0]["Bestand"] == "") {
                $bestandString = $immobilienId;
            }else{
                $bestandString = $bestand[0]["Bestand"] . ';' . $immobilienId;
            }


            $query2 = " 
            UPDATE Unternehmen 
            SET Bestand = '$bestandString'
            WHERE ID = $uid
            ;";

            Database::sqlUpdate($query2);
                		
            }else{
                Helper::showMessage("Kontostand zu gering", "Leider hast du nicht genügend Kapital", "error");    
            }
        
        }


}
?>