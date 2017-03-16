<?php 

class Auktion {

  public static function checkForAuktion() {

    $auktion = Request::getAuktion();

    if(sizeof($auktion) > 0) {
      return true;
    }
    else {
      return false;
    }

  }

  public static function showNoAuktion() {
    ?>
    <div class="x_panel">
    <div class="x_title">
      <h2>Auktionen</h2>
        <!-- Hilfe Funktionalität / Text / Popup-->
        <?php include 'help/auktion_offeneauktion_help.php'; ?>
      <div class="clearfix"></div>
    </div>
    <div class="row">

      <div class='col-md-12'>
        <br><br>
        <span class='label label-warning col-md-10 col-md-offset-1' style='font-size:15px; padding:10px'>Bitte komm später wieder. In diesem Geschäftsjahr gibt es noch keine Auktionen!</span>
        <br><br><br>
      </div>
    
    </div>
  </div>
  <br><br>
  <?php
  }
	
	
public static function createAuktion() { 
  ?>
  <div class="x_panel">
    <div class="x_title">
      <h2>Auktionen</h2>
        <!-- Hilfe Funktionalität / Text / Popup-->
        <?php include 'help/auktion_offeneauktion_help.php'; ?>
      <div class="clearfix"></div>
    </div>
    <div class="row">
    <?php

    $auktion = Request::getAuktion();

    for($i = 0; $i < sizeof($auktion); $i++) {
      $auktionsobjekt = Request::getAuktionsobjektById($auktion[$i]["Objekt"]);

      Auktion::createAuktionsobjekt($auktionsobjekt[0], $auktion[$i]["Mindestgebot"]);

    }

    ?>  
    </div>
  </div>
  <br><br>
	<?php
  }

  public static function createAuktionsobjekt($auktionsobjekt, $mindestgebot) {

    ?>
    <br>
      <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
        <div class="x_panel">
          <div class="x_title">
            <h2>Zwangsversteigerung</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="product-image pull-right col-md-4 col-sm-4 col-xs-4">
                <img src=<?php echo "'" . $auktionsobjekt["Bild"] . "'"; ?>/>
              </div>
              <h4><?php echo $auktionsobjekt["Beschreibung"]?></h4>
              <p><?php echo $auktionsobjekt["Strasse"]; ?><br><?php echo $auktionsobjekt["PLZ"] . " " . $auktionsobjekt["Ort"]; ?></p>
              <br>
              <?php 

              if($auktionsobjekt["Lage"] > 6) {
                echo "<span class='label label-success' style='padding:5px; margin:5px;'>Lage</span>";
              }
              else if($auktionsobjekt["Lage"] > 3) {
                echo "<span class='label label-warning' style='padding:5px; margin:5px;'>Lage</span>";
              }
              else {
                echo "<span class='label label-danger' style='padding:5px; margin:5px;'>Lage</span>";
              }

              if($auktionsobjekt["Zustand"] > 6) {
                echo "<span class='label label-success' style='padding:5px; margin:5px;'>Zustand</span>";
              }
              else if($auktionsobjekt["Zustand"] > 3) {
                echo "<span class='label label-warning' style='padding:5px; margin:5px;'>Zustand</span>";
              }
              else {
                echo "<span class='label label-danger' style='padding:5px; margin:5px;'>Zustand</span>";
              }

              if($auktionsobjekt["Flaeche"] > 160) {
                echo "<span class='label label-success' style='padding:5px; margin:5px;'>Fläche</span>";
              }
              else if($auktionsobjekt["Flaeche"] > 110) {
                echo "<span class='label label-warning' style='padding:5px; margin:5px;'>Fläche</span>";
              }
              else {
                echo "<span class='label label-danger' style='padding:5px; margin:5px;'>Fläche</span>";
              }


              ?>
              <br><br><br>
              
            </div>
          </div>

          <?php

          $gebot = Request::getGebot();

          if(sizeof($gebot) > 0) {
            ?>

            <div class='col-md-12'>
              <br><br>
              <span class='label label-success col-md-10 col-md-offset-1' style='font-size:15px; padding:10px'>Du hast bereits ein Gebot von <?php echo number_format($gebot[0]["Gebot"],2,',','.'); ?> € abgegeben!</span>
              <br><br><br>
            </div>

            <?php
          }
          else {

          ?>

          <form action="auktion.php" method="POST">
            <div class="col-md-10 col-md-offset-1">
              <div class="row grid_slider">
                <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
                  <input type="text" id="range_25" value="" name="gebot" />
                </div>  

                <script>
                  $(document).ready(function() {
                  $("#range_25").ionRangeSlider({
                    type: "single",
                    min: <?php echo $mindestgebot; ?>,
                    max: <?php echo $auktionsobjekt["Wert"] * 1.35; ?>,
                    grid: true
                  });});
                </script>             
                          
              </div>
            </div>

            <div class="col-md-10 col-md-offset-1" style="margin-top:30px;">
              <input type="hidden" value=<?php echo $auktionsobjekt["ID"]; ?> name="objektID">
              <input type="submit" class="btn btn-default col-md-8 col-md-offset-2" value="Bindendes Gebot abgeben">
            </div>

          </form>
        </div>
        <br><br>
        <?php
        }
        ?>
      </div>
    <?php

  }


}
?>