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

        if(API::addAusgabe($immobilie[0]["Kaufpreis"], $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"], "Immobilienkauf: " . $immobilie[0]["Beschreibung"])) {
            
            Request::setBestand($immobilienId);

            API::addEinnahme($immobilie[0]["Miete"], $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"], "Mieteinnahmen: " . $immobilie[0]["Beschreibung"]);

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

    public static function createSalesOffer($id, $name, $summe, $zeitpunkt, $bonität) {

        if($zeitpunkt == 0) {
            $zahlungsdatum = "sofort";
        }
        else if($zeitpunkt == 1) {
            $zahlungsdatum = "Jahresende";
        }
        else {
            $zahlungsdatum = "in 2 Jahren";
        }

        if($bonität == 0) {
            $sicherheit = "?";
        }
        else if ($bonität == 1) {
            $sicherheit = "schlecht";
        }
        else if ($bonität == 2) {
            $sicherheit = "mittel";
        }
        else {
            $sicherheit = "hoch";
        }

        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h4 style="text-align:center">ANGEBOT</h4><br>
                <h5><?php echo $name; ?></h5>
                <p><?php echo $beschreibung; ?></p>
                <p>Verkaufspreis: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Zahlungsdatum: <?php echo $zahlungsdatum;?></p>
                <p>Käuferbonität: <?php echo $sicherheit; ?></p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?verkauf=$id&preis=$summe&zeitpunkt=$zeitpunkt"; ?> class="btn btn-primary">Verkaufen</a>
            </div>
        </div>
        <?php
    }

    public static function createRentOffer($id, $name, $summe, $zeitpunkt, $sorgfalt, $bonität) {

        if($zeitpunkt == 0) {
            $zahlungsdatum = "sofort";
        }
        else if($zeitpunkt == 1) {
            $zahlungsdatum = "Jahresende";
        }
        else {
            $zahlungsdatum = "in 2 Jahren";
        }

        if($bonität == 0) {
            $sicherheit = "?";
        }
        else if ($bonität == 1) {
            $sicherheit = "schlecht";
        }
        else if ($bonität == 2) {
            $sicherheit = "mittel";
        }
        else {
            $sicherheit = "hoch";
        }

        if($sorgfalt == 0) {
            $sauberkeit = "?";
        }
        else if ($sorgfalt == 1) {
            $sauberkeit = "unordentlich";
        }
        else if ($sorgfalt == 2) {
            $sauberkeit = "ordentlich";
        }
        else {
            $sauberkeit = "sehr ordentlich";
        }

        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h4 style="text-align:center">MIETINTERESSENT</h4><br>
                <h5><?php echo $name; ?></h5>
                <p><?php echo $beschreibung; ?></p>
                <p>Miete (p.a.): <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Bezugsdatum: <?php echo $zahlungsdatum;?></p>
                <p>Mietereindruck: <?php echo $sauberkeit;?></p>
                <p>Mieterbonität: <?php echo $sicherheit; ?></p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?vermieten=$id&preis=$summe&zeitpunkt=$zeitpunkt"; ?> class="btn btn-primary">Vermieten</a>
            </div>
        </div>
        <?php
    }

    public static function createRenewOption($id, $name, $beschreibung, $summe, $wertsteigerung, $zustand) {

        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h4 style="text-align:center">SANIERUNGSOPTION</h4><br>
                <h5><?php echo $name; ?></h5>
                <p><?php echo $beschreibung; ?></p>
                <p>Kosten: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Wertsteigerung: <?php echo number_format($wertsteigerung, 2, ',', '.'); ?> €</p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?sanieren=$id&preis=$summe&wertsteigerung=$wertsteigerung&zustand=$zustand"; ?> class="btn btn-primary">Sanieren</a>
            </div>
        </div>
        <?php
    }

    public static function createBuildOption($id, $name, $summe, $wertsteigerung, $zustand, $dauer) {

        ?>
        <div class="modal-body col-md-4">
            <div class="x_panel">
                <h4 style="text-align:center">BAUOPTION</h4><br>
                <h5><?php echo $name; ?></h5>
                <p>Kosten: <?php echo number_format($summe, 2, ',', '.'); ?> €</p>
                <p>Objektwert (nach Fertigstellung): <?php echo number_format($wertsteigerung, 2, ',', '.'); ?> €</p>
                <p>Dauer bis Fertigstellung: <?php if($dauer > 1) { echo $dauer . " Jahre";} else { echo $dauer . " Jahr";} ?></p>
                <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?bauen=$id&preis=$summe&wertsteigerung=$wertsteigerung&zustand=$zustand&dauer=$dauer"; ?> class="btn btn-primary">Bauen</a>
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

    public static function sellImmobilie($id, $summe, $zeitpunkt) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $immobilie = Request::getImmobilieByID($id);

        $beschreibung = $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"];
        $details = "Immobilienverkauf: " . $immobilie[0]["Beschreibung"];

        if($zeitpunkt == 0) {
            API::addEinnahme($summe, $beschreibung, $details);
            Request::removeImmobilieFromBestand($id);
        }
        else {

            $auszahlung = $runde + $zeitpunkt;

            $query = "
            INSERT INTO Zukunftseinnahmen (SpielID, UnternehmensID, Runde, Auszahlung, Summe, Beschreibung, Details)
            VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $auszahlung . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
            ;";
            Database::sqlInsert($query);
            Request::removeImmobilieFromBestand($id);
        }

    }

    public static function rentImmobilie($id, $summe, $zeitpunkt) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $immobilie = Request::getImmobilieByID($id);

        $beschreibung = $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"];
        $details = "Mieteinnahmen: " . $immobilie[0]["Beschreibung"];

        if($zeitpunkt == 0) {
            API::addEinnahme($summe, $beschreibung, $details);
            Request::setImmobilieRented($id);
        }
        else {

            $auszahlung = $runde + $zeitpunkt;

            $query = "
            INSERT INTO Zukunftseinnahmen (SpielID, UnternehmensID, Runde, Auszahlung, Summe, Beschreibung, Details)
            VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $auszahlung . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
            ;";
            Database::sqlInsert($query);
            Request::setImmobilieRented($id);
        }

    }

    public static function renewImmobilie($id, $summe, $wertsteigerung, $zustand) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $immobilie = Request::getImmobilieByID($id);
        $bestandsimmobilie = Request::getBestandsimmobilieByID($id);

        $wert = $bestandsimmobilie[0]["Wert"] + $wertsteigerung;
        $neuerZustand = $bestandsimmobilie[0]["Zustand"] + $zustand;

        $beschreibung = $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"];
        $details = "Sanierung: " . $immobilie[0]["Beschreibung"];

        API::addAusgabe($summe, $beschreibung, $details);
        Request::setImmobilieNewValue($id, $wert);
        Request::setImmobilieNewState($id, $neuerZustand);

    }

    public static function buildImmobilie($id, $summe, $wertsteigerung, $zustand, $dauer) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $immobilie = Request::getImmobilieByID($id);
        $bestandsimmobilie = Request::getBestandsimmobilieByID($id);

        $wert = $bestandsimmobilie[0]["Wert"] + $wertsteigerung;
        $neuerZustand = $bestandsimmobilie[0]["Zustand"] + $zustand;

        $beschreibung = $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"];
        $details = "Immobilienbau: " . $immobilie[0]["Beschreibung"];

        API::addAusgabe($summe, $beschreibung, $details);
        Request::setImmobilieNewBuildDuration($id, $dauer);

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