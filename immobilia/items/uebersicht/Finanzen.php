<?php

class Finanzen {

  public static function createKontostandEntwicklung($width) {

    $timeToAdd = $_SESSION["Runde"] - 1;

    ?>

    <div class=<?php echo "'col-md-$width col-sm-$width col-xs-12'"; ?>>
      <div class="x_panel">
        <div class="x_title">
          <h2>Kontostand<small>Aktuelles Jahr: <?php echo date('Y', strtotime("+" . $timeToAdd . " year")); ?></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="kontostand"></canvas>
        </div>
      </div>
    </div>


    <?php
  }
	
  public static function createFinanzenTopData($year) {
    if($year == 1) {
      $cashflow = "Noch keine Daten";
      $eigenkapitalquote = "Noch keine Daten";
      $schuldtilgungsdauer = "Noch keine Daten";
      $gesamtkapitalrentabilität = "Noch keine Daten";
    }
    else if($year == 2) {

    }
    else if($year == 3) {

    }
  ?>

	<div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-eur"></i>  &nbsp; Cash-Flow</span>
        <div class="count" style="font-size:18pt"><?php echo $cashflow; ?></div>
        <span class="count_bottom"><i class="green">0% </i> im Vergleich zum letzten Jahr</span>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-percent"></i>  &nbsp; Eigenkapitalquote</span>
        <div class="count" style="font-size:18pt"><?php echo $eigenkapitalquote; ?></div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-clock-o"></i>  &nbsp; Schuldtilgungsdauer</span>
        <div class="count" style="font-size:18pt"><?php echo $schuldtilgungsdauer; ?></div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4 tile_stats_count" style="padding-left:25px;padding-right:25px;">
        <span class="count_top"><i class="fa fa-money"></i>  &nbsp; Gesamtkapitalrentabilität</span>
        <div class="count" style="font-size:18pt"><?php echo $gesamtkapitalrentabilität; ?></div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> im Vergleich zum letzten Jahr</span>
      </div>
    </div>
		  
    <?php
  }

  public static function createFinanzJahresAnsicht(){
	

?>	
	  		<div class="clearfix"></div>
			
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Finanzdaten</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>Eine Übersicht all deiner finanziellen Eckdaten</p>
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 15%">Jahr</th>
                          <th style="width: 15%">Cashflow</th>
						  <th style="width: 15%">Eigenkapitalquote</th>
						  <th style="width: 15%">Schuldtilgungsdauer</th>
                          <th style="width: 10%">Gesamtkapitalrentabilität</th>
						  <th style="width: 15%"></th>
                          <th style="width: 15%">Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <small>2016</small><br>
                              </li>
                            </ul>
                          </td>                          
						  <td>
                            <strong>21.002 €</strong>
                          </td>
						  <td>
							<small>123.50 %</small><br>
                          </td>
						  <td>
							<small>2,500 Monate</small><br>
                          </td>
						  <td>
                            <p>4,567 %</p>
                          </td>
						  <td>
							<div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="12"></div>
                            </div>
						  </td>
                          <td class="project_progress">

                            <a href="#" class="btn btn-primary btn-xs befoerdern"><i class="fa fa-folder"></i> Details ansehen </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  
	  
<?php
  }
}
?>