<?php session_start();
    require_once("includes.php"); 
  Menu::createMenu("Übersicht"); 

  if(isset($_GET["startprocessing"])) {
    if($_GET["startprocessing"] == 1) {
      ?>
      <script language="javascript">
        window.location.href = "processing.php"
      </script>
      <?php
    }
  }

?>    
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Jahresabschluss <small>Geschäftsjahr abschließen</small></h2>
          <div class="clearfix"></div>
        </div>
        <?php

        Abschluss::createChecklist();

        ?>
      </div>
    </div>
  </div>
  <!-- /page content -->
    
<?php 
  Menu::createFooter();
?>