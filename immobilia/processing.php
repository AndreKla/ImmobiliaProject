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

        <div></div>
        <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
          <div class="x_panel tile">
            <div class="x_title">
              <h2>Geschäftsjahr abgeschlossen</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">
                <ul class="quick-list">
                  <?php

                    $players = Request::getAllPlayers();

                    for($i = 0; $i < sizeof($players); $i++) {

                      $rundendaten = Request::getRundendatenById($players[$i]["ID"]);

                  ?>
                  <li>
                  <?php
                  if($rundendaten[0]["Abgeschlossen"] == 0) {
                    echo "<span class='green'><i class='fa fa-clock-o'></i></span>";
                  }
                  else {
                    echo "<i class='fa fa-check' style='color: #1ABB9C'></i>";
                  }
                  ?>
                  
                  <a href="#"><?php echo $players[$i]["Unternehmensname"]; ?></a>
                  </li>
                  <?php
                    }
                  ?>
                </ul>

                <div class="sidebar-widget">
                  <h4>Bitte warten</h4>
                  <div class="goal-wrapper">
                    <i class="fa fa-clock-o" style="font-size:50pt;padding:20px"></i>
                    <br><br>
                    <form>
                      <div class="col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                          <span class="input-group-btn">
                              <button id="refresh" class="btn btn-dark" type="button" style="color: white">Aktualisieren</button>
                          </span>
                        </div><br>
                        <small>Bitte warten Sie bis alle Spielteilnehmer das aktuelle Geschäftsjahr beendet haben.</small>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>


      
      <div class="text-center text-center">      
        
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
        
