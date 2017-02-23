<?php

class Karte {


public static function createMarkers() {
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Objekt
    ;";
    $objekte = Database::sqlSelect($query);

?>	
		  
          <!--<script src="http://www.google.com/jsapi"></script>-->
          <script type="text/javascript">
            var script = '<script type="text/javascript" src="http://tigo.registersim.com/assets/js/src/markerclusterer';
            if (document.location.search.indexOf('packed') !== -1) {
              script += '_packed';
            }
            if (document.location.search.indexOf('compiled') !== -1) {
              script += '_compiled';
            }
            script += '.js"><' + '/script>';
            document.write(script);
          </script>
          <script type="text/javascript">
            google.load('maps', '3', {
              other_params: 'sensor=false'
            });
            google.setOnLoadCallback(initialize);

            function initialize() {
              var data = {
                "count": 5,
                "photos": [
				<?php
				  for($i = 0; $i < sizeof($objekte); $i++) {
							
				?>
				 {"longitude": "<?php echo $objekte[$i]["Long"]?>" ,
                  "latitude": "<?php echo $objekte[$i]["Lat"] ?>" ,
                  "created_by": "<?php echo $objekte[$i]["Kaufpreis"]." €"?>",
                  "created_date": "<?php echo $objekte[$i]["Flaeche"]." € "?>",
                  "msisdn": "<?php echo $objekte[$i]["Bild"]?>",
                  "registrant": "<?php echo $objekte[$i]["Beschreibung"] ?>"
                }, <?php  
				}
				?>
              ]};

              var center = new google.maps.LatLng(52.51929194655397, 13.405414583394304); //-7.0849437,35.8401773);
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                scrollwheel: false,
                maxZoom: 30,
                minZoom: 12,
                center: center,
				streetViewControl: false,
				draggable: true, 
				zoomControl: true, 
				scrollwheel: true, 
				disableDoubleClickZoom: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{
                  "featureType": "landscape",
                  "elementType": "labels",
                  "stylers": [{
                    "visibility": "off"
                  }]
                }, {
                  "featureType": "transit",
                  "elementType": "labels",
                  "stylers": [{
                    "visibility": "off"
                  }]
                }, {
                  "featureType": "poi",
                  "elementType": "labels",
                  "stylers": [{
                    "visibility": "off"
                  }]
                }, {
                  "featureType": "water",
                  "elementType": "labels",
                  "stylers": [{
                    "visibility": "off"
                  }]
                }, {
                  "featureType": "road",
                  "elementType": "labels.icon",
                  "stylers": [{
                    "visibility": "off"
                  }]
                }, {
                  "stylers": [{
                    "hue": "#00aaff"
                  }, {
                    "saturation": -100
                  }, {
                    "gamma": 2.15
                  }, {
                    "lightness": 12
                  }]
                }, {
                  "featureType": "road",
                  "elementType": "labels.text.fill",
                  "stylers": [{
                    "visibility": "on"
                  }, {
                    "lightness": 24
                  }]
                }, {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [{
                    "lightness": 57
                  }]
                }]
              });
              var infoWindow = new google.maps.InfoWindow();
              var markers = [];
              var html_array = [];
              for (var i = 0, dataPhoto; dataPhoto = data.photos[i]; i++) {
                //console.log(dataPhoto.latitude + " :" + dataPhoto.registrant );
                var latLng = new google.maps.LatLng(dataPhoto.latitude, dataPhoto.longitude);
                var marker = new google.maps.Marker({
                  position: latLng
                });
                var html = "<div class='infowin'><strong>" + dataPhoto.registrant + "</strong><br>";
                html = html + "<img src='"+ dataPhoto.msisdn + "' width='200px' height='auto'><br>";
                html = html + "<strong>Fläche in m²: </strong>" + dataPhoto.created_date + "";
                html = html + "<p><strong>Verkehrswert:</strong>" + dataPhoto.created_by + "</p>";
                html_array.push(html);
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                    infoWindow.setContent(html_array[i]);
                    infoWindow.open(map, this);
                  }
                })(marker, i));
                //google.maps.event.addListener(marker, 'mouseout', function() {
                // infoWindow.close();
                //});
                markers.push(marker);
              }
              var markerCluster = new MarkerClusterer(map, markers);
            }
          </script>
          <div id="map-container" style="height:700px">
            <div id="map"></div>
          </div>


          <script>
            $(function() {
              $('#report_blocks').masonry({
                // options
                itemSelector: '.single_block',
              });
            });
          </script>

          <script>
            $(document).ready(function() {
              $(".iframe").colorbox({
                iframe: true,
                width: "85%",
                height: "96%"
              });

              //Example of preserving a JavaScript event for inline calls.
              $("#click").click(function() {
                $('#click').css({
                  "background-color": "#f00",
                  "color": "#fff",
                  "cursor": "inherit"
                }).text("Open this window again and this message will still be here.");
                return false;
              });
            });
          </script>
		  
		 <!-- API KEY = AIzaSyCT1xkT-JLARFGSKrP_vU7ScHVp6N0NJKs async defer -->
	   <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCT1xkT-JLARFGSKrP_vU7ScHVp6N0NJKs&signed_in=true&callback=initialize"></script>
		  
<?php
}

public static function createAccordionMap(){
	
	$anzahlGewählteZiele = 0;

  $objekte = Request::getImmobilien();

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

        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false" style="overflow: auto;height:575px;background:white;">
        
          <?php

          for($i = 0; $i < sizeof($objekte); $i++) {

          ?>

            <div class="panel">

              <a class="panel-heading" role="tab" id="<?php echo "heading".$i;?>" data-toggle="collapse" data-parent="#accordion" href="<?php echo "#acc".$i;?>" aria-expanded="false" aria-controls="<?php echo "acc".$i;?>"><h4 class="panel-title"><?php echo $objekte[$i]["Beschreibung"];?></h4></a>

              <div id=<?php echo '"' . 'acc' . $i . '"';?> class="panel-collapse collapse in" role="tabpanel" aria-labelledby=<?php echo '"' . 'heading' . $i . '"';?>>

                <div class="panel-body">

                  <img src=<?php echo '"' . $objekte[$i]["Bild"] . '"'; ?> width="250px" height="auto">

                  <p>
                  <strong>Verkehrswert: </strong><?php echo number_format($objekte[$i]["Wert"], 2, ',', '.') . " €"; ?>
                  </p>

                  <p>
                  <strong>Verkehrswertentwicklung: </strong><?php echo number_format($objekte[$i]["Wertentwicklung"], 2, ',', '.') . " €"; ?>
                  </p>

                  <p>
                  <strong>Mietpreis: </strong><?php echo number_format($objekte[$i]["Miete"], 2, ',', '.') . " €"; ?>
                  </p>

                  <p>
                  <strong>Mietpreisentwicklung: </strong><?php echo number_format($objekte[$i]["Mietentwicklung"], 2, ',', '.') . " €"; ?>
                  </p>

                  <p>
                  <strong>Abschreibung: </strong><?php echo number_format($objekte[$i]["Abschreibung"], 2, ',', '.') . " €"; ?>
                  </p>

                  <?php
                    $immoid = $i + 1;
                  ?>
                  <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?immokauf=$immoid";?> class="btn btn-success">KAUFEN</a>

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

		  
  