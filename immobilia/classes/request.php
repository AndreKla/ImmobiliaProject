<?php

class Request {

    public static function getRundendaten() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];

        $query = "
        SELECT *
        FROM Rundendaten
        WHERE UnternehmensID = $uid AND SpielID = $sid
        ORDER BY Runde ASC
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
        union all
        SELECT SpielID, UnternehmensID, Runde, Zeit, Summe, Beschreibung, Details, Typ FROM Ausgaben
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
        $baugrundstueck = $immobilie["Baugrundstueck"];
        $vermietet = $immobilie["Vermietet"];
        $wert = $immobilie["Wert"];

        $query = "
        INSERT INTO Unternehmensbestand (SpielID, UnternehmensID, ObjektID, Saniert, Zustand, Gekauft, Verkauft, Wert, Status, Vermietet, Bau)
        VALUES ('" . $sid . "', '" . $uid . "', '" . $immobilienId . "', 0, '" . $zustand . "', '" . $runde . "', 0, '" . $wert . "', 0, '" . $vermietet . "', '" . $baugrundstueck . "');";
        Database::sqlInsert($query);

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

}
?>