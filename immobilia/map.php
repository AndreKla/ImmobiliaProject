<?php
    
    session_start();
    
    require_once("includes.php"); 
		Menu::createMenu("Immobilienkarte"); 
		
		Elements::createAccordionTile();
		#Radar::createRadar();
    
?>

 <body class="nav-md footer_fixed">
    <div class="container body">
	

	
      <div class="main_container">



      <!-- page content -->
       <style>
          body {
            background: #fff;
            color: #6F6F6F
          }

          @media (min-width: 1200px) {
            .container {
              width: 100%;
            }
          }

          a {
            color: #75787B;
          }

          .top_menu {
            margin-top: 6px
          }

          .page_logo {
            width: 25%;
            float: left;
            height: 75px;
            font-size: 25px;
          }

          .page_nav {
            width: 75%;
            float: left
          }

          .report_title {
            font-size: 20px;
            color: #75787B;
            font-weight: bold;
            border-bottom: 2px solid #B4B4B4;
            padding-bottom: 5px;
          }

          .report_title:hover {
            color: #e00000;
            border-bottom: 2px solid #7c7c7c;
          }

          @media (min-width: 992px) {
            .col-md-4 {
              width: 33%;
            }
            .col-md-8 {
              width: 65%
            }
          }

          .nav-tabs > li > a {
            border: 0;
          }

          .nav-tabs {
            border: 0;
            margin-top: 22px
          }

          .nav-tabs > li.active > a,
          .nav-tabs > li.active > a:hover,
          .nav-tabs > li.active > a:focus {
            color: #FFF;
            cursor: default;
            background-color: transparent;
            border: 0px solid #ddd;
            border-bottom-color: transparent;
          }

          .nav > li > a:hover,
          .nav > li > a:focus {
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0.13);
            border: 0;
            color: #C2C2C2;
          }

          .daterangepicker table {
            width: 100%;
            margin: 0;
            color: #70757E;
          }

          .nav > li > a:hover,
          .nav > li > a:focus {
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0);
            border: 0;
            color: #C2C2C2;
          }

          .single_block {
            overflow: hidden !important
          }

          #main-map canvas {
            margin-top: 2px;
          }

          .map.anto {
            zoom: 0.9%;
            zoom: 0.87;
            -ms-zoom: 0.9;
            -webkit-zoom: 0.9;
            -moz-transform: scale(0.9, 0.9);
            -moz-transform-origin: left center;
          }

          #map-tooltip {
            position: absolute;
            background: #f2f2f2;
            border: solid 2px #bababa;
            margin-left: 5px;
            margin-top: 0px;
            padding: 7px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            z-index: 1000;
          }

          .white {
            background: #fff !important
          }

          .btn-primary {
            color: #fff;
            background-color: #9D9D9D;
            border-color: #9D9D9D;
          }

          .btn-primary:hover,
          .btn-primary:focus,
          .btn-primary:active,
          .btn-primary.active,
          .open > .dropdown-toggle.btn-primary {
            color: #fff;
            background-color: #797878;
            border-color: #797878;
          }
        </style>

          <style>
            body {
              background: rgb(80, 96, 186);
              color: #fff
            }

            @media (min-width: 1200px) {
              .container {
                width: 100% !important;
              }
            }

            a {
              color: rgb(255, 172, 42);
            }

            .top_menu {
              margin-top: 6px
            }

            .page_logo {
              width: 25%;
              float: left;
              height: 75px;
              font-size: 25px;
            }

            .page_nav {
              width: 75%;
              float: left
            }

            .report_title {
              font-size: 20px;
              color: #F4F8FC;
              font-weight: bold;
              border-bottom: 2px solid #B4B4B4;
              padding-bottom: 5px;
            }

            .report_title:hover {
              color: rgb(255, 172, 42);
              border-bottom: 2px solid #7c7c7c;
            }

            @media (min-width: 992px) {
              .col-md-4 {
                width: 33%;
              }
              .col-md-8 {
                width: 65%
              }
            }

            .nav-tabs > li > a {
              border: 0;
            }

            .nav-tabs {
              border: 0;
              margin-top: 22px
            }

            .nav-tabs > li.active > a,
            .nav-tabs > li.active > a:hover,
            .nav-tabs > li.active > a:focus {
              color: #FFF;
              cursor: default;
              background-color: transparent;
              border: 0px solid #ddd;
              border-bottom-color: transparent;
            }

            .nav > li > a:hover,
            .nav > li > a:focus {
              text-decoration: none;
              background-color: rgba(0, 0, 0, 0.13);
              border: 0;
              color: #C2C2C2;
            }

            .daterangepicker table {
              width: 100%;
              margin: 0;
              color: #70757E;
            }

            .nav > li > a:hover,
            .nav > li > a:focus {
              text-decoration: none;
              background-color: rgba(0, 0, 0, 0);
              border: 0;
              color: #C2C2C2;
            }

            .single_block {
              overflow: hidden !important
            }

            #main-map canvas {
              margin-top: 2px;
            }

            .map.anto {
              zoom: 0.9%;
              zoom: 0.9;
              -ms-zoom: 0.9;
              -webkit-zoom: 0.9;
              -moz-transform: scale(0.9, 0.9);
              -moz-transform-origin: left center;
            }

            #map-tooltip {
              position: absolute;
              background: #f2f2f2;
              border: solid 2px ##bababa;
              margin-left: 5px;
              margin-top: 0px;
              padding: 7px;
              border-radius: 5px;
              -moz-border-radius: 5px;
              -webkit-border-radius: 5px;
              z-index: 1000;
            }
          </style>
          <style type="text/css">
            #map-container {
              padding: 6px;
              border-width: 1px;
              border-style: solid;
              border-color: #ccc #ccc #999 #ccc;
              -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
              -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
              box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
              width: 100%;
            }

            body {
              background: white !important;
              color: #585757 !important;
            }

            #map {
              width: 100%;
              height: 100%;
            }
          </style>
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
                "photos": [{
                  "longitude": "13.405414583394304",
                  "latitude": "52.51929194655397",
                  "created_by": "MFS Vodashop Moshi",
                  "created_date": "2015-01-10 09:01:09",
                  "msisdn": "255756972562",
                  "registrant": "Paolo Ai"
                }]
              };

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
                var html = "<div class='infowin'><strong>" + dataPhoto.registrant + "</strong><hr>";
                html = html + "<p><strong>MSISDN: </strong>" + dataPhoto.msisdn + "</p>";
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




          <script src="http://vodacom.registersim.com/assets/dashboard/js/jquery.masonry.min.js"></script>
          <script>
            $(function() {
              $('#report_blocks').masonry({
                // options
                itemSelector: '.single_block',
              });
            });
          </script>

          <script src="http://vodacom.registersim.com/assets/dashboard/js/jquery.colorbox.js"></script>
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

          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/moment.min.js"></script>
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/daterangepicker.js"></script>
          <script type="text/javascript">
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
          </script>

          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/js/highcharts.js"></script>



          <script type="text/javascript" data-rocketsrc="http://vodacom.registersim.com/assets/dashboard/maps/jquery.maphilight.min.js;" data-rocketoptimized="true"></script>
          <script type="text/javascript" src="http://vodacom.registersim.com/assets/dashboard/maps/jquery.maphilight.min.js"></script>
    <!-- /page content -->
    </div>

    <!-- footer content -->
<?php 
  Menu::createFooter(); 
?>