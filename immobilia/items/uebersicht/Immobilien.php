<?php

class Immobilien {
	

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
    
    $bestand = explode(';', $immobilien[0]["Bestand"]);  
    
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
                    for($i = 0; $i < sizeof($bestand); $i++) {	
                        
                        $immobilienID = $bestand[$i]["ID"];
                        
                        $query = "
                        SELECT *
                        FROM Objekt
                        WHERE ID = $immobilienID
                        ;";
                        $objekt = Database::sqlSelect($query);
                ?>
                <tr>
                  <td>
                    <img src="<?php echo $objekt[0]["Bild"];?>" width="90px" height="90px">
                  </td>                          
                  <td>
                    <a><small style="font-size:10pt"><?php echo $objekt[0]["Beschreibung"];?></small></a>
                  </td>
                  <td>
                    <small class="pull-left">Verkehrswert:</small><br>
                    <small class="pull-left">Verkehrswertentwicklung (p.a.): </small><br>
                    <small class="pull-left">Miete (p.a.): </small><br>
                    <small class="pull-left">Mietpreisentwicklung (p.a.): </small><br>
                    <small class="pull-left">Abschreibung (p.a.): </small>


                  </td>
                    <?php 
                        for($f = 0; $f < 5; $f++){
                            
                        if($f < $runde){
                    ?>
                    <td>
                        <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo $objekt[0]["Wert"]?></small><br>
                        <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo $objekt[0]?></small><br>
                        <small class="pull-right <?php if($objekt[0]["Miete"]<= 0){echo "red";}?>">  <?php echo $objekt[0]["Miete"]?></small><br>
                        <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo $objekt[0]?></small><br>
                        <small class="pull-right <?php if($objekt[0]["Wert"]<= 0){echo "red";}?>">  <?php echo $objekt[0]?></small>
                    </td>
                    <?php 
                        }else{
                    ?>
                    <td>
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