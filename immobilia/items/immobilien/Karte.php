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
                    "created_by": "<?php echo $objekte[$i]["Kaufpreis"]." €"?>",
                    "created_date": "<?php echo $objekte[$i]["Flaeche"]." € "?>",
                    "msisdn": "<?php echo $objekte[$i]["Bild"]?>",
                    "registrant": "<?php echo $objekte[$i]["Beschreibung"] ?>",
                    "id": "<?php echo "marker" . $i; ?>"
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
                  var html = "<div id='acc" + dataPhoto.id +"' style='width:200px;'><strong style='font-weight:bold;margin-top:5px;'>" + dataPhoto.registrant + "</strong><br><br>";
                  html = html + "<img src='"+ dataPhoto.msisdn + "' width='200px' height='auto'><br><br>";
                  html = html + "<strong>Fläche in m²: </strong>" + dataPhoto.created_date + "";
                  html = html + "<br><p><strong>Verkehrswert:</strong>" + dataPhoto.created_by + "</p>";
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

 