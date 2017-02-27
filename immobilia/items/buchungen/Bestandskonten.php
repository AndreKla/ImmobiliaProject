<?php

class Bestandskonten{
    
    
    public static function createBuchungstool(){
                
        $rowHeight = 350;
    
    
        $spielID = $_SESSION["SID"];
        $unternehmensID = $_SESSION["UID"];

        $query = "
        SELECT Runde, Kapital
        FROM Rundendaten
        WHERE SpielID = $spielID AND UnternehmensID = $unternehmensID
        ORDER BY Runde DESC
        ;";
        $runde = Database::sqlSelect($query);
        $yearsToAdd = $runde[0]["Runde"] - 1;
        $aktuelleRunde = $runde[0]["Runde"];

        $_SESSION["Runde"] = $aktuelleRunde;

         
        $query = "
        SELECT * 
        FROM Unternehmen
        WHERE ID = $unternehmensID;";
        $unternehmen = Database::sqlSelect($query);

        $sid = $_SESSION["SID"];
         $uid = $_SESSION["UID"];

         $query = "
         SELECT Mitarbeiter
         FROM Unternehmen
         WHERE SID = $sid AND ID = $uid
         ;";
         $mitarbeiter = Database::sqlSelect($query);

         $mitarbeiter = explode(';', $mitarbeiter[0]["Mitarbeiter"]);
         $bestand = explode(';', $unternehmen[0]["Bestand"]);  
                  
         if(sizeof($mitarbeiter)!= 0){
             $mitarbeiterBuchung = 1;
         }
         
         if(sizeof($bestand)!= 0){
             $bestandBuchung = 1;
         }
         
        
?>
        
	<div class="right_col" role="main">
                        
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa" id="aufgaben"></i> Aufgaben </h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <?php if($mitarbeiterBuchung==1){ echo "<p> - Die Löhne und Gehälter werden überwiesen. Bitte berechnen Sie den Personalaufwand und buchen Sie diesen.</p>";}?>
                          <?php if($bestandBuchung==1){ echo "<p> - Die Gebäude sind planmäßig abzuschreiben. Die Abschreibungswerte sind den Objekten zu entnehmen.</p>";}?>
                      </div> 
                    
                     <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Konten </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3" style="overflow:auto;height:<?php echo $rowHeight . "px;"?>;">
                      <ul class="nav nav-tabs tabs-left">
                        <li><a href="#instandhaltung" data-toggle="tab">Aufwendungen für Instandhaltung</a>
                        </li>
                        <li><a href="111" data-toggle="tab">Bank</a>
                        </li>
                        <li><a href="#bankverbindlichkeiten" data-toggle="tab">Langfristige Bankverbindlichkeiten </a>
                        </li>
                        <li class="active"><a href="#zinsaufwendungen" data-toggle="tab">Zinsaufwendungen</a>
                        </li>
                        <li><a href="#personalaufwendungen" data-toggle="tab">Personalaufwendungen</a>
                        </li>
                        <li><a href="#mietertraege" data-toggle="tab">Mieterträge</a>
                        </li>
                        <li><a href="#abschreibungen" data-toggle="tab">Abschreibungen</a>
                        </li>
                        <li><a href="#zinsertraege" data-toggle="tab">Zinserträge</a>
                        </li>                        
                        <li><a href="#verkaufserloese" data-toggle="tab">Verkaufserlöse</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-6">
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <!--<p class="lead" style="margin-left:250px;">Betrag</p>-->
                          <input type="text" id="summe" name="summe" placeholder="Betrag" style="margin-left:200px;padding:10px;margin-top:100px;">
                          <button id="confirmButton" class="btn btn-success">BUCHEN</button>
                          <div id="result"></div>
                          <!-- submitbutton function -->
                            <script>
                                
                          
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
                        <div class="tab-pane" id="profile">Profile Tab.</div>
                        <div class="tab-pane" id="messages">Messages Tab.</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      </div>
                    </div>

                    <div class="col-xs-3" style="overflow:auto;height:<?php echo $rowHeight . "px;"?>">
                      <ul class="nav nav-tabs tabs-right">
                        <li><a href="#instandhaltung" data-toggle="tab">Aufwendungen für Instandhaltung</a>
                        </li>
                        <li><a href="111" data-toggle="tab">Bank</a>
                        </li>
                        <li><a href="#bankverbindlichkeiten" data-toggle="tab">Langfristige Bankverbindlichkeiten </a>
                        </li>
                        <li class="active"><a href="#zinsaufwendungen" data-toggle="tab">Zinsaufwendungen</a>
                        </li>
                        <li><a href="#personalaufwendungen" data-toggle="tab">Personalaufwendungen</a>
                        </li>
                        <li><a href="#mietertraege" data-toggle="tab">Mieterträge</a>
                        </li>
                        <li><a href="#abschreibungen" data-toggle="tab">Abschreibungen</a>
                        </li>
                        <li><a href="#zinsertraege" data-toggle="tab">Zinserträge</a>
                        </li>                        
                        <li><a href="#verkaufserloese" data-toggle="tab">Verkaufserlöse</a>
                        </li>
                      </ul>
                    </div>
                    
                </div>
                
                
                <!--<div class="x_panel" style="height:350px;">-->
                 

                  <!--</div>-->

                </div>
                
                
            </div>

	
            <!--<div class="col-md-8 col-sm-8 col-xs-12" >
                
              </div>-->
			  
			 
              <div class="clearfix"></div>
	
	</div>
     

<?php
    }
}
?>

