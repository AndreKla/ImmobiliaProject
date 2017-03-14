<?php

 error_reporting(E_ERROR | E_PARSE);

class SBK{
    
    
    public static function createSBK(){
          
        /*
            verkaufserlös / zinserträge / mieterträge alles plus
        */
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
         
        $query = "
        SELECT * FROM Buchungsaufgaben WHERE UnternehmensID= 1 AND Runde= 1;";
        $buchungen = Database::sqlSelect($query); 
        $sollkonten;
        $habenkonten;
        $summe;
        
        
        for($i = 0; $i < sizeof($buchungen);$i++){
            $sollkonten[$i] = $buchungen[$i]['Sollkonto'];
            $habenkonten[$i] = $buchungen[$i]['Habenkonto'];
            $summe[$i] = $buchungen[$i]['Summe'];
        }
        
        
        $vertriebsaufwendungen;
        $bestandsveränderungen;
        $abschreibungen;
        $sonstiges;
        $gewinn;
        $personalaufwand;
        $mieterträge;
        $zinserträge;
        $verlust;
        $instandhaltung;
        $zinsaufwendungen;
        $verkaufserlöse;
        
        var_dump();
        for($i = 0;$i < sizeof($buchungen);$i++){
           
            if(strcmp($sollkonten[$i], "Personalaufwendungen") !== 0){
                $personalaufwand += $summe[$i];
            }             
            if(strcmp($sollkonten[$i], "Mieterträge") !== 0){
               $mieterträge += $summe[$i];
            }
            if(strcmp($sollkonten[$i], "Zinserträge") !== 0){
                $zinserträge += $summe[$i];
            }
            if(strcmp($sollkonten[$i], "Immobilien") !== 0){
                $verlust += $summe[$i];
            }
            if(strcmp($sollkonten[$i], "Sanierung") !== 0){
                $instandhaltung += $summe[$i];
            }
            if(strcmp($sollkonten[$i], "Kreditzinsen") !== 0 )//&& $habenkonten[$i]=="Bank"){
            {
                $zinsaufwendungen += $summe[$i];
            }
            if(strcmp($sollkonten[$i], "Verkaufimmobilie") !== 0){
                $verkaufserlöse += $summe[$i];
            }            
        }
        

        

?>
        

     <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Schlussbilanzkonten<small> </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th align="center">Soll</th>
                          <th align="center"></th>
                          <th align="center">Haben</th>
                          <th align="center"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Vertriebsaufwendungen</td>                          
                          <td align="right"><?php echo $vertriebsaufwendungen . " €";?></td>
                          <td>Mieterträge</td>
                          <td align="right"><?php echo $mieterträge . " €";?></td>
                        </tr>
                        <tr>
                          <td>Aufwendungen für Instandhaltung</td>                          
                          <td align="right"><?php echo $instandhaltung . " €";?></td>
                          <td>Verkaufserlöse</td>
                          <td align="right"><?php echo $verkaufserlöse . " €";?></td>
                        </tr>
                        <tr>
                          <td>Personalaufwand</td>                          
                          <td align="right"><?php echo $personalaufwand . " €";?></td>
                          <td>Zinserträge</td>
                          <td align="right"><?php echo $zinserträge . " €";?></td>
                        </tr>
                        <tr>
                          <td>Zinsaufwendungen</td>                          
                          <td align="right"><?php echo $zinsaufwendungen . " €";?></td>
                          <td>Bestandsveränderung</td>
                          <td align="right"><?php echo $bestandsveränderungen . " €";?></td>
                        </tr>
                        <tr>
                          <td>Abschreibungen</td>                          
                          <td align="right"><?php echo $abschreibungen . " €";?></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Sonstige Aufwendungen</td>                          
                          <td align="right"><?php echo $sonstiges . " €";?></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Bestandsveränderung</td>                          
                          <td align="right"><?php echo $bestandsveränderungen . " €";?></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td></td>                          
                          <td align="right"></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Gewinn an Eigenkapital</td>                          
                          <td align="right"><?php echo $gewinn . " €";?></td>
                          <td>Verlust an Eigenkapital</td>
                          <td align="right"><?php echo $verlust . " €";?></td>
                        </tr>
                        <tr>
                          <td></td>                          
                          <td align="right"></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td></td>                          
                          <td align="right"><?php echo $gewinn . " €";?></td>
                          <td></td>
                          <td align="right"><?php echo $verlust . " €";?></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            
            <div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom:50px;">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Schlussbilanz<small> </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th align="center">Soll</th>
                          <th align="center">Haben</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Mark</td>
                          <td align="right">Otto</td>
                        </tr>
                        <tr>
                          <td>Jacob</td>
                          <td align="right">Thornton</td>
                        </tr>
                        <tr>
                          <td>Larry</td>
                          <td align="right">the Bird</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            

<?php
    }
}
?>

