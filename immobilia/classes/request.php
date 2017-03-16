<?php

class Request {

    public static function getRundendaten() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];

        $query = "
        SELECT *
        FROM Rundendaten
        WHERE UnternehmensID = $uid AND SpielID = $sid
        ORDER BY Runde DESC
        ;";
        return Database::sqlSelect($query);

    }

    public static function getAlleRundendaten() {

        $sid = $_SESSION["SID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Rundendaten
        WHERE Runde = $runde AND SpielID = $sid
        ;";
        return Database::sqlSelect($query);

    }

    public static function getAusgaben() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT * 
        FROM Ausgaben
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        return Database::sqlSelect($query);

    }

    public static function getEinnahmen() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT * 
        FROM Einnahmen
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        return Database::sqlSelect($query);

    }

    public static function getKapitalbewegung() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT SpielID, UnternehmensID, Runde, Zeit, Summe, Beschreibung, Details, Typ FROM Einnahmen
        WHERE SpielID = $sid AND UnternehmensID = $uid
        union all
        SELECT SpielID, UnternehmensID, Runde, Zeit, Summe, Beschreibung, Details, Typ FROM Ausgaben
        WHERE SpielID = $sid AND UnternehmensID = $uid
        ORDER BY(`Zeit`) DESC
        ;";
        return Database::sqlSelect($query);

    }

    public static function getKontostand() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Kapital
        FROM Rundendaten
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        $kapital = Database::sqlSelect($query);

        return $kapital[0]["Kapital"];

    }

    public static function setKontostand($kontostand) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Rundendaten
        SET Kapital = $kontostand
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

    }

    public static function setKontostandStart($kontostand, $runde) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];

        $query = "
        UPDATE Rundendaten
        SET Kapital = $kontostand
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

    }

    public static function getUnternehmen() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function getImmobilieByID($id) {

        $query = "
        SELECT * FROM Objekt
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getStartImmobilieByID($id) {

        $query = "
        SELECT * FROM Startobjekt
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getBestandsimmobilieByID($id) {

        $query = "
        SELECT * FROM Unternehmensbestand
        WHERE ObjektID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getBestand() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT * FROM Unternehmensbestand
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Verkauft = 0
        ;";
        return Database::sqlSelect($query);

    }

    public static function setBestand($immobilienId) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $immobilienListe = Request::getImmobilieByID($immobilienId);

        $immobilie = $immobilienListe[0];

        $zustand = $immobilie["Zustand"];
        if($immobilie["Baugrundstueck"] == 0) {
            $baugrundstueck = 0;
        }
        else {
            $baugrundstueck = 10;
        }
        $vermietet = $immobilie["Vermietet"];
        $wert = $immobilie["Wert"];

        $query = "
        INSERT INTO Unternehmensbestand (SpielID, UnternehmensID, ObjektID, Saniert, Zustand, Gekauft, Verkauft, Wert, Status, Vermietet, Bau)
        VALUES ('" . $sid . "', '" . $uid . "', '" . $immobilienId . "', 0, '" . $zustand . "', '" . $runde . "', 0, '" . $wert . "', 0, '" . $vermietet . "', '" . $baugrundstueck . "');";
        Database::sqlInsert($query);

    }

    public static function setBestandFromAuktion($uid, $immobilienId) {

        $sid = $_SESSION["SID"];
        $runde = $_SESSION["Runde"];

        $auktionsImmobilie = Request::getAuktionsobjektById($immobilienId);

        var_dump($immobilienId);

        $immobilie = $auktionsImmobilie[0];

        $zustand = $immobilie["Zustand"];
        if($immobilie["Baugrundstueck"] == 0) {
            $baugrundstueck = 0;
        }
        else {
            $baugrundstueck = 10;
        }
        $vermietet = $immobilie["Vermietet"];
        $wert = $immobilie["Wert"];

        $query = "
        UPDATE Gebote
        SET Gewonnen = 1
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

        $query = "
        INSERT INTO Unternehmensbestand (SpielID, UnternehmensID, ObjektID, Saniert, Zustand, Gekauft, Ersteigert, Verkauft, Wert, Status, Vermietet, Bau)
        VALUES ('" . $sid . "', '" . $uid . "', '" . $immobilienId . "', 0, '" . $zustand . "', 0, 1, 0, '" . $wert . "', 0, '" . $vermietet . "', '" . $baugrundstueck . "');";
        Database::sqlInsert($query);


    }

    public static function removeImmobilieFromBestand($immobilienId) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmensbestand
        SET Verkauft = $runde
        WHERE SpielID = $sid AND UnternehmensID = $uid AND ObjektID = $immobilienId
        ;";
        Database::sqlUpdate($query);

    }

    public static function setImmobilieRented($immobilienId) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmensbestand
        SET Vermietet = $runde
        WHERE SpielID = $sid AND UnternehmensID = $uid AND ObjektID = $immobilienId
        ;";
        Database::sqlUpdate($query);

    }

    public static function setImmobilieNewValue($immobilienId, $wert) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmensbestand
        SET Wert = $wert
        WHERE SpielID = $sid AND UnternehmensID = $uid AND ObjektID = $immobilienId
        ;";
        Database::sqlUpdate($query);

    }

    public static function setImmobilieNewState($immobilienId, $zustand) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmensbestand
        SET Zustand = $zustand
        WHERE SpielID = $sid AND UnternehmensID = $uid AND ObjektID = $immobilienId
        ;";
        Database::sqlUpdate($query);

    }

    public static function setImmobilieNewBuildDuration($immobilienId, $dauer) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmensbestand
        SET Bau = $dauer
        WHERE SpielID = $sid AND UnternehmensID = $uid AND ObjektID = $immobilienId
        ;";
        Database::sqlUpdate($query);

    }

    public static function getImmobilien() {

        $query = "
        SELECT *
        FROM Objekt
        ;";
        return Database::sqlSelect($query);

    }

    public static function getUnownedImmobilien() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Unternehmensbestand
        WHERE SpielID = $sid
        ;";
        $ownedImmobilien = Database::sqlSelect($query);

        if(sizeof($ownedImmobilien) > 0) {

            
            if(sizeof($ownedImmobilien) > 0) {
                $owned = "(";
                for($i = 0; $i < sizeof($ownedImmobilien); $i++) {
                    $owned = $owned . $ownedImmobilien[$i]["ObjektID"];
                    if($i != sizeof($ownedImmobilien) - 1) {
                        $owned = $owned . ",";
                    }
                    else {
                        $owned = $owned . ")";
                    }
                }
            }
            

            $query = "
            SELECT *
            FROM Objekt
            WHERE ID NOT IN $owned
            ;";
            return Database::sqlSelect($query);
        }
        else {

            $query = "
            SELECT *
            FROM Objekt
            ;";
            return Database::sqlSelect($query);

        }

    }

    public static function getKredite() {

        $query = "
        SELECT *
        FROM Kredit
        ;";
        return Database::sqlSelect($query);

    }

    public static function getKreditByID($id) {

        $query = "
        SELECT *
        FROM Kredit
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function setKreditForRound() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Rundendaten
        SET Kredit = 1
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

    }

    public static function getAnlageoptionen() {

        $query = "
        SELECT *
        FROM Anlageoptionen
        ;";
        return Database::sqlSelect($query);

    }

    public static function getAnlageoptionByID($id) {
        $query = "
        SELECT *
        FROM Anlageoptionen
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);
    }

    public static function setAnlageForRound() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Rundendaten
        SET Anlage = 1
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

    }

    public static function getMitarbeiter() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Mitarbeiter
        FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function getMitarbeiterByID($id) {

        $query = "
        SELECT *
        FROM Mitarbeiter
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }
    public static function getMitarbeiterOfPlayer($uid) {

        $sid = $_SESSION["SID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Mitarbeiter
        FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function getFreieMitarbeiter() {

        $query = "
        SELECT *
        FROM Mitarbeiter
        ;";
        return Database::sqlSelect($query);

    }

    public static function setMitarbeiter($array) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];

        $query = "
        UPDATE Unternehmen
        SET Mitarbeiter = '" . $array . "'
        WHERE ID = $uid AND SID = $sid
        ;";
        Database::sqlUpdate($query);

    }

    public static function getLageByViertel($viertelID) {

        $query = "
        SELECT Lage
        FROM Viertel
        WHERE ID = $viertelID
        ;";
        return Database::sqlSelect($query);

    }

    public static function getKaeuferdaten() {

        $query = "
        SELECT *
        FROM Kaeufer
        ;";
        return Database::sqlSelect($query);

    }

    public static function getMieterdaten() {

        $query = "
        SELECT *
        FROM Mieter
        ;";
        return Database::sqlSelect($query);

    }

    public static function getAuktionsobjektById($id) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT * FROM Auktionsobjekt
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getVerwaltung() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Verwalten FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function setVerwaltung($verwaltung) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmen
        SET Verwalten = $verwaltung
        WHERE SID = $sid AND ID = $uid
        ;";
        Database::sqlUpdate($query);

    }

    public static function getVerkaufen() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Verkaufen FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function setVerkaufen($verkaufen) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmen
        SET Verkaufen = $verkaufen
        WHERE SID = $sid AND ID = $uid
        ;";
        Database::sqlUpdate($query);

    }

    public static function getSanieren() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Sanieren FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function setSanieren($sanieren) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmen
        SET Sanieren = $sanieren
        WHERE SID = $sid AND ID = $uid
        ;";
        Database::sqlUpdate($query);

    }

    public static function getBauen() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Bauen FROM Unternehmen
        WHERE SID = $sid AND ID = $uid
        ;";
        return Database::sqlSelect($query);

    }

    public static function setBauen($bauen) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Unternehmen
        SET Bauen = $bauen
        WHERE SID = $sid AND ID = $uid
        ;";
        Database::sqlUpdate($query);

    }

    public static function getDownloadLink($kategorie) {

        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Downloads
        WHERE Kategorie = '" . $kategorie . "' AND Runde = $runde
        ;";
        return Database::sqlSelect($query);

    }

    public static function getKonkurrenzData() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT * 
        FROM Unternehmen
        WHERE SID = $sid
        ;";
        return Database::sqlSelect($query);

    }

    public static function getMarktvolumen() {

        $query = "
        SELECT SUM(Wert) as value
        FROM Objekt
        ;";
        $objektWerte = Database::sqlSelect($query);

        $query ="
        SELECT SUM(Wert) as value
        FROM Startobjekt
        ;";
        $startobjektWerte = Database::sqlSelect($query);

        return $objektWerte[0]["value"] + $startobjektWerte[0]["value"] * Request::getNumberOfPlayers();

    }

    public static function getNumberOfPlayers() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT ID
        FROM Unternehmen
        WHERE SID = $sid
        ;";
        $result = Database::sqlSelect($query);

        return sizeof($result);

    }

    public static function getBestandByPlayer($id) {

        $query = "
        SELECT *
        FROM Unternehmensbestand
        WHERE UnternehmensID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getNumberOfObjekte() {

        $query = "
        SELECT *
        FROM Objekt
        ;";
        $result = Database::sqlSelect($query);

        return sizeof($result);
    }

    public static function getRundendatenById($uid) {

        $sid = $_SESSION["SID"];

        $query = "
        SELECT *
        FROM Rundendaten
        WHERE UnternehmensID = $uid AND SpielID = $sid
        ORDER BY Runde DESC
        ;";
        return Database::sqlSelect($query);

    }

    public static function getStartbestand() {

        $query = "
        SELECT *
        FROM Startobjekt
        ;";
        return Database::sqlSelect($query);

    }

    public static function getAuktion() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Auktion
        WHERE Runde = $runde
        ;";
        return Database::sqlSelect($query);

    }

    public static function setGebot($gebot, $objektID) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        INSERT INTO Gebote (SpielID, UnternehmensID, ObjektID, Runde, Gebot)
        VALUES ('" . $sid . "', '" . $uid . "', '" . $objektID . "','" . $runde . "', '" . $gebot . "')
        ;";
        Database::sqlInsert($query);



    }

    public static function getGebot() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Gebote
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        return Database::sqlSelect($query);
    }

    public static function getGebote() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT *
        FROM Gebote
        WHERE SpielID = $sid AND Runde = 1
        ;";
        return Database::sqlSelect($query);

    }

    public static function getGebotdataByGebot($gebot) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT UnternehmensID, Gewonnen
        FROM Gebote
        WHERE SpielID = $sid AND Runde = 1 AND Gebot = $gebot
        ;";
        return Database::sqlSelect($query);

    }

    public static function getSpiel() {

        $sid = $_SESSION["SID"];

        $query = "
        SELECT *
        FROM Spiel
        WHERE ID = $sid
        ;";
        return Database::sqlSelect($query);


    }

    public static function setRundeAbgeschlossen() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        UPDATE Rundendaten
        SET Abgeschlossen = 1
        WHERE SpielID = $sid AND UnternehmensID = $uid AND Runde = $runde
        ;";
        Database::sqlUpdate($query);

    }

}
?>