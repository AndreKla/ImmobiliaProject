<?php

class Helper {

	// type = success (green)
	// type = fail (yellow)
	// type = error (red)

	public static function showMessage($title, $text, $type) {

		?>
			<script>
			$(document).ready(function() {
				new PNotify({
				    title: '<?php echo $title; ?>',
				    text: '<?php echo $text; ?>',
				    type: '<?php echo $type; ?>',
				    styling: 'bootstrap3'
				});
			});
			</script>
        <?php

	}

	public static function checkIfThisPlayerFinishedRound() {

		$rundendaten = Request::getRundendaten();

		if($rundendaten[0]["Abgeschlossen"] == 1) {
			?>
  			<script>
  			window.location.href = 'processing.php';
  			</script>
  			<?php
		}

  	}

  	public static function checkIfThisPlayerIsLoggedIn() {
  		if($_SESSION["SID"] == "") {
  			?>
  			<script>
  			window.location.href = 'login.php';
  			</script>
  			<?php
  		}
  	}


}
?>