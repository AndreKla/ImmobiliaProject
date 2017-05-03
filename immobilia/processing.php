<?php session_start(); ?>

<?php
    
  require_once("includes.php"); 
  Menu::includeHead();

  if(!Processing::checkIfRoundFinished()) {

    /*

      Schmändel mach den Screen hier mal bitte noch schön morgen vormittag für nern

      In diesem if muss nichts passieren, einfach nur anzeigen das man warten muss bis alle fertig sind und dann einmal die Seite neu laden soll.

    */
        ?>


      
      <div class="text-center text-center">

              <div class="mid_center">
                <!--<h3>Auf andere Spieler warten!</h3>-->
                <div class="mid_center animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-check-square-o"></i></div>
                      <div class="count">Warten</div>
                      <p>Warten, auf die restlichen Spieler.</p>
                    </div>
                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <span class="input-group-btn">
                              <button id="refresh" class="btn btn-default" type="button">Aktualisieren</button>
                          </span>
                    </div>
                  </div>
                </form>
            </div>

            </div>
    </div>
    <script>
        $('#refresh').click(function() {
        location.reload();
    });
    </script>
           
   <?php 
   

  }
  else {
    Processing::createRundendaten();
    Processing::checkWhoWonAuction();
    Processing::gatherMieteinnahmen();
    Processing::payEmployees();
    Processing::payKredite();
    ?>
    <script language="javascript">
        window.location.href = "neuigkeiten.php"
    </script>
    <?php
  }

  







  /* INSERT SPINNING LOADING ANIMATION AND 5 SECOND WAIT TIME BEFORE CALLING: */

  
    

  Menu::createFooter();

?>
        
