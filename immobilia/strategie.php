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


		
		<!-- page content -->
		<div class="right_col" role="main">
		
		<?php
			Strategie::createStrategieListe(0);
			Elements::createJumbotron();
		?>
		
		</div>
		<!-- /page content -->

		<script>
		$(document).ready(function(){

			<?php

			$query = "
		    SELECT Strategie1
		    FROM Unternehmen
		    WHERE ID = 1
		    ;";
		    $unternehmensStrategie = Database::sqlSelect($query);

			if(sizeof($_GET) > 0 || $unternehmensStrategie[0]["Strategie1"] != 0) {
				?>
					var anzahl = 3;
					$('#zielLabel').text(anzahl + " von 3 Zielen gewählt");
				<?php
			}
			else {
				?>
					var anzahl = 0;
				<?php
			}

			?>

		    $('input[type="checkbox"]').on('ifChecked', function(event){
			  	$(this).iCheck('check', function(){
			  		anzahl++;
			  		$('#zielLabel').text(anzahl + " von 3 Zielen gewählt");
			  		if(anzahl == 3) {
			  			$('input[type="checkbox"]:not(:checked)').iCheck('disable');
			  		}
				});
			});

			$('input[type="checkbox"]').on('ifUnchecked', function(event){
			  	$(this).iCheck('uncheck', function(){
			  		anzahl--;
			  		$('#zielLabel').text(anzahl + " von 3 Zielen gewählt");
			  		if(anzahl < 3) {
			  			$('input[type="checkbox"]:not(:checked)').iCheck('enable');
			  		}
				});
			});

			$('#ziele_speichern').click(function(event) {
				if(anzahl < 3) {
					alert("Bitte lege 3 Ziele für das nächste Jahr fest!");
				}
				else {
					var selected = [];
					$('input[type=checkbox]').each(function() {
					   if ($(this).is(":checked")) {
					       selected.push($(this).attr('name'));
					   }
					});
					window.location.href = "http://localhost:8888/ImmobiliaProject/immobilia/strategie.php?1=" + selected[0] + "&2=" + selected[1] + "&3=" + selected[2] + "";
				}
			});
		});
		</script>
		
<?php 
	Menu::createFooter(); 
?>
