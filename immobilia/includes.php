<?php
$itemsFolder ="items/";

require_once("menu.php");

require_once("classes/database.php");
require_once("classes/globals.php");
require_once("classes/api.php");
require_once("classes/request.php");
require_once("classes/helper.php");

require_once $itemsFolder . "game/Loop.php";
require_once $itemsFolder . "game/Abschluss.php";
require_once $itemsFolder . "game/Processing.php";

require_once $itemsFolder . "uebersicht/Neuigkeiten.php";
require_once $itemsFolder . "uebersicht/Finanzen.php";
require_once $itemsFolder . "uebersicht/Markt.php";
require_once $itemsFolder . "uebersicht/Konkurrenz.php";
require_once $itemsFolder . "uebersicht/Strategie.php";

require_once $itemsFolder . "immobilien/Karte.php";
require_once $itemsFolder . "immobilien/Liste.php";
require_once $itemsFolder . "immobilien/Bestand.php";
require_once $itemsFolder . "immobilien/Auktion.php";

require_once $itemsFolder . "buchungen/Bestandskonten.php";
require_once $itemsFolder . "buchungen/SBK.php"; 

require_once $itemsFolder . "personal/personal.php";

// TRASH needs to be sorted

require_once $itemsFolder . "auktion/gridslider.php";

require_once $itemsFolder . "buchungen/buchung_uebersicht.php";



require_once $itemsFolder . "uebersicht/network_activities.php";
require_once $itemsFolder . "uebersicht/project_detail.php";


require_once $itemsFolder . "uebersicht/uebersicht_jahr.php";

require_once $itemsFolder . "graphs/radar_graph.php";

require_once $itemsFolder . "finanzen/finanz_graph.php";



?>