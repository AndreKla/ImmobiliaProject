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

    public static function getImmobilieByID($id) {

        $query = "
        SELECT * FROM Objekt
        WHERE ID = $id
        ;";
        return Database::sqlSelect($query);

    }

    public static function getBestand() {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = "
        SELECT Bestand FROM Unternehmen
        WHERE ID = $uid
        ;";
        $bestand = Database::sqlSelect($query);

        return $bestand[0]["Bestand"];

    }

    public static function setBestand($bestand) {

        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];

        $query = " 
        UPDATE Unternehmen 
        SET Bestand = '" . $bestand . "'
        WHERE ID = $uid
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

}
?>