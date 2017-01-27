<?php  
    session_start();
    require_once("includes.php"); 
    Menu::includeHead(); 
?>
	<br><br>
          <div class="col-md-8 col-xs-12 col-md-offset-2">
            <div class="x_panel">
              <div class="x_title">
                <h2>Spiel anlegen <small>Bitte legen Sie die Startoptionen für Ihr Spiel fest</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" action="index.php" method="POST">

                  

                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Rundenanzahl</label>
                    <div class="btn-group" style="margin-left:10px">
                      <button class="btn btn-default" type="button">1</button>
                      <button class="btn btn-default" type="button">2</button>
                      <button class="btn btn-default" type="button">3</button>
                      <button class="btn btn-default" type="button">4</button>
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

                  <div class="row">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Szenario</label>
                      <div class="btn-group" style="margin-left:15px;margin-bottom:15px;">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Auswählen <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                        <li><a href="#">Beständiger Markt</a>
                        </li>
                        <li><a href="#">Aufschwung</a>
                        </li>
                        <li><a href="#">Abschwung</a>
                        </li>
                        </ul>
                      </div>
                    </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unternehmensname">Startkapital <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="unternehmensname" name="unternehmensname" required="required" placeholder="Startkapital in €" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf1">
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label>Es können noch 3 lizensierte Accounts angelegt werden:</label>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf2">User 1
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Nutzername" type="text">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Passwort" type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf2">User 2
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Nutzername" type="text">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Passwort" type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gf2">User 3
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Nutzername" type="text">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="name" class="form-control col-md-5 col-xs-12" name="gf2" placeholder="Passwort" type="text">
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-9">
                      <button type="submit" class="btn btn-success">Spiel anlegen</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
	<!-- page content -
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
							
							
						<div class="row">
						<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Szenario</label>
							<div class="btn-group" style="margin-left:15px;margin-bottom:15px;">
							  <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Ausw?len <span class="caret"></span> </button>
							  <ul class="dropdown-menu">
								<li><a href="#">Best?diger Markt</a>
								</li>
								<li><a href="#">Aufschwung</a>
								</li>
								<li><a href="#">Abschwung</a>
								</li>
							  </ul>
							</div>
						</div>
						
					  <div class="control-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Spieler Namen</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="tags_1" type="text" class="tags form-control" value="social, adverts, sales" />
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
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