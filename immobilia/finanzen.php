<?php  
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("Jahresabschluss"); 
?>
	
	<!-- page content -->
	<div class="right_col" role="main">
		
	<?php

    if(isset($_GET["credit"])) {
      if($_GET["credit"] == 1) {
        Helper::showMessage("Kreditantrag genehmigt", "Dein Kreditantrag wurde akzeptiert!", "success");
      }
      else {
        Helper::showMessage("Kreditantrag abgelehnt", "Dein Kreditantrag wurde leider nicht angenommen!", "error");
      }
    }

		$width = 4;

    $rundendaten = Request::getRundendaten();

    Finanzen::createFinanzenTopData(sizeof($rundendaten));
    Finanzen::createBankview(sizeof($rundendaten));
    Finanzen::createEinnahmenliste(sizeof($rundendaten));
    Finanzen::createAusgabenliste(sizeof($rundendaten));

	?>
	</div>


	<!-- /page content -->

	<script>
	$(document).ready(function() {
		Chart.defaults.global.legend = {
        enabled: false
      };

      // Line chart
      var ctx = document.getElementById("kontostand");
      var lineChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo "'" . date('Y') . "'"; ?>, <?php echo "'" . date('Y', strtotime("+1 year")) . "'"; ?>, <?php echo "'" . date('Y', strtotime("+2 years")) . "'"; ?>, <?php echo "'" . date('Y', strtotime("+3 years")) . "'"; ?>, <?php echo "'" . date('Y', strtotime("+4 years")) . "'"; ?>],
          datasets: [{
            label: "Kontostand",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [ <?php if(sizeof($rundendaten > 0)) { echo $rundendaten[0]["Kapital"];}else { echo "0"; } ?>, <?php if(sizeof($rundendaten > 1)) { echo $rundendaten[1]["Kapital"];}else { echo "0"; } ?>, <?php if(sizeof($rundendaten > 2)) { echo $rundendaten[2]["Kapital"];}else { echo "0"; } ?>, <?php if(sizeof($rundendaten > 3)) { echo $rundendaten[3]["Kapital"];}else { echo "0"; } ?>, <?php if(sizeof($rundendaten > 4)) { echo $rundendaten[4]["Kapital"];}else { echo "0"; } ?>]
          }/*, {
            label: "My Second dataset",
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: [82, 23, 66, 9, 99, 4, 2]

            <?php // if(sizeof($rundendaten > 0)) { echo $rundendaten[0]["Kapital"];}else { echo "0"; } ?>
          }*/]
        },
      });
	})
      
      </script>

		
<?php 
	Menu::createFooter(); 
?>