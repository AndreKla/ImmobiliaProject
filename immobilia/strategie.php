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
                        $runde = $_SESSION["Runde"];

			Strategie::createStrategieListe($runde);
			Strategie::createStrategieInfo(0);
			Strategie::createStrategieInfo(1);
			Strategie::createStrategieInfo(2);
			Strategie::createStrategieInfo(3);
			Strategie::createStrategieInfo(4);
                        
                        Strategie::createBegruendung($runde);
                        
		?>
                    
            <!-- muss noch an die datenbank gesendet werden
            
                Datenbank eintrag ist in amazon drinne unter
                Strategien -> Begründung
            
            -->
            
 


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
                                        var text = $("#message").val();
					$('input[type=checkbox]').each(function() {
					   if ($(this).is(":checked")) {
					       selected.push($(this).attr('name'));
					   }
					});

					window.location.href = "<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?1=";?>" + selected[0] + "&2=" + selected[1] + "&3=" + selected[2] +  "&4=" + text;  
					
				}					   }

			});
		});
		</script>
                
		
<?php 
	Menu::createFooter(); 
?>
