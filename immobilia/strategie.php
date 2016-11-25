<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
	Menu::createMenu("Strategie"); 
?>
			
		<style>
		.selected_item{
			color:#DDDDDD;
		}
		
		.not_selected_item{
			
		}
		</style>

		<script>
		
		jQuery(document).ready(function(e){
			
			/*$('.tests').on('click', function() { 
				alert('2nd click event');
				//  Do something else
			});
			$('.icheckbox_flat-green.checked').click(function(){
				('.strategy_item').addClass('selected_item');
			});*/
			
			$(".icheckbox_flat-green").change(function(event){
				if (this.checked){
					alert("You have elected to show your checkout history.");
				} else {
					alert("You have elected to turn off checkout history.");
				}
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
