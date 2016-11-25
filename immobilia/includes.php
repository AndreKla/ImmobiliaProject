<?php
$itemsFolder ="items/";

require_once("classes/database.php");
require_once("classes/globals.php");
require_once("menu.php");

#require_once $itemsBasicFolder . "widgets.php";
#$itemsBasicFolder = "/items/basic/";


require_once $itemsFolder . "auktion/gridslider.php";

require_once $itemsFolder . "buchung/buchung_uebersicht.php";

require_once $itemsFolder . "konkurrenz/konkurrenz.php";

require_once $itemsFolder . "news/news.php";

require_once $itemsFolder . "personal/personal.php";

require_once $itemsFolder . "uebersicht/network_activities.php";
require_once $itemsFolder . "uebersicht/project_detail.php";
require_once $itemsFolder . "uebersicht/recent_activities.php";
require_once $itemsFolder . "uebersicht/todolist.php";
require_once $itemsFolder . "uebersicht/Finanzen.php";
require_once $itemsFolder . "uebersicht/uebersicht_jahr.php";

require_once $itemsFolder . "basic/general_elements.php";
require_once $itemsFolder . "graphs/radar_graph.php";




?>