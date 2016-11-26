<?php
    
    session_start();
    
    require_once("includes.php"); 
		Menu::createMenu("Immobilienkarte"); 
		
		Elements::createAccordionMap();
		#Radar::createRadar();
    
?>

<link href="css/map.css" rel="stylesheet">

 <body class="nav-md footer_fixed">
    <div class="container body">
	

	
      <div class="main_container">
		<?php
		
		MapMarkers::createMarkers();
		?>


      <!-- page content -->




    <!-- /page content -->
    </div>

    <!-- footer content -->
<?php 
  Menu::createFooter(); 
?>
