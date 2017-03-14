<?php 

class Auktion {
	
	
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

    $auktionsobjekte = Request::getAuktionsobjekte();
    if(sizeof($auktionsobjekte) > 0) {
      for($i = 0; $i < sizeof($auktionsobjekte); $i++) {

        Auktion::createAuktionsobjekt($auktionsobjekte[$i]["Beschreibung"]);

      }
    }
    else {
      echo "<div class='col-md-12'>";
      echo "<br><br>";
      echo "<span class='label label-warning col-md-10 col-md-offset-1' style='font-size:15px; padding:10px'>Bitte komm später wieder. In diesem Geschäftsjahr gibt es noch keine Auktionen!</span>";
      echo "<br><br><br>";
      echo "</div>";
    }
    ?>  
    </div>
  </div>
  <br><br>
	<?php
  }

  public static function createAuktionsobjekt($beschreibung) {
    ?>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="x_panel">
          <div class="x_title">
            <h2>Auktionsobjekt</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="product-image">
                <img src="images/prod-1.jpg" width="150px" height="auto"/>
              </div>
              <h3 class="prod_title"><?php echo $immoOffen[0]["Beschreibung"]?></h3>
              <p><?php echo $immoOffen[0]["Beschreibung"]?></p>
              <br>
              <p><strong> Fläche: </strong>  <?php echo $immoOffen[0]["Flaeche"]?> <br>
              <strong>Standortkategorie: <?php echo $immoOffen[0]["Beschreibung"]?></strong><br>
              <strong>Miete: <?php echo $immoOffen[0]["Miete"]?></strong><br>
              <strong>Verkehrswert: <?php echo $immoOffen[0]["Kaufpreis"]?></strong><br>
              <strong>Verkehrswertentwicklung: <?php echo $immoOffen[0]["Beschreibung"]?> </strong><br>
              <strong>Mietkostenentwicklung: <?php echo $immoOffen[0]["Beschreibung"]?> </strong></p><br>
              <div class="">
                <h2>Bieter Spanne</h2>
                <div class="row grid_slider">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="range_25" value="" name="range" />
                  </div>  

                  <script>
                    $(document).ready(function() {
                    $("#range_25").ionRangeSlider({
                      type: "single",
                      min: 180000,
                      max: 1000000,
                      grid: true
                    });});
                  </script>             
                            
                </div>
              </div>
              <div class="">
                <div class="product_price">
                  <h1 class="price"><?php echo $immoOffen[0]["Wert"]?> €</h1>
                  <span class="price-tax"><?php echo $immoOffen[0]["Wert"]?></span>
                  <br>
                </div>
              </div>
              <div class="">
                <button type="button" class="btn btn-default btn-lg">Bieten</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
  }


}
?>