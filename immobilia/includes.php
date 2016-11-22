<?php
$classFolder = "classes/";
$itemsFolder = "items/";
$itemsBasicFolder = "items/basic/";



require_once $classFolder . "database.php";
require_once $classFolder . "globals.php";
require_once $classFolder . "helper.php";

#require_once $itemsBasicFolder . "widgets.php";


#require_once $itemsFolder . "auktion/auktion.php";
require_once $itemsFolder . "auktion/gridslider.php";

require_once $itemsFolder . "buchung/buchung_uebersicht.php";

require_once $itemsFolder . "konkurrenz/konkurrenz.php";

require_once $itemsFolder . "news/news.php";

require_once $itemsFolder . "personal/personal.php";

require_once $itemsFolder . "uebersicht/network_activities.php";
require_once $itemsFolder . "uebersicht/project_detail.php";
require_once $itemsFolder . "uebersicht/recent_activities.php";
require_once $itemsFolder . "uebersicht/todolist.php";
require_once $itemsFolder . "uebersicht/toplist_overview.php";
require_once $itemsFolder . "uebersicht/uebersicht_jahr.php";


?>