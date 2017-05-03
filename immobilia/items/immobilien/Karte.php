<?php

class Karte {


  public static function createMarkers() {
  	
  	$anzahlGewählteZiele = 0;

      $objekte = Request::getUnownedImmobilien();

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
                    "created_by": "<?php echo $objekte[$i]["Kaufpreis"]. " €"?>",
                    "created_date": "<?php echo $objekte[$i]["Flaeche"]. " m² "?>",
                    "msisdn": "<?php echo $objekte[$i]["Bild"]?>",
                    "registrant": "<?php echo $objekte[$i]["Beschreibung"] ?>",
                    "id": "<?php echo "marker" . $i; ?>"
                  }, <?php  
  				}
  				?>
                ]};
				
                var center = new google.maps.LatLng(52.51929194655397, 13.405414583394304); //-7.0849437,35.8401773);
                var map = new google.maps.Map(document.getElementById('map'), {
                  scrollwheel: false,
                  maxZoom: 16,
                  minZoom: 11,
                  zoom: 12,
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
				
				var location = 'http://www.spire.de/kml/color/';

				var srcCharlottenburgBorder = location + 'border_charlottenburg.kml';
				var srcCharlottenburgFill = location + 'fill_charlottenburg.kml';
				
				var srcSpandauBorder = location + 'border_spandau.kml';
				var srcSpandauFill = location + 'fill_spandau.kml';

				var srcReinickendorfBorder = location + 'border_reinickendorf.kml';
				var srcReinickendorfFill = location + 'fill_reinickendorf.kml';

				var srcPankowBorder = location + 'border_pankow.kml';
				var srcPankowFill = location + 'fill_pankow.kml';

				var srcLichtenbergBorder = location + 'border_lichtenberg.kml';
				var srcLichtenbergFill = location + 'fill_lichtenberg.kml';
				
				var srcMarzahnBorder = location + 'border_marzahn.kml';
				var srcMarzahnFill = location + 'fill_marzahn.kml';

				var srcSteglitzBorder = location + 'border_steglitz.kml';
				var srcSteglitzFill = location + 'fill_steglitz.kml';
	
				var srcTreptowBorder = location + 'border_treptow.kml';
				var srcTreptowFill = location + 'fill_treptow.kml';

				var srcNeukoellnBorder = location + 'border_neukoelln.kml';	
				var srcNeukoellnFill = location + 'fill_neukoelln.kml';

				var srcTempelhofBorder = location + 'border_tempelhof.kml';
				var srcTempelhofFill = location + 'fill_tempelhof3.kml';

				var srcMitteBorder =  location + 'border_mitte.kml';
				var srcMitteFill = location + 'fill_mitte.kml';
				
				var srcKreuzbergBorder = location + 'border_kreuzberg.kml';
				var srcKreuzbergFill = location + 'fill_kreuzberg.kml';

					
				//loadKmlLayer(srcCharlottenburgBorder, map);
				loadKmlLayer(srcCharlottenburgFill, map);				
				
				//loadKmlLayer(srcSpandauBorder, map);
				loadKmlLayer(srcSpandauFill, map);
				
				//loadKmlLayer(srcReinickendorfBorder, map);
				loadKmlLayer(srcReinickendorfFill, map);
				
				//loadKmlLayer(srcPankowBorder, map);				
				loadKmlLayer(srcPankowFill, map);					
				
				//loadKmlLayer(srcMarzahnBorder, map);				
				loadKmlLayer(srcMarzahnFill, map);	
				
				//loadKmlLayer(srcSteglitzBorder, map);				
				loadKmlLayer(srcSteglitzFill, map);	
				
				//loadKmlLayer(srcLichtenbergBorder, map);				
				loadKmlLayer(srcLichtenbergFill, map);
								
				//loadKmlLayer(srcTreptowBorder, map);				
				loadKmlLayer(srcTreptowFill, map);
				
				//loadKmlLayer(srcNeukoellnBorder, map);
				loadKmlLayer(srcNeukoellnFill, map);

				//loadKmlLayer(srcTempelhofBorder, map);
				loadKmlLayer(srcTempelhofFill, map);

				loadKmlLayer(srcMitteBorder, map);
				//loadKmlLayer(srcMitteFill, map);

				//loadKmlLayer(srcKreuzbergBorder, map);
				loadKmlLayer(srcKreuzbergFill, map);

				
				function loadKmlLayer(src, map) {
				var kmlLayer = new google.maps.KmlLayer(src, {
				  suppressInfoWindows: true,
				  preserveViewport: false,
				  map: map
				});
				google.maps.event.addListener(kmlLayer, 'click', function(event) {
				  var content = event.featureData.infoWindowHtml;
				  var testimonial = document.getElementById('capture');
				  testimonial.innerHTML = content;
				});
			  }
				
                var infoWindow = new google.maps.InfoWindow();

                var markers = [];
                var html_array = [];
                for (var i = 0, dataPhoto; dataPhoto = data.photos[i]; i++) {
                  //console.log(dataPhoto.latitude + " :" + dataPhoto.registrant );
                  var latLng = new google.maps.LatLng(dataPhoto.latitude, dataPhoto.longitude);
                  var marker = new google.maps.Marker({
                    position: latLng
                  });
                  var html = "<form action='liste.php' type='post' style='overflow:hidden;'><div id='acc" + dataPhoto.id +"' style='width:250px;height:325px;overflow:hidden;'><strong style='font-weight:bold;font-size:12pt;margin-top:5px;'>" + dataPhoto.registrant + "</strong><br><br>";
                  html = html + "<img src='"+ dataPhoto.msisdn + "' width='250px' height='auto'><br><br>";
                  html = html + "<span class='label label-warning' style='margin:5px;'>Mikrolage</span>";
                  html = html + "<input name='id' value='acc" + dataPhoto.id + "' style='display:none'>";
                  html = html + "<span class='label label-danger' style='margin:5px;'>Ausstattung</span><br><br>";
                   html = html + "<button type='submit' name='details' class='btn btn-primary' style='float:right'>Details</button>";
                  html = html + "<strong>Fläche in m²: </strong>" + dataPhoto.created_date + "";
                  html = html + "<br><p><strong>Verkehrswert: </strong>" + dataPhoto.created_by + "</p></form>";
                  html_array.push(html);
                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infoWindow.setContent(html_array[i]);
                      infoWindow.open(map, this);
                      
                      //Es wird auf einen Marker geklickt
                       myFunction(i);

                      
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
                
            function myFunction(p1) {
                    
                /*
                for (i = 0; i <= 20; i++) {
                    $('#acc'+i).collapse('hide');
                }*/
                $('.panel-collapse.in').collapse('hide');
                
                $('#acc'+p1).collapse('show');
                                
                $('.panel-collapse').on('shown.bs.collapse', function (e) {
                    var $panel = $(this).closest('.panel');
                    //var $panel = '#acc'+p1;
                    $('#accordion').animate({
                        scrollTop: $panel.offset().top -100
                    }, 500); 
                }); 

/*
                $('#heading'+p1).click(function(){
                    $.scrollTo('#acc'+p1);                                                 
                });
                
                /*
                $("#accordion").on("shown.bs.collapse", function () {
                    //var myEl = $(this).find('.collapse.in');
                    /*
                    $('#accordion').animate({
                        scrollTop: $('#acc'+p1).offset().top
                    }, 500);
   

                });

                */

                
            }

            function eventFire(el, etype){
                if (el.fireEvent) {
                  el.fireEvent('on' + etype);
                } else {
                  var evObj = document.createEvent('Events');
                  evObj.initEvent(etype, true, false);
                  el.dispatchEvent(evObj);
                }
            }
            
              $(document).ready(function() {
                $(".iframe").colorbox({
                  iframe: true,
                  width: "85%",
                  height: "96%"
                });
                
                $('#heading0').click(function(){
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infoWindow.setContent(html_array[i]);
                          infoWindow.open(map, this);

                          //Es wird auf einen Marker geklickt
                           myFunction(i);


                        }
                      })(marker, i));                
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

    $objekte = Request::getUnownedImmobilien();

    ?>
    <div class="clearfix"></div>
      <div class="col-md-3 col-sm-3 col-xs-12" style="z-index:20;position:absolute;top:10px;right:5px;">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-align-left"></i> Immobilien <small>Verzeichnis</small></h2>
            <!--<ul class="nav navbar-right" style="cursor:pointer">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>-->
            <!-- Hilfe Funktionalität / Text / Popup-->
            <?php include 'help/karte_immobilien_help.php'; ?>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

          <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false" style="overflow: auto;height:575px;background:white;">
          
            <?php

            for($i = 0; $i < sizeof($objekte); $i++) {
                
              
            ?>

              <div class="panel">

                <a class="panel-heading" role="tab" id="<?php echo "heading".$i;?>" data-toggle="collapse" data-parent="#accordion" href="<?php echo "#acc".$i;?>" aria-expanded="false" aria-controls="<?php echo "acc".$i;?>"><h4 class="panel-title"><?php echo $objekte[$i]["Beschreibung"];?></h4></a>
                <!-- dafür es auf ist 'in' in class rein-->
                <div id=<?php echo '"' . 'acc' . $i . '"';?> class="panel-collapse collapse " role="tabpanel" aria-labelledby=<?php echo '"' . 'heading' . $i . '"';?>>

                  <div class="panel-body">
                    <img class="col-md-12" src=<?php echo '"' . $objekte[$i]["Bild"] . '"'; ?> width="250px" height="auto" style="margin-bottom:15px;">

                    
                    <div class="col-md-8" style="padding-left:0; font-size:9pt;"><strong>Verkehrswert: </strong></div><div style="text-align:right; font-size:9pt"><?php echo number_format($objekte[$i]["Wert"], 2, ',', '.') . " €"; ?></div>
                    

                    <div class="col-md-8" style="padding-left:0; font-size:9pt"><strong>Verkehrswertentwicklung: </strong></div><div style="text-align: right; font-size:9pt"><?php echo number_format($objekte[$i]["Wertentwicklung"], 2, ',', '.') . " €"; ?></div>

                    
                    <div class="col-md-8" style="padding-left:0; font-size:9pt"><strong>Mietpreis: </strong></div><div style="text-align: right; font-size:9pt"><?php echo number_format($objekte[$i]["Miete"], 2, ',', '.') . " €"; ?></div>
                    

                    <div class="col-md-8" style="padding-left:0; font-size:9pt"><strong>Mietpreisentwicklung: </strong></div><div style="text-align: right; font-size:9pt"><?php echo number_format($objekte[$i]["Mietentwicklung"], 2, ',', '.') . " €"; ?></div>

                    
                    <div class="col-md-8" style="padding-left:0; font-size:9pt"><strong>Abschreibung: </strong></div><div style="text-align: right; font-size:9pt"><?php echo number_format($objekte[$i]["Abschreibung"], 2, ',', '.') . " €"; ?></div>
                    <br>
                    <?php
                      $immoid = $objekte[$i]["ID"];
                    ?>
                    <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?immokauf=$immoid";?> class="btn btn-success col-md-12"><?php if($objekte[$i]['Baugrundstueck']==1){echo "BAUGRUNDSTÜCK KAUFEN";}else{ echo "IMMOBILIE KAUFEN";} ?></a>

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


}
?>

 