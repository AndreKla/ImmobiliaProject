<?php

class MapMarkers{


public static function createMarkers() {
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Objekt
    ;";
    $objekte = Database::sqlSelect($query);

?>	
          <script src="http://www.google.com/jsapi"></script>
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
				 {"longitude": "<?php echo $objekte[$i]["Longitude"]?>" ,
                  "latitude": "<?php echo $objekte[$i]["Latitude"] ?>" ,
                  "created_by": "<?php echo $objekte[$i]["Beschreibung"] ?>",
                  "created_date": "2015-01-10 09:01:09",
                  "msisdn": "<?php echo $objekte[$i]["Bild"]?>",
                  "registrant": "Paolo Ai"
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
                html = html + "<img src='"+ dataPhoto.msisdn + "' width='150px' height='auto'>";
                html = html + "<p><strong>Date: </strong>" + dataPhoto.created_date + "</p>";
                html = html + "<p><strong>Agent: </strong>" + dataPhoto.created_by + "</p>";
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
		  
<?php
}}
?>

          <!--<script type="text/javascript">
            $(document).ready(function() {

              //var cb = function(start, end, label) {
              //    console.log(start.toISOString(), end.toISOString(), label);
              //    $('#reportrange span').html(start.format('ll') + ' - ' + end.format('ll'));
              //   //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
              //}

              var cb = function(start, end, label) {
                //console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                window.location.replace("http://localhost/work/simreg_newvoda/index.php/dashboard/?from=" + start.format('YYYY-MM-DD') + "&to=" + end.format('YYYY-MM-DD'));
              }

              var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '03/30/2015',
                dateLimit: {
                  days: 100
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                  applyLabel: 'Submit',
                  cancelLabel: 'Clear',
                  fromLabel: 'From',
                  toLabel: 'To',
                  customRangeLabel: 'Custom',
                  daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                  monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                  firstDay: 1
                }
              };

              var optionSet2 = {
                startDate: moment().subtract(7, 'days'),
                endDate: moment(),
                opens: 'right',
                ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
              };

              $('#reportrange span').html('Date Filtering'); //moment().subtract(29, 'days').format('ll') + ' - ' + moment().format('ll')

              $('#reportrange').daterangepicker(optionSet1, cb);

              $('#reportrange').on('show.daterangepicker', function() {
                console.log("show event fired");
              });
              $('#reportrange').on('hide.daterangepicker', function() {
                console.log("hide event fired");
              });
              $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
              });
              $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                console.log("cancel event fired");
              });

              $('#options1').click(function() {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
              });

              $('#options2').click(function() {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
              });

              $('#destroy').click(function() {
                $('#reportrange').data('daterangepicker').remove();
              });

            });
          </script>-->
		  
		  

		<!--
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/highcharts.js"></script>
          <script type="text/javascript" data-rocketsrc="http://vodacom.registersim.com/assets/dashboard/maps/jquery.maphilight.min.js;" data-rocketoptimized="true"></script>
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/maps/jquery.maphilight.min.js"></script>
          <script src="http://vodacom.registersim.com/assets/dashboard/js/jquery.colorbox.js"></script>
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/moment.min.js"></script>
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/daterangepicker.js"></script>
          <script src="http://vodacom.registersim.com/assets/dashboard/js/jquery.masonry.min.js"></script>-->
		  
		  
  