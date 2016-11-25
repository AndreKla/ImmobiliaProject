<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
	Menu::createMenu("Strategie"); 
?>
						
						
		<!-- page content -->
		<div class="right_col" role="main">
		
		<?php
			Stategie::createStrategieListe("0");
			Elements::createJumbotron();
			
		?>
		
		<style>
			.selected_item{
				
			}
			
			.not_selected_item{
				
			}
		</style>
		<script>
		$(document).ready(function(){

			$(".strategy_item").click(){
				this.toggleClass('.selected_item');
			}
			
			$( 'ul li' ).click( function( e ) {
				// by default, hide all li's
				$( 'ul li' ).hide();
				// show only the selected li
				$( this ).show();
			});
		}); 
		</script>
		
		</div>
		<!-- /page content -->
		
		<?php Menu::createFooter(); ?>
      </div>
    </div>

	<?php include 'includes_js.php'; ?> 
	
  </body>
</html>
