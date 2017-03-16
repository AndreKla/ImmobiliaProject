<?php

class Loop {

  public static function setStartbestand($sid, $uid, $runde) {

        $immobilienListe = Request::getStartbestand();

        for($i = 0; $i < sizeof($immobilienListe); $i++) {
          $immobilie = $immobilienListe[$i];

          $immobilienId = $immobilie["ID"];

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

          API::addStartEinnahme($immobilie["Miete"], $immobilie["Strasse"] . ", " . $immobilie["PLZ"] . " " . $immobilie["Ort"], "Mieteinnahmen: " . $immobilie["Beschreibung"]);

        }
        
  } 

  public static function setCompany($unternehmensname, $spielerArray, $passwort, $id) {

    $spielerString = "";

    for($i = 0; $i < sizeof($spielerArray); $i++) {
      $n = 1 + $i;
      $spielerString = $spielerString . "Spieler" . $n . " = '" . $spielerArray[$i] . "', ";
    }

      $query = "UPDATE Unternehmen
      SET Unternehmensname = '" . $unternehmensname . "', " . $spielerString . " Passwort = '" . md5($passwort) . "'
      WHERE ID = $id
      ;";
      Database::sqlUpdate($query);
  }

  public static function setRundendaten($sid, $id, $startkapital) {

    $query = "
    INSERT INTO Rundendaten (SpielID, UnternehmensID, Runde, Kapital, Strategie1, Strategie2, Strategie3, Social, Konkurrenz, Kredit, Anlage, Marktanalyse)
    VALUES ('" . $sid . "', '" . $id . "', 1, $startkapital, 0, 0, 0, 0, 0, 0, 0, 0)
    ;";
    Database::sqlInsert($query);

  }

}

?>