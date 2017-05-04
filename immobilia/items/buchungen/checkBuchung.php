<?php
    
require_once("../../includes.php"); 

if( $_REQUEST["sollkonto"] ){
    
    Menu::includeHead();

   $sollkonto = $_REQUEST['sollkonto'];
   $habenkonto = $_REQUEST['habenkonto'];
   $summe = $_REQUEST['summe'];
   
   $mietertraege;
   $abschreibungen;
   $loehne;
   
   $mietertraege = Processing::gatherMieteinnahmen();

   //echo "Welcome ". $sollkonto . " " . $habenkonto . " " . $summe;
   
    if($sollkonto == "Bank" && $habenkonto == "Mieterträge" && $summe != 0 && $summe == $mietertraege){
                
        //Bank an Mieterträge
        //echo "<p> - Mieter überweisen laut Bankauszug die fälligen Jahresmieten. Bitte berechnen Sie zunächst die Mieteinnahmen und buchen Sie diese.</p>";
         Helper::showMessage("Erfolgreiche Buchung", "Diese Buchung war erfolgreich!", "success");
    }
    else{
        if($sollkonto  == "Abschreibungen" && $habenkonto == "Immobilie" && $summe != 0){

        //Abschreibungen X €  an Immobilie X €
        Helper::showMessage("Erfolgreiche Buchung", "Diese Buchung war erfolgreich!", "success");
        }else{
            if($sollkonto == "Personalaufwendungen" && $habenkonto == "Bank" && $summe != 0){

                //Personalaufwendungen X €  an Bank X €
                Helper::showMessage("Erfolgreiche Buchung", "Diese Buchung war erfolgreich!", "success");
            }
            else{
                Helper::showMessage("Buchungsfehler", "Leider falsche Buchung!", "error");
            }
            
        }
    }
    
          // Alle möglichen Buchungskonten
    
   
    //API::checkBuchungsAntrag($sollkonto,$habenkonto,$summe);

}
?> 