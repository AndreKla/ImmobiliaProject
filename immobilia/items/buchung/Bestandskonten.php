<?php

class Bestandskonten{
    
    
    public static function createBuchungstool(){
        
?>
        
	<div class="right_col" role="main">
                        
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa"></i> Aufgaben </h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <p> - Die Löhne und Gehälter werden überwiesen. Bitte berechnen Sie den Personalaufwand und buchen Sie diesen.</p>
                          <p> - Mieter überweisen laut Bankauszug die fälligen Jahresmieten. Bitte berechnen Sie zunächst die Mieteinnahmen und buchen Sie diese.</p>
                          <p> - Die Gebäude sind planmäßig abzuschreiben. Die Abschreibungswerte sind den Objekten zu entnehmen.</p>
                          <p> - Ausgleich einer Darlehensschuld durch Überweisung: 5000€</p>
                      </div> 
                    
                     <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Konten </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3" style="overflow:auto;height:250px;">
                      <ul class="nav nav-tabs tabs-left">
                        <li><a href="#bebaute_grundstuecke" data-toggle="tab">Aufwendungen für Instandhaltung</a>
                        </li>
                        <li><a href="#unbebaute_grundstuecke" data-toggle="tab">Bank</a>
                        </li>
                        <li><a href="#fuhrpark" data-toggle="tab">Langfristige Bankverbindlichkeiten </a>
                        </li>
                        <li class="active"><a href="#buero_ausstattung" data-toggle="tab">Zinsaufwendungen</a>
                        </li>
                        <li><a href="#vorraete" data-toggle="tab">Personalaufwendungen</a>
                        </li>
                        <li><a href="#bankkonto" data-toggle="tab">Mieterträge</a>
                        </li>
                        <li><a href="#bank" data-toggle="tab">Abschreibungen</a>
                        </li>
                        <li><a href="#bank" data-toggle="tab">Zinserträge</a>
                        </li>                        
                        <li><a href="#bank" data-toggle="tab">Verkaufserlöse</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-6">
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <!--<p class="lead" style="margin-left:250px;">Betrag</p>-->
                          <input type="text" name="summe" value="Betrag" style="margin-left:200px;padding:10px;margin-top:100px;">
                          <a href="" class="btn btn-success">BUCHEN</a>

                        </div>
                        <div class="tab-pane" id="profile">Profile Tab.</div>
                        <div class="tab-pane" id="messages">Messages Tab.</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      </div>
                    </div>

                    <div class="col-xs-3" style="overflow:auto;height:250px;">
                      <ul class="nav nav-tabs tabs-right">
                        <li><a href="#bebaute_grundstuecke" data-toggle="tab">Aufwendungen für Instandhaltung</a>
                        </li>
                        <li><a href="#unbebaute_grundstuecke" data-toggle="tab">Bank</a>
                        </li>
                        <li><a href="#fuhrpark" data-toggle="tab">Langfristige Bankverbindlichkeiten </a>
                        </li>
                        <li class="active"><a href="#buero_ausstattung" data-toggle="tab">Zinsaufwendungen</a>
                        </li>
                        <li><a href="#vorraete" data-toggle="tab">Personalaufwendungen</a>
                        </li>
                        <li><a href="#bankkonto" data-toggle="tab">Mieterträge</a>
                        </li>
                        <li><a href="#bank" data-toggle="tab">Abschreibungen</a>
                        </li>
                        <li><a href="#bank" data-toggle="tab">Zinserträge</a>
                        </li>                        
                        <li><a href="#bank" data-toggle="tab">Verkaufserlöse</a>
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

