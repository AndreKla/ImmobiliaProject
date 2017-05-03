<?php

class API {

    public static function getBestandsImmobilienValueById($immobilienId, $runde) {

        $immobilie = Request::getBestandsimmobilieByID($immobilienId);
        $wert = $immobilie[0]["Wert"];
        $zustand = $immobilie[0]["Zustand"];

        $viertel = Request::getViertelById($immobilie[0]["Viertel"]);

        if($runde != 1) {
            $gentrifizierung = $viertel[0]["Gentrifizierung" . $runde];
            $beliebtheit = $viertel[0]["Beliebtheit" . $runde];
            $infrastruktur = $viertel[0]["Infrastruktur" . $runde];
            $kriminalität = $viertel[0]["Kriminalität" . $runde];
            $lebensstandard = $viertel[0]["Lebensstandard" . $runde];
            $lage = $viertel[0]["Lage" . $runde];
        }
        else {
            $gentrifizierung = $viertel[0]["Gentrifizierung"];
            $beliebtheit = $viertel[0]["Beliebtheit"];
            $infrastruktur = $viertel[0]["Infrastruktur"];
            $kriminalität = $viertel[0]["Kriminalität"];
            $lebensstandard = $viertel[0]["Lebensstandard"];
            $lage = $viertel[0]["Lage"];
        }

        $makrolage = $gentrifizierung + $beliebtheit + $infrastruktur + $kriminalität + $lebensstandard + $lage;

        $faktor = $makrolage / 100 + 1;

        $realValue = $wert * $faktor;

        echo number_format($realValue, 2, ',', '.') . " €";

    }

    public static function getMarktImmobilienValueById($immobilienId) {

        $runde = $_SESSION["Runde"];

        $immobilie = Request::getImmobilieByID($immobilienId);
        $wert = $immobilie[0]["Wert"];
        $zustand = $immobilie[0]["Zustand"];

        $viertel = Request::getViertelById($immobilie[0]["Viertel"]);

        if($runde > 1) {
            $gentrifizierung = $viertel[0]["Gentrifizierung" . $runde];
            $beliebtheit = $viertel[0]["Beliebtheit" . $runde];
            $infrastruktur = $viertel[0]["Infrastruktur" . $runde];
            $kriminalität = $viertel[0]["Kriminalität" . $runde];
            $lebensstandard = $viertel[0]["Lebensstandard" . $runde];
            $lage = $viertel[0]["Lage" . $runde];
        }
        else {
            $gentrifizierung = $viertel[0]["Gentrifizierung"];
            $beliebtheit = $viertel[0]["Beliebtheit"];
            $infrastruktur = $viertel[0]["Infrastruktur"];
            $kriminalität = $viertel[0]["Kriminalität"];
            $lebensstandard = $viertel[0]["Lebensstandard"];
            $lage = $viertel[0]["Lage"];
        }
        
        
        $makrolage = $gentrifizierung + $beliebtheit + $infrastruktur + $kriminalität + $lebensstandard + $lage;

        $faktor = $makrolage / 100 + 1;

        $realValue = $wert * $faktor;

        return $realValue;

        //number_format($realValue, 2, ',', '.') . " €";


        //$immobilien[$i]["Wert"] + $objekt[0]["Wertentwicklung"] * $f


    }

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

    public static function addStartEinnahme($summe, $beschreibung, $details) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];

        $query = "
        INSERT INTO Einnahmen (SpielID, UnternehmensID, Runde, Summe, Beschreibung, Details)
        VALUES ('" . $sid . "', '" . $uid . "', 1, '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
        ;";
        Database::sqlInsert($query);

        $kapital = Request::getKontostand();

        $kontostand = $kapital + $summe;

        Request::setKontostandStart($kontostand, 1);

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
        if(API::canBuyImmobilie()) {

            if(API::addAusgabe(API::getMarktImmobilienValueById($immobilie[0]["ID"]), $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"], "Immobilienkauf: " . $immobilie[0]["Beschreibung"])) {
                
                Request::setBestand($immobilienId);

                if($immobilie[0]["Vermietet"] == 1) {
                    API::addEinnahme($immobilie[0]["Miete"], $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"], "Mieteinnahmen: " . $immobilie[0]["Beschreibung"]);
                }
                
                //Create Buchungeintrag in Datenbank
                
                $beschreibung = "Kauf von Immobilie " .$immobilie[0]["Beschreibung"];
                $summe = API::getMarktImmobilienValueById($immobilie[0]["ID"]);
                $sollkonto = "Immobilien";
                $habenkonto = "Bank";
                API::createBuchungsAufgabe($sollkonto,$habenkonto,$summe,$beschreibung);
                
            }
            else {

                Helper::showMessage("Kontostand zu gering", "Das Unternehmen hat die Bonitätsprüfung leider nicht bestanden", "error");

            }

        }
        else {
            Helper::showMessage("Nicht genügend Sachbearbeiterinnen", "Sie haben nicht genügend Sachbearbeiterinnen um weitere Immobilien zu kaufen.", "error");
        }
        
    }

    public static function canBuyImmobilie() {

        $bestand = Request::getBestand();
        $verwalten = Request::getVerwaltung();

        if(sizeof($bestand) + 1 > $verwalten[0]["Verwalten"]) {
            return false;
        }
        else {
            return true;
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

    public static function checkCreditZulassung($summes) {
            
            $sid = $_SESSION["SID"];
            $uid = $_SESSION["UID"];
            $runde = $_SESSION["Runde"];
            
            $summe = $summes;

            $rundendaten = Request::getRundendaten();

            //$fremdkapital = $rundendaten[0]["Fremdkapital"] + $summe;

            $query = "
            SELECT SUM(Wert)
            FROM Unternehmensbestand WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $immobilienwert = Database::sqlSelect($query);
            
            $query2 = "
            SELECT Kapital
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $kapital = Database::sqlSelect($query2);
            
            $query5 = "
            SELECT Kredit
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $kreditCheck = Database::sqlSelect($query5);
            
            $query3 = "
            SELECT Fremdkapital
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $fremdkapital = Database::sqlSelect($query3);
                        
                        
            $bemessunsgrundlage = $immobilienwert[0]["SUM(Wert)"] + ($kapital[0]["Kapital"] - $fremdkapital[0]["Fremdkapital"]);
            
            //echo "Immobilienwert " . $immobilienwert[0]["SUM(Wert)"] . " €" . " Kapital " . $kapital[0]["Kapital"] . "Fremdkapital " . $fremdkapital[0]["Fremdkapital"] . " === " . $bemessunsgrundlage;
            
             $bemessunsgrundlage =  ($bemessunsgrundlage/100)*30;
            
            if($summe >= $bemessunsgrundlage){
                Helper::showMessage("Kredit abgelehnt", "Der von dir gewünschte Kredit kann nicht gewehrt werden.", "error");
                
                return false;
               
            }else{
                
                if($kreditCheck == 0){
                
                    $bankname = "Planspiel AG 2";
                    $zins = 5;

                    Helper::showMessage("Kredit angenommen", "Der von dir gewünschte Kredit wurde gewehrt.", "success");

                    //echo " SUMME " . $summe;
                    $query = "
                    INSERT INTO Kredit (Bankname,Kredittyp, Kreditsumme, Kreditzins, Laufzeit)
                    VALUES ('" . $bankname . "' , 'Annuitätendarlehen', '" . $summe . "', '" . $zins . "', '5')
                    ;";
                    Database::sqlInsert($query);

                    $query2 = "
                    SELECT ID
                    FROM Kredit 
                    ORDER BY ID DESC
                    ;";
                    $id = Database::sqlSelect($query2);

                    $kreditID = $id[0]["ID"];

                    $query3 = "        
                    UPDATE Rundendaten
                    SET KreditID = $kreditID
                    WHERE UnternehmensID = $uid AND SpielID = $sid
                    ;";

                    Database::sqlUpdate($query3);

                    $query4 = "
                    SELECT *
                    FROM Kredit 
                    WHERE ID = $kreditID
                    ;";
                    $kredit = Database::sqlSelect($query4);

                    API::addEinnahme($kredit[0]["Kreditsumme"], $kredit[0]["Kredittyp"], $kredit[0]["Bankname"]);
                    API::addFremdkapital($kredit[0]["Kreditsumme"]);
                    Request::setKreditForRound();

                    return true;
                }
                else{
                    return false;
                }
                ?>
               
            <?php
            }
            
        ?>

        <?php
    }
    
    public static function creditKonditionenModal(){
        
            $sid = $_SESSION["SID"];
            $uid = $_SESSION["UID"];
            $runde = $_SESSION["Runde"];
            
            $query1 = "
            SELECT Kredit
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $kreditja = Database::sqlSelect($query1);
            $kidOne = $kreditja[0]["Kredit"];
            
            $query = "
            SELECT KreditID
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $kreditID = Database::sqlSelect($query);
            $kid = $kreditID[0]["KreditID"];
                        
            $query4 = "
            SELECT *
            FROM Kredit 
            WHERE ID = $kid
            ;";
            $kredit = Database::sqlSelect($query4);
            
            $zins = 5;
            $laufzeit = 5;
            $summe = $kredit[0]["Kreditsumme"];
            
            $drunter = (pow(1.05, 5)-1)/(pow(1.05, 5)*0.05);
           
            $zuZahlen = $summe/$drunter;
            //echo "drunter " . $drunter . " summe " . $summe;
            
            if($kidOne == 1){

            ?>
                <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="x_panel" style="height:auto">
                  <div class="x_title">
                    <h2>Kreditkonditionen <small>Konditionen</small></h2>
                    <div class="clearfix"></div>
                  </div>
                    <p> Kredithöhe : <?php echo $summe . " €";?></p>
                    <p> Zinshöhe : 5% </p>
                    <p> Laufzeit : 5 Jahre </p>
                    <p> Annuität : <?php echo $zuZahlen . " € pro Jahr" ?></p>
                </div>

        <?php
            }
    }
    
    
    public static function payKreditLaufendeKosten(){
        
            $sid = $_SESSION["SID"];
            $uid = $_SESSION["UID"];
            $runde = $_SESSION["Runde"];
            
            $query = "
            SELECT KreditID
            FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
            $kreditID = Database::sqlSelect($query);
            $kid = $kreditID[0]["KreditID"];
                        
            $query4 = "
            SELECT *
            FROM Kredit 
            WHERE ID = $kid
            ;";
            $kredit = Database::sqlSelect($query4);
            
            $zins = 5;
            $laufzeit = 5;
            $summe = $kredit[0]["Kreditsumme"];
            
            $drunter = (pow(1.05, 5)-1)/(pow(1.05, 5)*0.05);
           
            $zuZahlen = $summe/$drunter;
            //echo "drunter " . $drunter . " summe " . $summe;

            API::addAusgabe($zuZahlen, "Kredittilgung", "Kredittilgung");
            
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

        //if($zeitpunkt == 0) {
            API::addEinnahme($summe, $beschreibung, $details);
            Request::setImmobilieRented($id);
        /*}
        else {

            $auszahlung = $runde + $zeitpunkt;

            $query = "
            INSERT INTO Zukunftseinnahmen (SpielID, UnternehmensID, Runde, Auszahlung, Summe, Beschreibung, Details)
            VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $auszahlung . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
            ;";
            Database::sqlInsert($query);
            Request::setImmobilieRented($id);
        }*/

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

        Helper::showMessage("Immobilie Saniert", "Du hast deine Immobilie erfolgreich saniert!", "success");

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

    public static function addMitarbeiterBonus($fachgebiet, $motivation, $fähigkeit) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        if($fachgebiet == "Sachbearbeiterin") {

            $verwaltung = Request::getVerwaltung();

            if($motivation > 7 && $fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 4;
            }
            else if($motivation > 3 && $fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 3;
            }
            else if($fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 2;
            }
            else if($motivation > 7 && $fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 3;
            }
            else if($motivation > 3 && $fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 2;
            }
            else if($fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 1;
            }
            else if($motivation > 7) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 2;
            }
            else if($motivation > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] + 1;
            }
            else {
                $neueVerwaltung = $verwaltung[0]["Verwalten"];
            }

            Request::setVerwaltung($neueVerwaltung);

        }
        else if($fachgebiet == "Bauingenieur") {

            $sanieren = Request::getSanieren();

            $neuesSanieren = $sanieren[0]["Sanieren"] + 1;

            Request::setSanieren($neuesSanieren);


        }
        else if($fachgebiet == "Bauleiter") {

            $bauen = Request::getBauen();

            $neuesBauen = $bauen[0]["Bauen"] + 1;

            Request::setBauen($neuesBauen);

        }
        else if($fachgebiet == "Makler") {

            $verkaufen = Request::getVerkaufen();

            $neuesVerkaufen = $verkaufen[0]["Verkaufen"] + 1;

            Request::setVerkaufen($neuesVerkaufen);

        }

    }

    public static function removeMitarbeiterBonus($fachgebiet, $motivation, $fähigkeit) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        if($fachgebiet == "Sachbearbeiterin") {

            $verwaltung = Request::getVerwaltung();

            if($motivation > 7 && $fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 4;
            }
            else if($motivation > 3 && $fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 3;
            }
            else if($fähigkeit > 6) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 2;
            }
            else if($motivation > 7 && $fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 3;
            }
            else if($motivation > 3 && $fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 2;
            }
            else if($fähigkeit > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 1;
            }
            else if($motivation > 7) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 2;
            }
            else if($motivation > 3) {
                $neueVerwaltung = $verwaltung[0]["Verwalten"] - 1;
            }
            else {
                $neueVerwaltung = $verwaltung[0]["Verwalten"];
            }

            if(API::canFireEmployee($fachgebiet, $neueVerwaltung)) {
                Request::setVerwaltung($neueVerwaltung);
                return true;
            }
            else {
                Helper::showMessage("Sachbearbeiterin kann nicht entlassen werden", "Sie besitzen zu viele Immobilien", "error");
                return false;
            }

        }
        else if($fachgebiet == "Bauingenieur") {

            $sanieren = Request::getSanieren();

            $neuesSanieren = $sanieren[0]["Sanieren"] - 1;

            Request::setSanieren($neuesSanieren);
            return true;

        }
        else if($fachgebiet == "Bauleiter") {

            $bauen = Request::getBauen();

            $neuesBauen = $bauen[0]["Bauen"] - 1;

            Request::setBauen($neuesBauen);
            return true;

        }
        else if($fachgebiet == "Makler") {

            $verkaufen = Request::getVerkaufen();

            $neuesVerkaufen = $verkaufen[0]["Verkaufen"] - 1;

            Request::setVerkaufen($neuesVerkaufen);
            return true;

        }

    }

    public static function canFireEmployee($fachgebiet, $newValue) {

        if($fachgebiet == "Sachbearbeiterin") {
            $bestand = Request::getBestand();

            if(sizeof($bestand) > $newValue) {
                return false;
            }
            else {
                return true;
            }
        }
        else {

            //Bauleiter kann nicht gefeuert werden während sich die Immobilie im Bau befindet

            return true;
        }

    }

    public static function canBuild() {

        $build = Request::getBauen();

        if($build[0]["Bauen"] > 0) {
            return true;
        }
        else {
            return false;
        }

    }

    public static function canRenew() {

        $renew = Request::getSanieren();

        if($renew[0]["Sanieren"] > 0) {
            return true;
        }
        else {
            return false;
        }

    }

    public static function canSell() {

        $sell = Request::getVerkaufen();

        if($sell[0]["Verkaufen"] > 0) {
            return true;
        }
        else {
            return false;
        }

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
                        
        if(sizeof($buchungsaufgabe[0]["Summe"]) > 0) {
            $summe = $summe + $buchungsaufgabe[0]["Summe"];
            
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
        SELECT * FROM Buchungsaufgaben WHERE UnternehmensID= $uid  
             AND Runde= $runde AND Sollkonto= $sollkonto AND Habenkonto= $habenkonto AND Bezahlt = 0;";
        $zuZahlen = Database::sqlSelect($query); 
        
        var_dump($zuZahlen[0]['Summe']);
        
        if($summe == $zuZahlen[0]['Summe']){
            
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
    
    public static function checkBuchungenErledigt(){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
         
        $query = "
        SELECT Bezahlt FROM Buchungsaufgaben WHERE UnternehmensID= $uid AND Runde= $runde AND SpielID = $sid;";
        $bezahlt = Database::sqlSelect($query); 
        $count;
        
        for($i = 0; $i < sizeof($bezahlt);$i++){
            if($bezahlt[$i]['Bezahlt']=="0"){
                $count++;
            }
        }

        if($count != 0){
            return false;
        }else{
            return true;
        }
    }

}
?>