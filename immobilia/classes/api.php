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
            
            
            //Create Buchungeintrag in Datenbank
            
            $beschreibung = "Kauf von Immobilie " .$immobilie[0]["Beschreibung"];
            $summe = $immobilie[0]["Kaufpreis"];
            $sollkonto = "Immobilien";
            $habenkonto = "Bank";
            API::createBuchungsAufgabe($sollkonto,$habenkonto,$summe,$beschreibung);

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

    public static function removeMitarbeiter($id) {

        $aktuelleMitarbeiter = Request::getMitarbeiter();

        $mitarbeiterListe = explode(';', $aktuelleMitarbeiter[0]["Mitarbeiter"]);

        $mitarbeiterListeNew = array_diff($mitarbeiterListe, array($id));

        $mitarbeiterString = "";

        for($i = 0; $i < sizeof($mitarbeiterListeNew); $i++) {
            if($mitarbeiterListeNew[$i] != "") {
                if($mitarbeiterString == "") {
                    $mitarbeiterString = $mitarbeiterListeNew[$i];
                }
                else {
                    $mitarbeiterString = $mitarbeiterString . ";" . $mitarbeiterListeNew[$i];
                }
            }
        }
        if(sizeof($mitarbeiterListeNew) > 1) {
            $mitarbeiterString = $mitarbeiterString . ";" . $mitarbeiterListeNew[sizeof($mitarbeiterListeNew)];
        }
        else if(sizeof($mitarbeiterListeNew) == 1) {
            $mitarbeiterString = $mitarbeiterListeNew[0];
        }

        Request::setMitarbeiter($mitarbeiterString);

        ?>

            <script language="javascript">
                window.location.href = <?php echo "personal_bestand.php?successquit=$id;"; ?>
            </script>

        <?php

    }

    
    /*
     * Buchungsmethoden
     */
    
    public static function createBuchungsAufgabe($sollkonto,$habenkonto,$summe, $beschreibung){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
        $query = "SELECT * FROM Buchungsaufgaben WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde AND Sollkonto = $sollkonto AND Habenkonto = $habenkonto;";
        $buchungsaufgabe = Database::sqlSelect($query);
        
        if(sizeof($buchungsaufgabe) > 0) {
            $summe = $buchungsaufgabe[0]["Summe"];
            
            $query = "        
            UPDATE Buchungsaufgaben
            SET Summe = $summe
            WHERE UnternehmensID = $uid AND SpielID = $sid AND Runde = $runde AND Sollkonto = $sollkonto AND Habenkonto = $habenkonto
            ;";
            
            Database::sqlUpdate($query);
            
        }else{
            $query = "
            INSERT INTO Buchungsaufgaben (SpielID, UnternehmensID, Runde, Sollkonto, Habenkonto, Summe, Beschreibung)
            VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $sollkonto . "', '" . $habenkonto . "', '" . $summe . "', '" . $beschreibung ."')
            ;";
            
            Database::sqlInsert($query);
            
        }
                
      
        

    }
    
    
    public static function checkBuchungsAntrag($sollkonto,$habenkonto,$summe){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
         
        $query = "
        SELECT SUM(Summe) FROM Buchungsaufgaben WHERE UnternehmensID= $uid  
             AND Runde= $runde AND Sollkonto= $sollkonto AND Habenkonto= $habenkonto AND Bezahlt = '0';";
        $zuZahlen = Database::sqlSelect($query); 
        
        //var_dump($zuZahlen[0]['SUM(Summe)']);
        
        if($summe == $zuZahlen[0]['SUM(Summe)']){
            
            $query = "
            UPDATE Buchungsaufgaben
            SET Bezahlt = 1
            WHERE UnternehmensID = $uid AND SpielID = $sid AND Runde = $runde
            ;";
            Database::sqlUpdate($query);

                        
            Helper::showMessage("Erfolgreiche Buchung", "Diese Buchung war erfolgreich!", "success");

        }else{
            Helper::showMessage("Buchungsfehler", "Leider falsche Buchung!", "error");
        }
        
    }

    
    public static function showBuchungsAufgaben(){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
        $query = "SELECT * FROM Buchungsaufgaben WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde";
        
        $buchungsaufgabe = Database::sqlSelect($query);
        
        $buchungsaufgabe[0]["Sollkonto"];
        $buchungsaufgabe[0]["Habenkonto"];
        
        for ($x = 0; $x <= sizeof($buchungsaufgabe); $x++) {
            
            /* 645000 - Aufwendungen für Instandhaltung
             * F180000 - Bank
             * S22222 - Langfristige Bankverbindlichkeiten
             * S44444 - Zinsaufwendungen
             * S11111 - Personalaufwendungen
             * 683570 - Mieterträge
             * 622070 - Abschreibungen
             * 710500 - Zinserträge
             * 400000 - Verkaufserlöse
             * S66666 - Immobilien
             */

            // Alle möglichen Buchungskonten
            if($buchungsaufgabe[$x]["Sollkonto"] == "Personalaufwendungen" && $buchungsaufgabe[$x]["Habenkonto"] == "Bank"){
                
                //Personalaufwendungen X €  an Bank X €
                echo "<p> - Die Löhne und Gehälter werden überwiesen. Bitte berechnen Sie den Personalaufwand und buchen Sie diesen.</p>";
                
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Aufwendungen für Instandhaltung" && $buchungsaufgabe[$x]["Habenkonto"] == "Bank"){
                
                //Aufwendungen für Instandhaltung  X €  an Bank  X €
                echo "<p> - Ein Teil der Fassade eines deiner Gebäude muss saniert werden, die Kosten für die Instandsetzung, in Höhe von X € müssen überwiesen werden.</p> ";
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Langfristige Bankverbindlichkeiten" && $buchungsaufgabe[$x]["Habenkonto"] == "Bank" || $buchungsaufgabe[$x]["Sollkonto"] == "Zinsaufwendungen" && $buchungsaufgabe[$x]["Habenkonto"] == "Bank"){
                
                //Langfristige Bankverbindlichkeiten / Zinsaufwendungen X €  an Bank X €
                echo "<p> - Ausgleich einer Darlehensschuld durch Überweisung: X </p>";
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Bank" && $buchungsaufgabe[$x]["Habenkonto"] == "Mieterträge"){
                
                //Bank an Mieterträge
                echo "<p> - Mieter überweisen laut Bankauszug die fälligen Jahresmieten. Bitte berechnen Sie zunächst die Mieteinnahmen und buchen Sie diese.</p>";
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Abschreibungen" && $buchungsaufgabe[$x]["Habenkonto"] == "Immobilie"){
                
                //Abschreibungen X €  an Immobilie X €
                echo "<p> - Die Gebäude sind planmäßig abzuschreiben. Die Abschreibungswerte sind den Objekten zu entnehmen.</p>";
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Bank" && $buchungsaufgabe[$x]["Habenkonto"] == "Zinserträge"){
                
                //Bank    X €  an Zinserträge X €
                echo "<p> - Die Bank schreibt Zinserträge von X % auf unserem Bankkonto gut.</p>";
            }
            if($buchungsaufgabe[$x]["Sollkonto"] == "Bank" && $buchungsaufgabe[$x]["Habenkonto"] == "Verkaufserlöse"){
                
                //Bank  X € an Verkaufserlöse X €
                echo "<p> - Das Inserat für das Objekt XX war erfolgreich.  Das Objekt wird zum Jahresende für 665.000 € veräußert.</p>";
            }
            
        }         
        
    }
}
?>