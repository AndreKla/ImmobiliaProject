<?php

class Request {

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

    public static function getImmobilie($id) {

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

}
?>