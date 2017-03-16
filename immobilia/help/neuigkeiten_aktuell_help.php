<!--<button type="button" class="btn btn-primary col-md-12"  >Marktanalyse in Auftrag geben</button>
-->

<?php 
	$targetvariable = 'bs-help-aktuell-modal-lg';
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
	  <h4 class="modal-title" id="myModalLabel">Hilfe</h4>
	</div>
	<div class="modal-body">
	
	<h5>Neuigkeiten</h5>
	  <p>In den Neuigkeiten findest du aktuelle Nachrichten und Markt geschehnisse.</p>
	  <p>Man findet auch mal sehr relevante Nachrichten, die dir helfen könnten.</p>
	
	<!-- start accordion 
	<div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
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
	</div>
	<!-- end of accordion -->
  
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
	</div>

  </div>
</div>
</div>