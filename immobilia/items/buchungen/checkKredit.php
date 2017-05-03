<?php
    
require_once("../../includes.php"); 

if( $_REQUEST["summe"] ){
    
    Menu::includeHead();

   $summe = $_REQUEST['summe'];

    API::checkCreditZulassung($summe);

}
?> 