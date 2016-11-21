<?php
    
    session_start();
    require_once("includes.php"); 
		
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Immobilien </title>

	<?php   include 'includes_css.php'; ?>

  </head>


 <body class="nav-md footer_fixed">
    <div class="container body">
	
		<?php 
		require_once("menu.php");
		Menu::createMenu(); ?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
