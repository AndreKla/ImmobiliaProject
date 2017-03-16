
<?php 
	session_start();
	require_once("includes.php"); 
	Menu::createMenu("Auktion"); 

	if(isset($_POST["gebot"])) {

		$gebot = $_POST["gebot"];
		$objektID = $_POST["objektID"];

		Request::setGebot($gebot, $objektID);

	}
?>

    <!-- page content -->
    <div class="right_col" role="main" >
	<?php
		if(Auktion::checkForAuktion()) {
			Auktion::createAuktion();
		}
		else {
			Auktion::showNoAuktion();
		}	
	?>
	</div>

	<!-- /page content -->

<?php 
	Menu::createFooter(); 
?>