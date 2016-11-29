<?php

class SocialFeed {

public static function createFeed() {
	
	$anzahlGewählteZiele = 0;

    $query = "
    SELECT *
    FROM SocialFeed
    ;";
    $feed = Database::sqlSelect($query);
?>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Social Feed <small>von Facebook</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
				  <?php 
					for($i = 0; $i < sizeof($feed); $i++) {
							
				  ?>
                    <li>
                      <a>
                        <span class="image">
                          <img src="<?php echo $feed[$i]["Bild"];?>" alt="img" />
                        </span>
                        <span>
                          <span><?php echo $feed[$i]["Titel"];?></span>
                          <span class="time"><?php echo $feed[$i]["Zeitpunkt"];?></span>
                        </span>
                        <span class="message">
                          <?php echo $feed[$i]["Beschreibung"];?>
                        </span>
                      </a>
                    </li>
					<?php 
						}
					?>
                  </ul>
                </div>
              </div>
            </div>
<?php
}}
?>