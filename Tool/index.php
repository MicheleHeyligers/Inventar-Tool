<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Colors">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Inventartool ZerBITS GmbH</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Master Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/loginTitle.css">
</head>

<body>
    <?php
        SESSION_START();
        error_reporting (E_ALL|E_STRICT);
        // DB-Connection
        require 'settings2.php';
        $con = mysqli_connect($servername, $username, $password, $daba);

        if(!$con){
            die("Connection failed: ".mysqli_connect_error());
        }

        // überprüfen, ob 'submit'-Button geklickt wurde
        if(isset($_POST["submitButton"])){
            $_SESSION["login"]=0;
            $username = mysqli_real_escape_string($con, $_POST["username"]); 
            $password = mysqli_real_escape_string($con, $_POST["password"]);
            
            $sql = "SELECT * FROM benutzer WHERE username='".$username."' AND passwort='".$password."' AND user_geloescht=0 LIMIT 1";

            mysqli_query($con, "SET NAMES utf8");

            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            // Anzahl der Datensätze zur Überprüfung, ob es einen gültigen Benutzereintrag gibt
            $dsnumber = mysqli_num_rows($result);
            if($dsnumber > 0){
                // login war erfolgreich, Session-Variable setzen
                $_SESSION["login"] = 1;
                $_SESSION["user"] = mysqli_fetch_assoc($result);
                
                // last_login in DB schreiben
                $sql = "UPDATE benutzer SET last_login = NOW() WHERE user_id= '".$_SESSION['user']['user_id']."'";
                mysqli_query($con, $sql);
            }
            else{
                echo "<script type='text/javascript'>alert('Die login-Daten sind nicht korrekt!');</script>";
            }
             //ist Session-Variable für login gesetzt; ist der User Mitarbeiter(typ_id=1) oder Kunde(typ_id=2)?
            if($_SESSION["login"] == 1){
                mysqli_close($con);
                if($_SESSION["user"]["typ_id"] == 1){
                    $vorname = $_SESSION["user"]["vorname"];
                    $nachname = $_SESSION["user"]["nachname"];
                    echo "<script type='text/javascript'>window.location='start.php?vorname={$vorname}&nachname={$nachname}'</script>";
                }
                else if($_SESSION["user"]["typ_id"] == 2){
                    $firma = $_SESSION["user"]["firma"];
                    echo "<script type='text/javascript'>window.location='show_data_customer.php?firma={$firma}'</script>"; 
                }    
            }
            mysqli_close($con);
        }     
    ?>
    <!-- Login -->
    <div class="wrapper wrapper-content--- overflow-hidden">
        <div class="container-login">
            <div id="loginTitle">ZerBITS GmbH Inventartool</div>
            <div class="card-area--  bg-primary" style="background-color:#409fc4 !important">            
                <h1 class="title" style="border:none; color: #fff">Login</h1>
                <form action="" method="POST">
                    <div class="input-container">
                        <input type="text" name="username" id="req" required="required" />
                        <label for="req">Username</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="password" id="pass" name="password" required="required" />
                        <label for="pass">Passwort</label>
                        <div class="bar"></div>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="submitButton"><span>Einloggen</span></button>
                    </div>
                    <div class="footer"><a class="text-white" href="forgotten_password.php">Passwort vergessen?</a></div>
                </form>
            </div>
        </div>
    </div>

    <!-- ======== Must needed plugins to the run this template ======= -->
    <script src="assets/js/jquery/jquery.2.2.4.min.js"></script>
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins-js/menu-active.js"></script>
    <script src="js/plugins-js/plugins-js/materialize.js"></script>
    <script src="js/box-switch.js"></script>
    <script src="js/fullscreen.js"></script>
    <script src="js/nicescroll.min.js"></script>
    <script src="js/active.js"></script>
</body>

</html>