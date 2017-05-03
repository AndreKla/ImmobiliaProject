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
        
        $immobilienbestand = Request::getBestand();
        $immobilienWert;
        $personalKosten;
        $mitarbeiter = Request::getMitarbeiterOfPlayer($uid);
        $mitarbeiterWert;
        
        //Immobilienwert
        for($i = 0; $i <= sizeof($immobilienbestand);$i++){
            $immobilienWert = $immobilienWert + $immobilienbestand[$i]["Wert"];
        }
        
        //Mieterträge
        $bestand = Request::getBestand();

        for($i = 0; $i < sizeof($bestand); $i++) {
          $immobilie = Request::getImmobilieById($bestand[$i]["ObjektID"]);
          $mietErträge = $mietErträge + $immobilie[0]["Miete"] + $immobilie[0]["Mietentwicklung"] * ($runde - 1);
        }
        
        //Personalkosten
        $aktuelleMitarbeiter = Request::getMitarbeiter($uid);

        if($aktuelleMitarbeiter[0]["Mitarbeiter"] == "") {
          $count = 0;
          $personalKosten = 0;
        }
        else {
          $mitarbeiterListe = explode(';', $aktuelleMitarbeiter[$i]["Mitarbeiter"]);
          $count = sizeof($mitarbeiterListe);
        }
        for($i = 0; $i < $count; $i++) {

          $mitarbeiter = Request::getMitarbeiterByID($mitarbeiterListe[$i]);
          $personalKosten = $personalKosten + $mitarbeiter[$i]["Gehalt"];
        }

        //Zinsaufwendungen
        $query1 = "
        SELECT Kredit
        FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
        $kreditja = Database::sqlSelect($query1);
        $kidOne = $kreditja[0]["Kredit"];

        $query = "
        SELECT KreditID
        FROM Rundendaten WHERE UnternehmensID = $uid AND SpielID = $sid ;";
        $kreditID = Database::sqlSelect($query);
        $kid = $kreditID[0]["KreditID"];

        $query4 = "
        SELECT *
        FROM Kredit 
        WHERE ID = $kid
        ;";
        $kredit = Database::sqlSelect($query4);

        $zins = 5;
        $laufzeit = 5;
        $kreditsumme = $kredit[0]["Kreditsumme"];

        $drunter = (pow(1.05, 5)-1)/(pow(1.05, 5)*0.05);

        $zinsaufwendungen = $kreditsumme/$drunter;
            
        
        $query = "
        SELECT * FROM Buchungsaufgaben WHERE UnternehmensID= $uid AND Runde= $runde;";
        $buchungen = Database::sqlSelect($query); 
        $sollkonten;
        $habenkonten;
        //$summe;
        
        
        for($i = 0; $i < sizeof($buchungen);$i++){
            $sollkonten[$i] = $buchungen[$i]['Sollkonto'];
            $habenkonten[$i] = $buchungen[$i]['Habenkonto'];
            //$summe[$i] = $buchungen[$i]['Summe'];
        }
        
        
        /*
        $vertriebsaufwendungen;
        $bestandsveränderungen;
        $abschreibungen;
        $sonstiges;
        $gewinn;
        $personalaufwand;
        //$mieterträge;
        $zinserträge;
        $verlust;
        $instandhaltung;
        $zinsaufwendungen;
        $verkaufserlöse;
        
        for($i = 0;$i < sizeof($buchungen);$i++){
           
            if(strcmp($sollkonten[$i], "Personalaufwendungen") !== 0){
                $personalaufwand += $summe[$i];
            }             
            if(strcmp($sollkonten[$i], "Mieterträge") !== 0){
               //$mieterträge += $summe[$i];
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
        }*/
        

        

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
                          <td align="right"><?php echo $mietErträge . " €";?></td>
                        </tr>
                        <tr>
                          <td>Aufwendungen für Instandhaltung</td>                          
                          <td align="right"><?php echo $instandhaltung . " €";?></td>
                          <td>Verkaufserlöse</td>
                          <td align="right"><?php echo $verkaufserlöse . " €";?></td>
                        </tr>
                        <tr>
                          <td>Personalaufwand</td>                          
                          <td align="right"><?php echo $personalKosten . " €";?></td>
                          <td>Zinserträge</td>
                          <td align="right"><?php echo $zinserträge . " €";?></td>
                        </tr>
                        <tr>
                          <td>Zinsaufwendungen</td>                          
                          <td align="right"><?php echo $zinsaufwendungenqs . " €";?></td>
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
                          <th align="center">Aktiv</th>
                          <th align="center"></th>
                          <th align="center">Passiv</th>
                          <th align="center"></th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Immat.Verm.Gegenstände</td>
                          <td align="right">0 €</td>
                          <td>Eigenkapital</td>
                          <td align="right"><?php echo Request::getKontostand() . " €";?></td>
                        </tr>
                        <tr>
                          <td>Grundstücke, Bauten</td>
                          <td align="right"><?php echo $immobilienWert . " €"; ?></td>
                          <td>Darlehen / Kredite</td>
                          <td align="right"><?php echo $kreditsumme . " €";?></td>
                        </tr>
                        <tr>
                          <td>Finanzanlagen</td>
                          <td align="right">0 €</td>
                          <td>-</td>
                          <td align="right">-</td>
                        </tr>
                        <tr>
                          <td>Forderungen aus LL</td>
                          <td align="right"><?php echo $mietErträge . " €";?></td>
                          <td>Verbindlichkeiten aus LL</td>
                          <td align="right">0 €</td>
                        </tr>
                        <tr>
                          <td>Bankguthaben</td>
                          <td align="right"><?php echo Request::getKontostand() . " €";?></td>
                          <td>Sonstige Verbindlichkeiten</td>
                          <td align="right">-</td>
                        </tr>
                        <tr>
                          <!--<td>Kasse</td>
                          <td align="right"><?php echo Request::getKontostand() . " €";?></td>
                          <td></td>
                          <td align="right"></td>-->
                        </tr>
                        <?php
                            $summeAktiva = Request::getKontostand() + $mietErträge + $immobilienWert;
                            $summePassiva =  $kreditsumme + Request::getKontostand();
                        ?>
                        <tr>
                          <td>Summe Aktiva</td>
                          <td align="right"><?php echo $summeAktiva . " €";?></td>
                          <td>Summe Passiva</td>
                          <td align="right"><?php echo $summePassiva . " €";?></td>
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

