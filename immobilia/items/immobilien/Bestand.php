<?php

class Bestand {
	

public static function createBestand($aktuellesGeschäftsjahr){
	
    $anzahlGewählteZiele = 0;
    
    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];
    $runde = $_SESSION["Runde"];

    $query = "
    SELECT Bestand
    FROM Unternehmen
    WHERE ID = $uid
    ;";
    $immobilien = Database::sqlSelect($query);

    $bestand = Array();
    
    if($immobilien[0]["Bestand"] != "") {
        $bestand = explode(';', $immobilien[0]["Bestand"]);
    }
    
    
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
                
                <?php 
                    for($i = 0; $i < sizeof($bestand); $i++) {	
                        
                        $immobilienID = $bestand[$i]["ID"];
                        
                        $objekt = Request::getImmobilieByID($immobilienID);
                ?>
                <thead>
                  <tr>
                    <th></th>
                    <th style="width:20%"></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:10%; text-align:center"></th>
                    <th style="width:5%"></th>
                  <!--
                    <th>Bild</th>
                    <th>Adresse</th>
                    <th style="width:30%">Immobilienwerte</th>
                    <th style="width:12%; text-align:center"><?php echo $zeit; ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+1 year")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+2 years")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+3 years")); ?></th>
                    <th style="width:12%; text-align:center"><?php echo date('Y', strtotime("+4 years")); ?></th>
                    <th style="width:7%">Aktionen</th>
                    -->
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td rowspan = 2>
                    <div class="modal-content pull-right" style="border:none">
                        <img src="<?php echo $objekt[0]["Bild"];?>" width="200px" style="vertical-align:center">
                    </div>
                    
                    <div class="x_panel" style="margin-top:15px; text-align:center;">
                        <small><i class="fa fa-building"></i>  &nbsp; Wohneinheit</small>
                    </div>
                  </td>                          
                  <td colspan="5">
                    <a><small style="font-size:10pt"><strong>Adresse</strong></small></a><br><br>
                    <a><small style="font-size:10pt">Kurfürstendamm 124</small></a><br>
                    <a><small style="font-size:10pt">10711 Berlin-Wilmersdorf</small></a>
                  </td>
                  <td></td>
                  <td>
                  <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Details &nbsp; &nbsp;&nbsp;  </a>
                    <a href="#" class="btn btn-info btn-xs weiterbilden"><i class="fa fa-pencil"></i> Vermieten </a>
                    <a href="#" class="btn btn-danger btn-xs kuendigen"><i class="fa fa-trash-o"></i> Verkaufen </a>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <small class="pull-left"><strong>Geschäftsjahr</strong></small><br>
                    <small class="pull-left">Verkehrswert:</small><br>
                    <small class="pull-left">Verkehrswertentwicklung (p.a.): </small><br>
                    <small class="pull-left">Miete (p.a.): </small><br>
                    <small class="pull-left">Mietpreisentwicklung (p.a.): </small><br>
                    <small class="pull-left">Abschreibung (p.a.): </small>


                  </td>
                    <?php 
                        for($f = 0; $f < 5; $f++){
                        ?>
                            <td>
                            <small class="pull-right"><strong> <?php echo date('Y', strtotime("+$f year")); ?></strong></small><br>
                        <?php
                            if($f < $runde){
                        ?>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Wert"], 2, ',', '.') . " €"; ?></small><br>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Wertentwicklung"], 2, ',', '.') . " €"; ?></small><br>
                                <small class="pull-right <?php if($objekt[0]["Miete"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Miete"], 2, ',', '.') . " €"; ?></small><br>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Mietentwicklung"], 2, ',', '.') . " €"; ?></small><br>
                                <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo number_format($objekt[0]["Abschreibung"], 2, ',', '.') . " €"; ?></small>
                            </td>
                        <?php 
                            }
                            else {
                        ?>
                            
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small><br>
                                <small class="pull-right">-</small>
                            </td>
                        <?php
                            }
                        }
                    ?>

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