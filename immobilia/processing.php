<?php session_start(); ?>

<?php
    
  require_once("includes.php"); 
  Menu::includeHead();

  if(!Processing::checkIfRoundFinished()) {

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
        
