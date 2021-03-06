﻿<?php

class Liste {

  public static function createListe(){
  	
    $anzahlGewählteZiele = 0;

    $immobilien = Request::getUnownedImmobilien();

    ?>


    <div class="clearfix"></div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Immobilienmarkt <small>Berlin</small></h2>
              <!-- Hilfe Funktionalität / Text / Popup-->
              <?php include 'help/bestand_immobilienbestand_help.php'; ?>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="table table-striped projects">
                
                <?php 
                    for($i = 0; $i < sizeof($immobilien); $i++) { 
                        
                        $immobilienID = $immobilien[$i]["ID"];
                        
                        $objekt = Request::getImmobilieByID($immobilienID);
                        
                        

                        if($immobilien[$i]["Verkauft"] == 0) {
                          
                ?>
                 <!---->
                <tbody id="<?php echo "accmarker".$i;?>">

                <tr>
                  <td rowspan="2" width="140px">
                    <div class="modal-content" style="border:none;">
                        <img src="<?php echo $objekt[0]["Bild"];?>" width="140px" style="vertical-align:center;">
                    </div>
                  </td>                          
                  <td rowspan="1" colspan="2" style="max-width:250px">
                    <a><small style="font-size:10pt"><strong><?php echo $objekt[0]["Beschreibung"]; ?></strong></small></a><br>
                    <a><small style="font-size:10pt"><?php echo $objekt[0]["Strasse"]; ?></small></a><br>
                    <a><small style="font-size:10pt"><?php echo $objekt[0]["PLZ"] . " " . $objekt[0]["Ort"]; ?></small></a>
                  </td>
                  <td style="text-align:center;" rowspan="1">
                      <a><small style="font-size:10pt;padding-left:10px;padding-right:10px"><strong>Kaufpreis</strong></small></a><br><br>
                      <span class="label label-default"> <?php echo number_format(API::getMarktImmobilienValueById($objekt[0]["ID"]),2,',','.') . " €"; ?> </span>
                  </td>
                  <td style="text-align:center;" rowspan="1">
                      <a><small style="font-size:10pt;padding-left:10px;padding-right:10px"><strong> Ø Miete/m²</strong></small></a><br><br>
                      <span class="label label-default"> <?php echo number_format(($immobilien[$i]["Miete"] / $immobilien[$i]["Flaeche"]) / 12,2,',','.') . " €"; ?> </span>
                  </td>
                  <td style="text-align:center;" rowspan="1">
                      <a><small style="font-size:10pt;padding-left:10px;padding-right:10px"><strong>Mikrolage</strong></small></a><br><br>
                      <span class="label label-<?php if($objekt[0]["Lage"] < 4) { echo "danger"; } else if($objekt[0]["Lage"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($objekt[0]["Lage"] < 4) { echo "schlecht"; } else if($objekt[0]["Lage"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                  </td>
                  <td style="text-align:center" rowspan="1">
                      <a><small style="font-size:10pt;padding-left:10px;padding-right:10px"><strong>Wohnfläche</strong></small></a><br><br>
                      <span class="label label-<?php if($immobilien[$i]["Bau"] == 1) { echo "default"; } else if($immobilien[$i]["Flaeche"] < 80) { echo "danger"; } else if($immobilien[$i]["Flaeche"] < 130) { echo "warning"; } else { echo "success"; } ?>"><?php if($immobilien[$i]["Bau"] == 1) { echo "n/a"; } else if($immobilien[$i]["Zustand"] < 4) { echo $immobilien[$i]["Flaeche"] . " qm"; } else if($immobilien[$i]["Zustand"] < 7) { echo $immobilien[$i]["Flaeche"] . " qm"; } else { echo $immobilien[$i]["Flaeche"] . " qm"; } ?></span>
                  </td>
                  <td style="text-align:center" rowspan="1">
                      <a><small style="font-size:10pt;padding-left:10px;padding-right:10px"><strong>Zustand</strong></small></a><br><br>
                      <span class="label label-<?php if($immobilien[$i]["Bau"] > 0) { echo "default"; } else if($immobilien[$i]["Zustand"] < 4) { echo "danger"; } else if($immobilien[$i]["Zustand"] < 7) { echo "warning"; } else { echo "success"; } ?>"><?php if($immobilien[$i]["Bau"] > 0) { echo "n/a"; } else if($immobilien[$i]["Zustand"] < 4) { echo "schlecht"; } else if($immobilien[$i]["Zustand"] < 7) { echo "mittel"; } else { echo "gut"; } ?></span>
                  </td>
                </tr>
                <tr>



                    <td colspan="2" style="padding-top:12px">
                        <div class="x_panel" style="padding:5px; margin-top:0px; text-align:center;">
                        <?php
                            if($immobilien[$i]["Bau"] == 0) {
                                echo "<small><i class='fa fa-home'></i>  &nbsp; Wohneinheit</small>";
                            }
                            else {
                                echo "<small><i class='fa fa-tree'></i>  &nbsp; Baugrundstück</small>";
                            }
                        

                        ?>
                        </div>
                    </td>
                    <td colspan="2" style="padding-top:12px">
                      <div class="x_panel col-md-3" style="padding:5px; margin-top:0px; text-align:center;">
                        <?php
                            if($immobilien[$i]["Bau"] != 0) {
                                if($immobilien[$i]["Bau"] == 10) {
                                    echo "<small class='red'><i class='fa fa-flag'></i>  &nbsp; Unbebaut</small>";
                                }
                                else if($immobilien[$i]["Bau"] > 1){
                                    echo "<small class='yellow'><i class='fa fa-truck'></i>  &nbsp; Im Bau (" .$immobilien[$i]["Bau"] . " Jahre)</small>";
                                }
                                else {
                                    echo "<small class='yellow'><i class='fa fa-truck'></i>  &nbsp; Im Bau (" .$immobilien[$i]["Bau"] . " Jahr)</small>";
                                }
                            }
                            else {
                                if($immobilien[$i]["Vermietet"] == 0) {
                                    echo "<small class='red'><i class='fa fa-calendar-times-o'></i>  &nbsp; Leerstand</small>";
                                }
                                else {
                                    echo "<small class='green'><i class='fa fa-clipboard'></i>  &nbsp; Vermietet</small>";
                                } 
                            }
                        ?>
                      </div>
                    </td>
                    <td colspan="3" style="padding-top:12px">
                    <?php
                    $immoid = $immobilien[$i]["ID"];
                    ?>

                        <div style="text-align:center">
                            <a href=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?immokauf=$immoid";?> class="btn btn-dark btn-xs weiterbilden col-md-offset-4 col-md-8" style="padding:5px; margin-top:0px; margin-bottom:10px"> Kaufen </a>
                        </div>
                    </td>
                </tr>
                <tr>
                <td colspan="8" style="background-color:white">
                <div style="height:5px; background-color:white; margin:0; padding:0"></div>
                </td>
                </tr>
                <?php  
                }
                ?>
                </tbody>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>

  	
    <?php
  }

}
?>

 