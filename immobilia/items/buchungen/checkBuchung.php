<?php
    
require_once("../../includes.php"); 

if( $_REQUEST["sollkonto"] ){
    
    Menu::includeHead();

   $sollkonto = $_REQUEST['sollkonto'];
   $habenkonto = $_REQUEST['habenkonto'];
   $summe = $_REQUEST['summe'];

   //echo "Welcome ". $sollkonto . " " . $habenkonto . " " . $summe;
   
    API::checkBuchungsAntrag($sollkonto,$habenkonto,$summe);

}
?> 