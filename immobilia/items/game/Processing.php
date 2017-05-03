<?php

class Processing {


  public static function payEmployees() {

    $aktuelleMitarbeiter = Request::getMitarbeiter();

    if($aktuelleMitarbeiter[0]["Mitarbeiter"] == "") {
      $count = 0;
    }
    else {
      $mitarbeiterListe = explode(';', $aktuelleMitarbeiter[0]["Mitarbeiter"]);
      $count = sizeof($mitarbeiterListe);
    }

    

    for($i = 0; $i < $count; $i++) {

      $mitarbeiter = Request::getMitarbeiterByID($mitarbeiterListe[$i]);

      if(!API::addAusgabe($mitarbeiter[0]["Gehalt"], "Jahresgehalt", $mitarbeiter[0]["Name"] . " - " . $mitarbeiter[0]["Fachrichtung"])) {
        echo "Lohn konnte nicht gezahlt werden! Du bist Pleite!";
      }

    }

  }
  
  public static function payKredite(){
      
      API::payKreditLaufendeKosten();
      
  }

  public static function gatherMieteinnahmen() {

    $runde = $_SESSION["Runde"];

    $bestand = Request::getBestand();

    for($i = 0; $i < sizeof($bestand); $i++) {

      $immobilie = Request::getImmobilieById($bestand[$i]["ObjektID"]);

      API::addEinnahme($immobilie[0]["Miete"] + $immobilie[0]["Mietentwicklung"] * ($runde - 1), $immobilie[0]["Strasse"] . ", " . $immobilie[0]["PLZ"] . " " . $immobilie[0]["Ort"], "Mieteinnahmen: " . $immobilie[0]["Beschreibung"]);
      
    }

  }

  public static function checkWhoWonAuction() {

    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];
    $runde = $_SESSION["Runde"];

    $auktion = Request::getAuktion();

    $objektID = $auktion[0]["Objekt"];

    $gebote = Request::getGebote();

    $bids = Array();

    for($i = 0; $i < sizeof($gebote); $i++) {
      array_push($bids, $gebote[$i]["Gebot"]);
    }

    $hoechstesGebot = max($bids);

    $uid = Request::getGebotdataByGebot($hoechstesGebot);

    $unternehmensID = $uid[0]["UnternehmensID"];

    $gewonnen = $uid[0]["Gewonnen"];

    if($gewonnen == 0) {
      Request::setBestandFromAuktion($unternehmensID, $objektID);
    }
    
  }

  public static function createRundendaten() {

    $rundendaten = Request::getRundendaten();

    $sid = $rundendaten[0]["SpielID"];
    $uid = $rundendaten[0]["UnternehmensID"];
    $runde = $rundendaten[0]["Runde"] + 1;
    $kapital = $rundendaten[0]["Kapital"];

    $query = "
    INSERT INTO Rundendaten (SpielID, UnternehmensID, Runde, Kapital, Strategie1, Strategie2, Strategie3, Social, Konkurrenz, Kredit, Anlage, Marktanalyse)
    VALUES ('" . $sid . "', '" . $uid . "', '" . $runde . "', '" . $kapital . "', 0, 0, 0, 0, 0, 0, 0, 0)
    ;";
    Database::sqlInsert($query);

    Processing::setRundeInSession($runde);
  
  }

  public static function setRundeInSession($runde) {

    $_SESSION["Runde"] = $runde;

  }

  public static function checkIfRoundFinished() {

    Request::setRundeAbgeschlossen();

    $allFinished = true;

    $spiel = Request::getSpiel();

    $rundendaten = Request::getAlleRundendaten();

    if($spiel[0]["AnzahlSpieler"] == sizeof($rundendaten)) {

      for($i = 0; $i < sizeof($rundendaten); $i++) {

        if(!$rundendaten[$i]["Abgeschlossen"] == 1) {
          $allFinished = false;
          return $allFinished;
        }

      }

      return $allFinished;

    }
    else {
      return false;
    }

  }

}

?>