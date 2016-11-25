<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
	Menu::createMenu("Strategie"); 
?>
			
		<style>
		.selected_item{
			color:#888888;
		}
		
		.not_selected_item{
			
		}
		</style>

		<script>
		
		jQuery(document).ready(function(e){

			$('.strategy_item').click(function(){
				$('.strategy_item').addClass('selected_item');
			});
		}); 
		
		</script>
		
		<!-- page content -->
		<div class="right_col" role="main">
		
		<?php
			Strategie::createStrategieListe(0);
			Elements::createJumbotron();
			
		?>
		

		
		</div>
		<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>
