<?php

class Immobilien {
	

public static function createBestand($aktuellesGeschäftsjahr){
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM Objekt
    ;";
    $immobilien = Database::sqlSelect($query);

    $zeit = date('Y');
	
?>
		<div class="clearfix"></div>
			
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Bestand</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p>Eine Übersicht all deiner Objekte</p>
              <table class="table table-striped projects">
                <thead>
                  <tr>
                    <th>Bild</th>
                    <th>Adresse</th>
                    <th style="width:30%">Immobilienwerte</th>
			              <th style="width:12%; text-align:center"><?php echo $zeit; ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+1 year")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+2 years")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+3 years")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+4 years")); ?></th>
                    <th style="width:7%">Aktionen</th>
                  </tr>
                </thead>
                <tbody>
    						<?php 
    							for($i = 0; $i < sizeof($immobilien); $i++) {	
    						?>
                <tr>
                  <td>
                        <img src="<?php echo $immobilien[$i]["Bild"];?>" width="90px" height="90px">
                  </td>                          
						      <td>
                    <a><small style="font-size:10pt"><?php echo $immobilien[$i]["Beschreibung"];?></small></a>
                  </td>
                  <td>
                    <small class="pull-left">Verkehrswert:</small><br>
                    <small class="pull-left">Verkehrswertentwicklung (p.a.):</small><br>
                    <small class="pull-left">Miete (p.a.):</small><br>
                    <small class="pull-left">Mietpreisentwicklung (p.a.):</small><br>
                    <small class="pull-left">Abschreibung (p.a.):</small>


                  </td>
    						  <td>
      							<small class="pull-right">120.000,00 €</small><br>
                    <small class="pull-right red">- 5.500,00 €</small><br>
      							<small class="pull-right">8.400,00 €</small><br>
                    <small class="pull-right red">- 400,00€</small><br>
      							<small class="pull-right">1.440,00 €</small>
                  </td>
                  <td>
                    <small class="pull-right">120.000,00 €</small><br>
                    <small class="pull-right red">- 5.500,00 €</small><br>
                    <small class="pull-right">8.400,00 €</small><br>
                    <small class="pull-right red">- 400,00€</small><br>
                    <small class="pull-right">1.440,00 €</small>
                  </td><td>
                    <small class="pull-right">120.000,00 €</small><br>
                    <small class="pull-right red">- 5.500,00 €</small><br>
                    <small class="pull-right">8.400,00 €</small><br>
                    <small class="pull-right red">- 400,00€</small><br>
                    <small class="pull-right">1.440,00 €</small>
                  </td><td>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small>
                  </td><td>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small><br>
                    <small class="pull-right"></small>
                  </td>
                  <td>
                    <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Details &nbsp; &nbsp;&nbsp;  </a>
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
		alert("Danke für die Bestellung...")
	</script>  

<?php
}

public static function weiterbilden(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke für die Bestellung...")
	</script>  
<?php

}
public static function kuendigen(){

?>
	<script type="text/javascript" language="Javascript"> 
		alert("Danke für die Bestellung...")
	</script>  
<?php
}}
?>