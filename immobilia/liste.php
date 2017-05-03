<?php
    
    session_start();
    
    require_once("includes.php"); 
    
    Menu::createMenu("Immobilienliste"); 

    if(isset($_GET['immokauf'])) {

        API::buyImmobilie($_GET['immokauf']);

    }
    
?>

    <div class="right_col" role="main" style="padding-bottom:55px;">

        <?php

        Liste::createListe();
        
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            
            ?>
            <script>
                
                //var divPosition = $('<?php echo "#". $id; ?>').offset();
                
                //$('html, body').animate({scrollTop: divPosition.top}, "slow");
                
                location.hash = '<?php echo "#". $id; ?>';
                //document.getElementById('<?php echo "#". $id; ?>').scrollIntoView()
            </script>
        <?php
        }
        ?>

    </div>

<?php 
  Menu::createFooter(); 
?>
