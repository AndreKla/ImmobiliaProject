<?php session_start();

    require_once("includes.php");
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Immobilia! | Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <?php   include('includes_css.php'); ?>
  </head>

  <body class="login">
  
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="login.php" method="POST">
              <h1>Einloggen</h1>
              <div>
                <input type="text" class="form-control" placeholder="Benutzername" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Passwort" name="password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Einloggen</a></button>
                <a class="reset_pass" href="#">Passwort vergessen?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link"><!--Noch keinen Account?
                  <!--<a href="#signup" class="to_register"> Jetzt Account anfordern! </a>-->
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-home"></i> Immobilia - Planspiel</h1>
                  <p>© 2016 Immobilia All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Einloggen </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Immobilia</h1>
                  <p>© 2016 Immobilia All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <?php

    $errormessage = "";
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        require_once("includes.php");
        
        Database::databaseConnect();
        
        $query = "
        SELECT *
        FROM Unternehmen
        WHERE Nutzername = '$username'
        ;";
        $user = Database::sqlSelect($query);
        
        if(sizeof($user) == 0) {
          ?>
            <script>
                  $(document).ready(function() {
                    new PNotify({
                        title: 'Login fehlgeschlagen',
                        text: 'Leider wurde der Benutzername nicht gefunden!',
                        type: 'fail',
                        styling: 'bootstrap3'
                    });
                  });
                </script>
          <?php
        }
        else {
            
            if($user[0]["Passwort"] == md5($password)) {
                
                $_SESSION["UID"] = $user[0]["ID"];
                $_SESSION["SID"] = $user[0]["SID"];

                
                ?>

                    <script language="javascript">
                        window.location.href = "index.php"
                    </script>

                <?php

                
                
            }
            else {
                ?>
                <script>
                  $(document).ready(function() {
                    new PNotify({
                        title: 'Login fehlgeschlagen',
                        text: 'Leider ist das Passwort falsch!',
                        type: 'fail',
                        styling: 'bootstrap3'
                    });
                  });
                </script>
                <?php
            }
            
        }
        
    }

?>
<?php include 'includes_js.php'; ?> 
  </body>
</html>

