<link href="css/map.css" rel="stylesheet">

<?php
    
    session_start();
    
    require_once("includes.php"); 
		Menu::createMenu("Immobilienkarte"); 

                if(isset($_GET['immokauf'])) {  //purchased social feed

				$unternehmensID = $_SESSION["UID"];
				$spielID = $_SESSION["SID"];
				$runde = $_SESSION["Runde"];

                API::buyImmobilie($_GET['immokauf']);
		
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
