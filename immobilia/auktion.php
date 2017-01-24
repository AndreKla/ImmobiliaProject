
<?php 
	session_start();
	require_once("includes.php"); 
	Menu::createMenu("Auktion"); 
?>

    <!-- page content -->
    <div class="right_col" role="main" >
	<?php
		Auktion::createAuktion();
	?>
	</div>

	<!-- /page content -->

<?php 
	Menu::createFooter(); 
?>