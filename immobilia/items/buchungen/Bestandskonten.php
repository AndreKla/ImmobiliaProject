<?php

class Bestandskonten{
    
    
    public static function createBuchungstool(){
                
        $rowHeight = 350;
        
?>
        
	<div class="right_col" role="main">
                        
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa" id="aufgaben"></i> Aufgaben </h2>
						<!-- Hilfe Funktionalität / Text / Popup-->
						<?php include 'help/konten_aufgaben_help.php'; ?>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <?php API::showBuchungsAufgaben();?>
                      </div> 
                    
                     <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Konten </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
                    <div class="col-xs-3" style="overflow:auto;height:<?php echo $rowHeight . "px;"?>;">
                      <ul class="nav nav-tabs tabs-left">
                        <li><a href="Aufwendungen für Instandhaltung" data-toggle="tab">Aufwendungen für Instandhaltung - <small>645000</small></a>
                        </li>
                        <li><a href="Bank" data-toggle="tab">Bank <small>F180000</small></a>
                        </li>
                        <li><a href="Langfristige Bankverbindlichkeiten" data-toggle="tab">Langfristige Bankverbindlichkeiten <br><small>S22222</small></a>
                        </li>
                        <li class="active"><a href="Zinsaufwendungen" data-toggle="tab">Zinsaufwendungen <br><small>S44444</small></a>
                        </li>
                        <li><a href="Personalaufwendungen" data-toggle="tab">Personalaufwendungen <br><small>S11111</small></a>
                        </li>
                        <li><a href="Mieterträge" data-toggle="tab">Mieterträge <br><small>683570</small></a>
                        </li>
                        <li><a href="Abschreibungen" data-toggle="tab">Abschreibungen <br><small>622070</small></a>
                        </li>
                        <li><a href="Zinserträge" data-toggle="tab">Zinserträge <br><small>710500</small></a>
                        </li>                        
                        <li><a href="Verkaufserlöse" data-toggle="tab">Verkaufserlöse <br><small>400000</small></a>
                        </li>
                        <li><a href="Immobilien" data-toggle="tab">Immobilien <br><small>S66666</small></a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-6">
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <!--<p class="lead" style="margin-left:250px;">Betrag</p>-->
                           <div class="col-md-12" style="margin-top:100px"> 
                               <span id="sollkontoText" style="float:left;"><big>Sollkonto:</big> </span>
                               <span id="habenkontoText" style="float:right;"><big>Habenkonto:</big> </span>
                           </div><br>
                           <div class="col-md-12" style="margin-top:15px">
                                  <input type="text" id="summe" class="form-control" name="summe" placeholder="Betrag" style="width:150px;float:none;margin-left:auto;margin-right:auto;">
                           </div>
                           <div class="col-md-12 text-center" style="margin-top:15px">
                                <button id="confirmButton" style="width:100px" class="btn btn-success">BUCHEN</button>
                           </div>
                          <div id="result"></div>
                        </div>
                        
                      </div>
                    </div>

                    <div class="col-xs-3" style="overflow:auto;height:<?php echo $rowHeight . "px;"?>">
                      <ul class="nav nav-tabs tabs-right">
                        <li><a href="Aufwendungen für Instandhaltung" data-toggle="tab">Aufwendungen für Instandhaltung - <small>645000</small></a>
                        </li>
                        <li><a href="Bank" data-toggle="tab">Bank <small>F180000</small></a>
                        </li>
                        <li><a href="Langfristige Bankverbindlichkeiten" data-toggle="tab">Langfristige Bankverbindlichkeiten <br><small>S22222</small></a>
                        </li>
                        <li class="active"><a href="Zinsaufwendungen" data-toggle="tab">Zinsaufwendungen <br><small>S44444</small></a>
                        </li>
                        <li><a href="Personalaufwendungen" data-toggle="tab">Personalaufwendungen <br><small>S11111</small></a>
                        </li>
                        <li><a href="Mieterträge" data-toggle="tab">Mieterträge <br><small>683570</small></a>
                        </li>
                        <li><a href="Abschreibungen" data-toggle="tab">Abschreibungen <br><small>622070</small></a>
                        </li>
                        <li><a href="Zinserträge" data-toggle="tab">Zinserträge <br><small>710500</small></a>
                        </li>                        
                        <li><a href="Verkaufserlöse" data-toggle="tab">Verkaufserlöse <br><small>400000</small></a>
                        </li>
                        <li><a href="Immobilien" data-toggle="tab">Immobilien <br><small>S66666</small></a>
                        </li>
                      </ul>
                    </div>
                    
                </div>
                    
        <!-- submitbutton function -->
                <script>

                        $(".tabs-left").click(function(){
                            var soll = $('.tabs-left').find('.active').find('a').attr('href');
                            $('#sollkontoText').html("<big>Sollkonto:</big><br>" + soll);
                        });

                        $(".tabs-right").click(function(){
                            var haben = $('.tabs-right').find('.active').find('a').attr('href');
                            $('#habenkontoText').html("<big>Habenkonto:</big><br>"  + haben);
                        });

                        $('#confirmButton').click(function(){
                            var soll = $('.tabs-left').find('.active').find('a').attr('href');
                            var haben = $('.tabs-right').find('.active').find('a').attr('href');
                            var sum = $('#summe').val();

                            $.post( "items/buchungen/checkBuchung.php", { sollkonto: soll, habenkonto: haben, summe: sum}).done(function( data ) {
                               $("#result").html(data); 
                            });
                        });

                </script>
                
              </div>
                
                
            </div>
			 
            <div class="clearfix"></div>
	
	</div>
     

<?php
    }
}
?>

