<!--<button type="button" class="btn btn-primary col-md-12"  >Marktanalyse in Auftrag geben</button>
-->
<?php 
	$targetvariable = 'bs-help-ratgeber-modal-lg';
?>

<ul class="nav navbar-right panel_toolbox">
<li style="float:right;"><a data-target="<?php echo "." .$targetvariable; ?>" data-toggle="modal" role="button"><i class="fa fa-question-circle"></i></a>
</li>
</ul>

<div class="modal fade <?php echo $targetvariable; ?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">

	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	  </button>
	  <h4 class="modal-title" id="myModalLabel">Marktanalyse</h4>
	</div>
	<div class="modal-body">
	
	<h5>Marktanalyse - Immobilienmarkt Berlin 2017</h5>
	  <p>Kosten einmalig: 50.000 €</p>
	  <p>Wir bieten Ihnen einen Überblick über die aktuelle Lage und zukünftige Trends auf dem Immobilienmarkt in Berlin, insbesondere können wir Sie darüber aufklären was Ihre potentiellen Kunden derzeit beschäftigt und wie sich der Markt in Zukunft entwickeln könnte.</p>
	
	<!-- start accordion -->
	<div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
	  <div class="panel">
		<a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne">
		  <h4 class="panel-title">Collapsible Group Item #1</h4>
		</a>
		<div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
		  <div class="panel-body">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>First Name</th>
				  <th>Last Name</th>
				  <th>Username</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">1</th>
				  <td>Mark</td>
				  <td>Otto</td>
				  <td>@mdo</td>
				</tr>
				<tr>
				  <th scope="row">2</th>
				  <td>Jacob</td>
				  <td>Thornton</td>
				  <td>@fat</td>
				</tr>
				<tr>
				  <th scope="row">3</th>
				  <td>Larry</td>
				  <td>the Bird</td>
				  <td>@twitter</td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	  <div class="panel">
		<a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
		  <h4 class="panel-title">Collapsible Group Item #2</h4>
		</a>
		<div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
		  <div class="panel-body">
			<p><strong>Collapsible Item 2 data</strong>
			</p>
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
		  </div>
		</div>
	  </div>
	  <div class="panel">
		<a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
		  <h4 class="panel-title">Collapsible Group Item #3</h4>
		</a>
		<div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
		  <div class="panel-body">
			<p><strong>Collapsible Item 3 data</strong>
			</p>
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
		  </div>
		</div>
	  </div>
	</div>
	<!-- end of accordion -->
  
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
	  <a href=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?social=1'; ?> class="btn btn-primary">Kaufen (50.000 €)</a>
	</div>

  </div>
</div>
</div>