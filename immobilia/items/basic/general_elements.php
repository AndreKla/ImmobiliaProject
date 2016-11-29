<?php

class Elements{


public static function createAccordion() {


?>

              <div class="clearfix"></div>


              <div class="col-md-6 col-sm-6 col-xs-12" style="z-index:20;position:absolute;top:10px;right:5px;width:350px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Immobilien <small>Verzeichniss</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
			  
			  
<?php
}

public static function createAccordionMap(){
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Objekt
    ;";
    $objekte = Database::sqlSelect($query);

?>

					<?php Elements::createAccordion();?>
					<!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false" style="overflow: auto;height:575px;background:white;">
                      
						<?php
						  for($i = 0; $i < sizeof($objekte); $i++) {
							
						
						?>
					  <div class="panel">
                        <a class="panel-heading" role="tab" id="<?php echo "heading".$i;?>" data-toggle="collapse" data-parent="#accordion" href="<?php echo "#acc".$i;?>" aria-expanded="false" aria-controls="<?php echo "acc".$i;?>">
                          <h4 class="panel-title"><?php echo $objekte[$i]["Beschreibung"];?></h4>
                        </a>
                        <div id="<?php echo "acc".$i;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?php echo "heading".$i;?>">
                          <div class="panel-body">
							<!--<p><strong>Collapsible Item 2 data</strong>-->
							<?php Radar::justRadar();?>
							<!--<img src="<?php echo $objekte[$i]["Bild"] ?>" width="250px" height="auto">-->
                            </p>
							<p><strong>Fläche: </strong><?php echo $objekte[$i]["Flaeche"] ?> m²</p>
							<p><strong>Wert: </strong><?php echo $objekte[$i]["Wert"] ?> €</p>
							<p><strong>Miete: </strong><?php echo $objekte[$i]["Miete"] ?> €</p>
							<p><strong>Kaufpreis: </strong><?php echo $objekte[$i]["Kaufpreis"] ?> €</p>
                          </div>
                        </div>
                      </div>
						<?php	
						}
						?>

						 
					  </div>
					</div>
				  </div>
			  
				</div>
			  



<?php
}

public static function createJumbotron() {
?>


            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Daily active users <small>Sessions</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <h1>Hello, world!</h1>
                      <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    </div>
                  </div>

                </div>
              </div>
            </div>

<?php
}}
?>