<?php

class API {

	public static function addAusgabe($summe, $beschreibung, $details) {

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

	public static function addEinnahme($summe, $beschreibung, $details) {

		$sid = $_SESSION["SID"];
		$uid = $_SESSION["UID"];
		$runde = $_SESSION["Runde"];

		$query = "
		INSERT INTO Einnahmen (SpielID, UnternehmensID, Runde, Summe, Beschreibung, Details)
		VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $summe . "', '" . $beschreibung . "', '" . $details . "')
		;";
		Database::sqlInsert($query);

	}

}
?>