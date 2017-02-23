<?php 

class Auktion {
	
	
public static function createAuktion() { 

	$query = "
    SELECT *
    FROM Auktion
    ;";
    $aktuelleAuktion = Database::sqlSelect($query);
	
	$offen = $aktuelleAuktion[0]["Objekt"];
	$geschlossen = $aktuelleAuktion[1]["Objekt"];

	$query = "
    SELECT *
    FROM Objekt 
	WHERE ID = $offen
    ;";
    $immoOffen = Database::sqlSelect($query);
	
	$query = "
    SELECT *
    FROM Objekt 
	WHERE ID = $geschlossen
    ;";
    $immoGeschlossen = Database::sqlSelect($query);

?>

        <div class="" style="margin-bottom:250px;">
            <div class="page-title">
              <div class="title_left">
                <h3>Auktion</h3>
              </div>
            </div>

            <!-- Hey -->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Offene Auktion</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="product-image">
                        <img src="images/prod-1.jpg" width="150px" height="auto"/>
                      </div>

					  <h3 class="prod_title"><?php echo $immoOffen[0]["Beschreibung"]?></h3>

                      <p><?php echo $immoOffen[0]["Beschreibung"]?></p>
                      <br />
					  
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
								  type: "double",
								  min: 1000000,
								  max: 2000000,
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


			
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Verdeckte Auktion</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="product-image">
                        <img src="images/prod-1.jpg" width="250px" height="auto" alt="..." />
                      </div>
					  
					  <h3 class="prod_title"><?php echo $immoGeschlossen[0]["Beschreibung"]?></h3>

                      <p><?php echo $immoGeschlossen[0]["Beschreibung"]?></p>
                      <br />

						<p><strong> Fläche: </strong>  <?php echo $immoGeschlossen[0]["Flaeche"]?> <br>
					  <strong>Standortkategorie: <?php echo $immoGeschlossen[0]["Beschreibung"]?></strong><br>
					  <strong>Miete: <?php echo $immoGeschlossen[0]["Miete"]?></strong><br>
					  <strong>Verkehrswert: <?php echo $immoGeschlossen[0]["Kaufpreis"]?></strong><br>
					  <strong>Verkehrswertentwicklung: <?php echo $immoGeschlossen[0]["Beschreibung"]?> </strong><br>
					  <strong>Mietkostenentwicklung: <?php echo $immoGeschlossen[0]["Beschreibung"]?> </strong></p><br>
 
					  
                      <div class="">
                        <h2>Bieter Spanne</h2>
						<div class="row grid_slider">
						  <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="range_26" value="" name="range" />
						  </div>		

						<!-- Ion.RangeSlider -->

						<script>
							$(document).ready(function() {
							$("#range_26").ionRangeSlider({
							  type: "double",
							  min: 0,
							  max: 10000,
							  step: 500,
							  grid: true,
							  grid_snap: true
							});
						  });
						</script>						  
																  
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                      

                  </div>
                      </div>

                      <div class="">
                        <div class="product_price">
                          <h1 class="price"><?php echo $immoGeschlossen[0]["Wert"]?></h1>
                          <span class="price-tax"><?php echo $immoGeschlossen[0]["Wert"]?></span>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                        <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
          </div>
        </div>		
        <!-- /page content -->
		
		

	
<?php
  }
}
?>