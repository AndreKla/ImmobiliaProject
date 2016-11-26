<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Bestandskonten"); 

?>
				
	<!-- page content -->
	<div class="right_col" role="main">
	
			  <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Konten </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3" style="overflow:auto;">
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Messages</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Settings</a>
                        </li>
					    <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Messages</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Settings</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-6">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <p class="lead">Home tab</p>
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                            synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                        <div class="tab-pane" id="profile">Profile Tab.</div>
                        <div class="tab-pane" id="messages">Messages Tab.</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      </div>
                    </div>

					<div class="col-xs-3" style="overflow:auto;">
                      <ul class="nav nav-tabs tabs-right">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Messages</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Settings</a>
                        </li>
					    <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Messages</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Settings</a>
                        </li>
                      </ul>
                    </div>

                  </div>

                </div>
              </div>
			  
			 
              <div class="clearfix"></div>
	
	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>