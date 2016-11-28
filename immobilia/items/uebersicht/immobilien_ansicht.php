<?php

class Immobilien {
	

public static function bestand(){
	
	$anzahlGew�hlteZiele = 0;

    $query = "
    SELECT *
    FROM Objekt
    ;";
    $immobilien = Database::sqlSelect($query);
	
?>

			<div class="clearfix"></div>
			
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Immobilien/Grundst�cke</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>Eine �bersicht all deiner Immobilien/Grundst�cke</p>
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">Bild</th>
                          <th style="width: 10%">Adresse</th>
						  <th style="width: 7.5%">Kennzahlen</th>
						  <th style="width: 7.5%">2016</th>
                          <th style="width: 7.5%">2017</th>
						  <th style="width: 7.5%">2018</th>
                          <th style="width: 7.5%">2019</th>
                          <th style="width: 7.5%">2020</th>
                          <th style="width: 10%">Beschreibung</th>
                          <th style="width: 10%">Zustand</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php 
							for($i = 0; $i < sizeof($immobilien); $i++) {
							
						?>
                        <tr>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="<?php echo $immobilien[$i]["Bild"];?>" width="150px" height="150px" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>                          
						  <td>
                            <a><?php echo $immobilien[$i]["Beschreibung"];?></a>
                            <br />
                            <strong><?php echo $immobilien[$i]["Wert"];?> €</strong>
                          </td>
						  <td>
							<small>Standortkategorie</small><br>
							<small>Miete</small><br>
							<small>Verkehrswert</small><br>
							<small>Verkehrswertentwicklung</small><br>
							<small>Mietkostenentwicklung</small>

                          </td>
						  <td>
							<small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Miete"];?> €</small>
                          </td>
						  <td>
                            <small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Miete"];?> €</small>

                          </td>
						  <td>
                            <small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Miete"];?> €</small>
                          </td>
						   <td>
							<small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Miete"];?> €</small>
                          </td>
						  <td>
							<small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Kaufpreis"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Flaeche"];?> €</small><br>
							<small><?php echo $immobilien[$i]["Miete"];?> €</small>
                          </td>
						  <td>
                            <p><?php echo $immobilien[$i]["Beschreibung"];?></p>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $immobilien[$i]["Wert"];?>"></div>
                            </div>
                            <small><?php echo $immobilien[$i]["Wert"]." %";?></small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">Erfolgreich</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Sanieren </a>
                            <a href="#" class="btn btn-info btn-xs weiterbilden"><i class="fa fa-pencil"></i> Vermieten </a>
                            <a href="#" class="btn btn-danger btn-xs kuendigen"><i class="fa fa-trash-o"></i> Verkaufen </a>
                          </td>
                        </tr>
						<?php 
							}
						?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>




<?php
}

public static function befoerdern(){ 

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke f�r die Bestellung...")
	</script>  

<?php
}

public static function weiterbilden(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke f�r die Bestellung...")
	</script>  
<?php

}
public static function kuendigen(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke f�r die Bestellung...")
	</script>  
<?php
}}
?>