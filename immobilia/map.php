<link href="css/map.css" rel="stylesheet">

<?php
    
    session_start();
    
    require_once("includes.php"); 
		Menu::createMenu("Immobilienkarte"); 
				
		if($_GET['immokauf'] == 0) {  //purchased social feed

				$unternehmensID = $_SESSION["UID"];
				$spielID = $_SESSION["SID"];
				$runde = $_SESSION["Runde"];

                API::buyImmobilie(3);
				echo "hi";
		
		}
		
		Maps::createAccordionMap();
    
?>

 <body class="nav-md footer_fixed">
    <div class="container body">
	

	
      <div class="main_container">
		<?php
		
		Maps::createMarkers();
		?>


      <!-- page content -->




    <!-- /page content -->
    </div>

    <!-- footer content -->
<?php 
  Menu::createFooter(); 
?>
