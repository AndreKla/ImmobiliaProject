<?php session_start(); ?>

<?php
    
  require_once("includes.php"); 
  Menu::includeHead();

  if(!Processing::checkIfRoundFinished()) {

    /*

      Schmändel mach den Screen hier mal bitte noch schön morgen vormittag für nern

      In diesem if muss nichts passieren, einfach nur anzeigen das man warten muss bis alle fertig sind und dann einmal die Seite neu laden soll.

    */

    echo "Waiting for other Players";

  }
  else {
    Processing::createRundendaten();
    Processing::checkWhoWonAuction();
    Processing::gatherMieteinnahmen();
    Processing::payEmployees();
    ?>
    <script language="javascript">
        window.location.href = "neuigkeiten.php"
    </script>
    <?php
  }

  







  /* INSERT SPINNING LOADING ANIMATION AND 5 SECOND WAIT TIME BEFORE CALLING: */

  
    

  Menu::createFooter();

?>
        
