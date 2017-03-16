<?php

class Markt {
	
    public static function createMarktanalyse() {
        
    $sid = $_SESSION["SID"];
    $uid = $_SESSION["UID"];
    $runde = $_SESSION["Runde"];
        
    $query = "
    SELECT Marktanalyse
    FROM Rundendaten
    WHERE Runde = $runde AND UnternehmensID = $uid AND SpielID = $sid;
    ;";
    $marktanalyse = Database::sqlSelect($query);

    ?>

            <?php
            if($marktanalyse[0]["Marktanalyse"] == 1) {
              Markt::createViertel();
            }
            else {
              if($_GET['marktanalyse'] == 1) {  

              $unternehmensID = $_SESSION["UID"];
              $spielID = $_SESSION["SID"];
              $runde = $_SESSION["Runde"];

              $query = "
                UPDATE Rundendaten
                SET Marktanalyse = 1
                WHERE UnternehmensID = $unternehmensID AND SpielID = $spielID AND Runde = $runde
                ;";
                Database::sqlUpdate($query);
                API::addAusgabe(50000, "Marktforschung", "Social Intelligence Analysis");
                API::createBuchungsAufgabe("Sonstiges", "Bank", 50000, "Social Intelligence Analyse - Marktforschung");
                Markt::createViertel();

                $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
                ?>
                <script>
                window.location = <?php echo "'" . $actual_link . "?marktanalyse=1'";?>
                </script>
                <?php
              }
              else {
                ?>
                <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Marktanalyse <small>Immobilienmarkt Berlin 2017</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target=".bs-example-modal-lg">Marktanalyse in Auftrag geben</button>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
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
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                          <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?marktanalyse=1'; ?>" class="btn btn-primary">Kaufen (50.000 €)</a>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    <?php
    }
        

    public static function createViertel(){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
        $query = "SELECT * FROM Viertel WHERE Jahr = $runde";
        $viertel = Database::sqlSelect($query);
        
        for($i = 0; $i <= sizeof($viertel);$i++){
            $name[$i] = $viertel[$i]["Name"];
            $gentrifizierung[$i] = $viertel[$i]["Gentrifizierung"];
            $beliebtheit[$i] = $viertel[$i]["Beliebtheit"];
            $infrastruktur[$i] = $viertel[$i]["Infrastruktur"];
            $kriminalität[$i] = $viertel[$i]["Kriminalität"];
            $lebensstandart[$i] = $viertel[$i]["Lebensstandart"];
            $lage[$i] = $viertel[$i]["Lage"];
            $beschreibung[$i] = $viertel[$i]["Beschreibung"];
        }
        
        $query = "SELECT * FROM Viertelbeschreibung";
        $viertelbeschreibungTexte = Database::sqlSelect($query);
        
        $gentrifizierungsTexte;
        $beliebtheitsTexte;
        $infrastrukturTexte;
        $kriminalitätsTexte;
        $lebensstandartTexte;
        $lageTexte;
        
                
        for($i = 0; $i <= sizeof($viertel); $i++){
            
             //Gentrifizierung
            if($gentrifizierung[$i]==0){
                $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[0]["Beschreibung"];
            }
            if($gentrifizierung[$i]==1){
                $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[1]["Beschreibung"];
            }
            if($gentrifizierung[$i]==2){
                $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[2]["Beschreibung"];
            }
            if($gentrifizierung[$i]==3){
                $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[3]["Beschreibung"];
            }
            if($gentrifizierung[$i]==4){
                $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[4]["Beschreibung"];
            }
            
            //Beliebtheit
            if($beliebtheit[$i]==0){
                $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[5]["Beschreibung"];
            }
            if($beliebtheitsTexte[$i]==1){
                $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[6]["Beschreibung"];
            }
            if($beliebtheitsTexte[$i]==2){
                $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[7]["Beschreibung"];
            }
            if($beliebtheitsTexte[$i]==3){
                $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[8]["Beschreibung"];
            }
            if($gentrifizierung[$i]==4){
                $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[9]["Beschreibung"];
            }
            
            //Infrastruktur
            if($infrastruktur[$i]==0){
                $infrastrukturTexte[$i] = $viertelbeschreibungTexte[10]["Beschreibung"];
            }
            if($infrastruktur[$i]==1){
                $infrastrukturTexte[$i] = $viertelbeschreibungTexte[11]["Beschreibung"];
            }
            if($infrastruktur[$i]==2){
                $infrastrukturTexte[$i] = $viertelbeschreibungTexte[12]["Beschreibung"];
            }
            if($infrastruktur[$i]==3){
                $infrastrukturTexte[$i] = $viertelbeschreibungTexte[13]["Beschreibung"];
            }
            if($infrastruktur[$i]==4){
                $infrastrukturTexte[$i] = $viertelbeschreibungTexte[14]["Beschreibung"];
            }
            
            //Kriminalität
            if($kriminalität[$i]==0){
                $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[15]["Beschreibung"];
            }
            if($kriminalität[$i]==1){
                $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[16]["Beschreibung"];
            }
            if($kriminalität[$i]==2){
                $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[17]["Beschreibung"];
            }
            if($kriminalität[$i]==3){
                $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[18]["Beschreibung"];
            }
            if($kriminalität[$i]==4){
                $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[19]["Beschreibung"];
            }
            
            //Lebensstandart
            if($lebensstandart[$i]==0){
                $lebensstandartTexte[$i] = $viertelbeschreibungTexte[20]["Beschreibung"];
            }
            if($lebensstandart[$i]==1){
                $lebensstandartTexte[$i] = $viertelbeschreibungTexte[21]["Beschreibung"];
            }
            if($lebensstandart[$i]==2){
                $lebensstandartTexte[$i] = $viertelbeschreibungTexte[22]["Beschreibung"];
            }
            if($lebensstandart[$i]==3){
                $lebensstandartTexte[$i] = $viertelbeschreibungTexte[23]["Beschreibung"];
            }
            if($lebensstandart[$i]==4){
                $lebensstandartTexte[$i] = $viertelbeschreibungTexte[24]["Beschreibung"];
            }
            
            //Lage
            if($lage[$i]==0){
                $lageTexte[$i] = $viertelbeschreibungTexte[25]["Beschreibung"];
            }
            if($lage[$i]==1){
                $lageTexte[$i] = $viertelbeschreibungTexte[26]["Beschreibung"];
            }
            if($lage[$i]==2){
                $lageTexte[$i] = $viertelbeschreibungTexte[27]["Beschreibung"];
            }
            if($lage[$i]==3){
                $lageTexte[$i] = $viertelbeschreibungTexte[28]["Beschreibung"];
            }
            if($lage[$i]==4){
                $lageTexte[$i] = $viertelbeschreibungTexte[29]["Beschreibung"];
            }
            
         
  
        }
       

    ?>

            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:50px;">

                <div class="x_panel" style="margin-left:10px;">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Viertelübersicht <small> mit Kriterien</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3">
                      <ul class="nav nav-tabs tabs-left" style="overflow-x:hidden;height:550px">
                        <li class="active"><a href="<?php echo "#" . $name[0];?>" data-toggle="tab"><?php echo $name[0];?></a>
                        </li>
                        <?php
                            for($i = 1; $i <= 10;$i++){
                           
                        ?>
                            <li><a href="<?php echo "#" . $name[$i];?>" data-toggle="tab"><?php echo $name[$i];?></a>
                            </li>
                        <?php
                            }
                        ?>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="<?php echo $name[0];?>">
                        <div class="col-md-8">
                            <p class="lead"><?php echo $name[0];?></p>
                            <p><?php echo $beschreibung[0] . $gentrifizierungsTexte[0] . $beliebtheitsTexte[0] . $infrastrukturTexte[0] . $kriminalitätsTexte[0] . $lebensstandartTexte[0] . $lageTexte[0]; ?></p>
                        </div>
                        <div class="col-md-4">
                                <div class="x_panel">
                                      <div class="x_content">
                                           
                                          <ul class="verticle_bars list-inline">
                                                                      
                                            
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom">
                                                <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="<?php echo $gentrifizierung[0]*20 ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="<?php echo $beliebtheit[0]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="<?php echo $infrastruktur[0]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $kriminalität[0]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom" >
                                                <div class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="<?php echo $lebensstandart[0]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom">
                                                <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $lage[0]*20; ?>"></div>
                                              </div>
                                            </li>

                                          </ul>
                                           
                                        </div>
                                        <ul class="legend list-unstyled" >
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square dark"></i></span> <span class="name">Gentrifizierung: <?php echo $gentrifizierung[0];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square grey"></i></span> <span class="name">Beliebtheit: <?php echo $beliebtheit[0];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p>
                                              <span class="icon"><i class="fa fa-square blue"></i></span> <span class="name">Infrastruktur: <?php echo $infrastruktur[0];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square green"></i></span> <span class="name">Kriminalität: <?php echo $kriminalität[0];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square red"></i></span> <span class="name">Lebensstandart: <?php echo $lebensstandart[0];?></span>
                                            </p>
                                          </li>
                                         <li>
                                            <p><span class="icon"><i class="fa fa-square green"></i></span> <span class="name">Lage: <?php echo $lage[0];?></span>
                                            </p>
                                          </li>
                                        </ul>

                                </div>

                            </div>
                        </div>
                        <?php 
                            for($i = 1; $i <= 10;$i++){
                        ?>
                        <div class="tab-pane" id="<?php echo $name[$i];?>">
                            <div class="col-md-8">
                                <p class="lead"><?php echo $name[$i];?></p>
                                <p><?php echo $beschreibung[$i] . $gentrifizierungsTexte[$i] . $beliebtheitsTexte[$i] . $infrastrukturTexte[$i] . $kriminalitätsTexte[$i] . $lebensstandartTexte[$i] . $lageTexte[$i];?></p>
                            </div>
                            <div class="col-md-4">
                                <div class="x_panel">
                                      <div class="x_content">
                                          <ul class="verticle_bars list-inline">
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom">
                                                <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="<?php echo $gentrifizierung[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="<?php echo $beliebtheit[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="<?php echo $infrastruktur[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical  bottom">
                                                <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $kriminalität[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom" >
                                                <div class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="<?php echo $lebensstandart[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                            <li style="width:30px;">
                                              <div class="progress vertical bottom">
                                                <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $lage[$i]*20; ?>"></div>
                                              </div>
                                            </li>
                                          </ul>  
                                    </div>
                                    <ul class="legend list-unstyled" >
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square dark"></i></span> <span class="name">Gentrifizierung: <?php echo $gentrifizierung[$i];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square grey"></i></span> <span class="name">Beliebtheit: <?php echo $beliebtheit[$i];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p>
                                              <span class="icon"><i class="fa fa-square blue"></i></span> <span class="name">Infrastruktur: <?php echo $infrastruktur[$i];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square green"></i></span> <span class="name">Kriminalität: <?php echo $kriminalität[$i];?></span>
                                            </p>
                                          </li>
                                          <li>
                                            <p><span class="icon"><i class="fa fa-square red"></i></span> <span class="name">Lebensstandart: <?php echo $lebensstandart[$i];?></span>
                                            </p>
                                          </li>
                                         <li>
                                            <p><span class="icon"><i class="fa fa-square green"></i></span> <span class="name">Lage: <?php echo $lage[$i];?></span>
                                            </p>
                                          </li>
                                    </ul>
                                </div>
                            </div>
                        </div>                         

                        <?php
                            }
                        ?>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
                
                                
                <?php 
                    Markt::createTipp();
                    Markt::createDownload();
                ?>
                
              </div>

    <?php
    }
    
    public static function createDownload(){
         
    ?>
        <div class="col-md-4">
        <div class="x_panel" >
          <div class="x_title">
            <h2>Ratgeber <small>Immobilienwirtschaft</small></h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <ul class="list-unstyled msg_list">

            <?php

            $downloadDirectory = "http://" . $_SERVER["HTTP_HOST"] . "" . $_SERVER["PHP_SELF"];
            $url = rtrim($downloadDirectory, "/markt.php");
            $mLink = Request::getDownloadLink("Markt");
            $mFile = $mLink[0]["URL"];
            $martkURL = $url . "a" . $mFile;
            
            ?>

            <a href=<?php echo "'" . $martkURL . "'";"" ?> class="btn btn-primary btn-success col-md-12">Ratgeber Immobilien</a>

            </ul>
          </div>
        </div>
      </div>
    <?php
    }
   
    public static function createTipp(){
        
        $sid = $_SESSION["SID"];
        $uid = $_SESSION["UID"];
        $runde = $_SESSION["Runde"];
        
        $query = "SELECT Tipp FROM Marktanalyse WHERE Runde = $runde";
        $tipp = Database::sqlSelect($query);

        ?>
               
            <div class="col-md-8 col-lg-8 col-sm-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Geheimtipp <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-8 col-lg-8 col-sm-8">
                      <!-- blockquote -->
                      <blockquote>
                        <p><?php echo $tipp[0]['Tipp'];?></p>

                      </blockquote>
                  </div>
                 </div>
                </div>
                </div>
                
                            
        <?php
    }
        
    
}

?>

                
<!--

TO BE CONTINUED

        //Gentrifizierung
            for($j = 0;$j <= 4;$j++){
                if($gentrifizierung[$i]==$j){
                    $gentrifizierungsTexte[$i] = $viertelbeschreibungTexte[$j]["Beschreibung"];
                    var_dump($gentrifizierung[$i]) . $i;
                }
            }

            //Beliebtheit
            for($k = 5;$k <= 9;$k++){
                if($beliebtheit[$i]==$k){
                    $beliebtheitsTexte[$i] = $viertelbeschreibungTexte[$k]["Beschreibung"];

                }
            }
            
            //Infrastruktur
            for($j = 10;$j <= 14;$j++){
                if($infrastruktur[$i]==$j){
                    $infrastrukturTexte[$i] = $viertelbeschreibungTexte[$j]["Beschreibung"];

                }
            }
            
            //Kriminalität
            for($j = 15;$j <= 19;$j++){
                if($kriminalität[$i]==$j){
                    $kriminalitätsTexte[$i] = $viertelbeschreibungTexte[$j]["Beschreibung"];

                }
            }
            
            //Lebensstandart
            for($j = 20;$j <= 24;$j++){
                if($lebensstandart[$i]==$j){
                    $lebensstandartTexte[$i] = $viertelbeschreibungTexte[$j]["Beschreibung"];

                }
            }
            
            //Lage
            for($j = 24;$j <= 28;$j++){
                if($lage[$i]==$j){
                    $lageTexte[$i] = $viertelbeschreibungTexte[$j]["Beschreibung"];

                }
            }
-->