<?php
$itemsFolder = __DIR__."/../items/";

require_once(__DIR__."/database.php");
require_once(__DIR__."/globals.php");
require_once(__DIR__."/menu.php");

#require_once $itemsBasicFolder . "widgets.php";
#$itemsBasicFolder = "/items/basic/";


require_once $itemsFolder . "auktion/auktion.php";
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