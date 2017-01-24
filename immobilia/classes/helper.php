<?php

class Helper {

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




}
?>