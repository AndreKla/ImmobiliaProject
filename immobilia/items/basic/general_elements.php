<?php

class Elements{


public static function createAccordion() {


?>

              <div class="clearfix"></div>


              <div class="col-md-6 col-sm-6 col-xs-12" style="z-index:20;position:absolute;top:10px;right:5px;width:350px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Immobilien <small>Verzeichniss</small></h2>
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
							<p><strong>Collapsible Item 2 data</strong>
							<img src="<?php echo $objekte[$i]["Bild"] ?>" width="250px" height="auto">
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, 
							non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
						<?php	
						}
						?>
					  <!-- 
					  
						ein Panel muss in eine forschleife und befüllt werden!!!
					  
					  
					  -->
						 
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
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
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