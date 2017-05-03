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
      
        <?php

        Abschluss::createChecklist();

        ?>
      
    </div>
  </div>
  <!-- /page content -->
    
<?php 
  Menu::createFooter();
?>