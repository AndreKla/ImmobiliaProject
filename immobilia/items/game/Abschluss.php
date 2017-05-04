<?php

class Abschluss {

  public static function createChecklist() {

  ?>
    <br>
    <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
      <div class="x_panel">
        <div class="x_title">
          <h2>Abschlusscheck</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <?php

          $allChecked = true;

          $rundendaten = Request::getRundendaten();
          $gebot = Request::getGebot();

          if($rundendaten[0]["Strategie1"] == 0) {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Jahresziele festgelegt</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-danger" style="margin:0px;"><i class="fa fa-times-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Jahresziele wurden nicht festgelegt</span> </div>
            <?php
            $allChecked = false;
          }
          if($rundendaten[0]["Social"] != 0) {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Social Media analysiert</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-warning" style="margin:0px;"><i class="fa fa-dot-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Social Media nicht analysiert</span> </div>
            <?php
          }
          if($rundendaten[0]["Marktanalyse"] != 0) {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Markt analysiert</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-warning" style="margin:0px;"><i class="fa fa-dot-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Markt nicht analysiert</span> </div>
            <?php
          }
          if($rundendaten[0]["Konkurrenz"] != 0) {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Konkurrenz analysiert</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-warning" style="margin:0px;"><i class="fa fa-dot-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Konkurrenz nicht analysiert</span> </div>
            <?php
          }
          if(sizeof($gebot) > 0) {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Gebot bei der Zwangsversteigerung abgegeben</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-warning" style="margin:0px;"><i class="fa fa-dot-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Kein Gebot bei der Zwangsversteigerung abgegeben</span> </div>
            <?php
          }
          if(true) { //BUCHUNGEN
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-success" style="margin:0px;"><i class="fa fa-check-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Alle Umsätze verbucht</span> </div>
            <?php
          }
          else {
            ?>
            <div style="font-size:14pt; padding:10px;"><span class="label label-danger" style="margin:0px;"><i class="fa fa-times-circle-o" aria-hidden="true" style="font-size:14px;"></i></span> <span style="font-size:14px; margin-left:20px;">Noch nicht alle Umsätze verbucht</span> </div>
            <?php
            $allChecked = false;
          }

          ?>
          
        </div>
      </div>
    </div>
    <div class="col-md-12"><br><br></div>
    <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1">
      <div class="x_panel">
        <div class="x_content">
          <?php
            if($allChecked) {
          ?>
              <p class="col-md-12"> <small><b>ACHTUNG:</b> Wenn du das Geschäftsjahr abschließt kannst du keine weiteren Planungen für das aktuelle Jahr vornehmen und musst warten bis alle anderen Spielteilnehmer das Geschäftsjahr ebenfalls abgeschlossen haben.<br><br></small> </p>
              <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?startprocessing=1'; ?> class="btn btn-default bg-green col-md-12"> Geschäftsjahr abschließen! </a>
          <?php
            }
            else {
          ?>
            <a href="#" class="btn btn-default col-md-12" disabled> Geschäftsjahr abschließen! </a>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-12"><br><br></div>
        
    <?php
  }


  

}

?>