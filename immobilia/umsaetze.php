<?php  
  session_start();
  require_once("includes.php"); 
	Menu::createMenu("Jahresabschluss"); 
?>

	<div class="right_col" role="main">
		
	<?php
    
    Finanzen::createKapitalbewegungen(sizeof($rundendaten));

	?>

	</div>

  <script>
      var element = document.getElementById("umsaetze");
        element.scrollTop = element.scrollHeight;
  </script>
		
<?php 
	Menu::createFooter(); 
?>