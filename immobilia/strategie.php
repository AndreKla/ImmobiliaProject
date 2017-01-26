<?php
    
    session_start();
    require_once("includes.php"); 
		
?>
<?php 
	Menu::createMenu("Strategie");
	Menu::checkForCompletion();
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
			Strategie::createStrategieInfo(0);
			Strategie::createStrategieInfo(1);
			Strategie::createStrategieInfo(2);
			Strategie::createStrategieInfo(3);
			Strategie::createStrategieInfo(4);
                        
                        
		?>
                    
                    <!-- muss noch an die datenbank gesendet werden
                    
                        Datenbank eintrag ist in amazon drinne unter
                        Strategien -> Begründung
                    
                    --->
                    
         
                    <div class="clearfix"></div>
                    <div class="col-md-6" style="margin-top:25px">
                    <label for="message">Bitte gebe hier deine Begründung ein:</label><br>
                    <label for="message"> - Wieso hast du dich dafür entschieden?</label>
                    <textarea id="message" required="required" class="form-control" 
                              name="message" data-parsley-trigger="keyup" data-parsley-minlength="100" 
                              data-parsley-maxlength="800" data-parsley-minlength-message="Bitte gebe hier deine Begründung ein"
                              data-parsley-validation-threshold="10"> 
                    </textarea>
                    </div>
                    
		</div>
		<!-- /page content -->

		<script>
		$(document).ready(function(){

			<?php

			$query = "
			SELECT * 
			FROM Strategien
			;";
			$strategien = Database::sqlSelect($query);

			$spielID = $_SESSION["SID"];
			$unternehmensID = $_SESSION["UID"];

			$query = "
			SELECT Strategie1
			FROM Rundendaten
			WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
			ORDER BY Runde DESC
		    ;";
		    $unternehmensStrategie = Database::sqlSelect($query);

			if(sizeof($_GET) > 0 || $unternehmensStrategie[0]["Strategie1"] != 0) {
				?>
					var anzahl = 3;
					$('#zielLabel').text(anzahl + " von 3 Zielen gewählt");
					$('#menu_strategie').css('color', '#1ABB9C');
				<?php
			}
			else {
				?>
					var anzahl = 0;
				<?php
			}

			?>

			$('.to_do li').click(function(e){

				for(var i = 0; i < 5; i++) {
					var ids = "#div" + i;

					$(ids).hide();
				}

				var id = "#div" + (this.id - 1);



				$(id).show();
			});

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
