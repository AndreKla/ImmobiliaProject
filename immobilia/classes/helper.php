<?php

class Helper {

	
	/**
	 * Creates Header.
	 * 
	 * @param -
	 * @return String
	 */
	public static function createHeader() {
    
    	Database::databaseConnect();
    
    	$uid = $_SESSION["uid"];

    	$query = "
            SELECT U_Image
            FROM ESM_Users
            WHERE U_ID = '$uid'
            ;";
            $user = Database::sqlSelect($query);
            
        if(sizeof($user) == 1) {
        	$image = $user[0]["U_Image"];
        }

        ?>

        <!DOCTYPE html>
		<html lang="en">

		<head>

    		<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
		    <meta name="description" content="">
		    <meta name="author" content="">

		    <title>Immobilienmanagement</title>

		    <script type="text/javascript" src="TableSort.js"></script>
		    <script src="js/sorttable.js"></script>

		    <!-- Bootstrap Core CSS -->
		    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

		    <!-- MetisMenu CSS -->
		    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

		    <!-- Timeline CSS -->
		    <link href="dist/css/timeline.css" rel="stylesheet">

		    <!-- Custom CSS -->
		    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

		    <!-- Morris Charts CSS -->
		    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

		    <!-- Custom Fonts -->
		    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		    <link href="details.css" rel="stylesheet">

		</head>

		<body>

    		<div id="wrapper">

	        <!-- Navigation -->
	        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="estates.php">Immobilienmanagement</a>
	            </div>
            <!-- /.navbar-header -->


	            <div class="navbar-default sidebar" role="navigation">
	                <div class="sidebar-nav navbar-collapse">
	                    <ul class="nav" id="side-menu">
	                        <li class="sidebar-search">
	                            <div class="input-group custom-search-form">
	                                <img src=<?php echo "\"$image\"";?> width="220px" height="250px">
	                            </div>
	                            <!-- /input-group -->
	                        </li>
	                        <li>
	                            <a href="estates.php"><i class="fa fa-building-o fa-fw"></i> Immobilien</a>
	                        </li>
	                        <li>
	                            <a href="map.php"><i class="fa fa-map-marker fa-fw"></i> Karte</a>
	                        </li>
	                        <li>
	                            <a href="add_edit.php"><i class="fa fa-edit fa-fw"></i> Immobilie hinzufügen</a>
	                        </li>
	                        <li>
	                            <a href="charts.php"><i class="fa fa-bar-chart fa-fw"></i> Analyse</a>
	                        </li>
							<li>
	                            <a href="info.php"><i class="fa fa-info fa-fw"></i> Benutzer Informationen</a>
	                        </li>
	                        <li>
	                        <a href="kontakt.php"><i class="fa fa-envelope-o fa-fw"></i> Hilfe & Kontakt</a>
	                        </li>
	                        <li>
	                        <a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a>
	                        </li>
	                    </ul>
	                </div>
	                <!-- /.sidebar-collapse -->
	            </div>
	            <!-- /.navbar-static-side -->
	        </nav>

        <?php
        
	}


	/**
	 * Creates Footer.
	 * 
	 * @param -
	 * @return String
	 */
	public static function createFooter() {
		?>
				</div>
		        <!-- /#wrapper -->

		        <!-- jQuery -->
		        <script src="bower_components/jquery/dist/jquery.min.js"></script>

		        <!-- Bootstrap Core JavaScript -->
		        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

		        <!-- Metis Menu Plugin JavaScript -->
		        <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

		        <!-- Morris Charts JavaScript -->
		        <script src="bower_components/raphael/raphael-min.js"></script>
		        <script src="bower_components/morrisjs/morris.min.js"></script>

		        <!-- Custom Theme JavaScript -->
		        <script src="dist/js/sb-admin-2.js"></script>
		        
		    	<script src="details.js"></script>
    		</body>

		</html>
		<?php
	}


	/**
	 * Checks if the user is logged in.
	 * 
	 * @param -
	 * @return String
	 */
	public static function checkLogin() {
		
		if(!isset($_SESSION["uid"])) {
        ?>
            <script language="javascript">
                window.location.href = "login.php"
            </script>
        <?php
    	}

	}
	
}

?>
