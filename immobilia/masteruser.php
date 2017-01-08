<?php  
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Masteruser"); 
?>

<!-- Meiner Meinung nach fehlen:

Spieler anlegen

2 Felder vorgegeben und dann ein Feld mit Spieler hinzufügen

Username Passwort etc. (mal gucken was wir hier genau brauchen und was der spieler dann selbst festlegen soll)
Username Passwort etc.
+ Spieler hinzufügen (bis zu 10 maximal erstmal würd ich sagen)

Sonst wüsste ich grade nichts. müssen wir gucken wenn wir den rest anlegen. Ich bau da gleich die Datenbank hinter.

-->
	
	<!-- page content -->
	<div class="right_col" role="main">
	
		<div class="col-md-6">
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Spielkonfiguration </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="runden">Spielname<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kapital">Kapital <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Rundenanzahl</label>
						<div class="btn-group" style="margin-left:10px">
                          <button class="btn btn-success" type="button">1</button>
                          <button class="btn btn-success" type="button">2</button>
                          <button class="btn btn-success" type="button">3</button>
						  <button class="btn btn-success" type="button">4</button>
                          <button class="btn btn-success" type="button">5</button>

                        </div>
                      </div>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Schwierigkeit</label>
							<div class="row" >
							  <div class="btn-group" data-toggle="buttons" style="margin-left:10px">
								<label class="btn btn-default">
								  <input type="radio" name="options" id="option1"> Leicht
								</label>
								<label class="btn btn-default">
								  <input type="radio" name="options" id="option2"> Mittel
								</label>
								<label class="btn btn-default">
								  <input type="radio" name="options" id="option3"> Schwer
								</label>
							  </div>
							</div>
						</div>
							
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Szenario</label>
							<div class="btn-group" style="margin-left:10px">
							  <button type="button" class="btn btn-danger">Auswählen</button>
							  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="#">Beständiger Markt</a>
								</li>
								<li><a href="#">Aufschwung</a>
								</li>
								<li><a href="#">Abschwung</a>
								</li>
							  </ul>
							</div>
					  </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Starten</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

		</div>
	

	</div>


	<!-- /page content -->

		
<?php 
	Menu::createFooter(); 
?>