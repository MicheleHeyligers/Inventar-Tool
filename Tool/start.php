<?php 
    SESSION_START();
    // including head
    require('head.php');
?>

<body>

    <!-- ======================================
    *************** Preloader *****************
    ======================================= -->
    <div class="matmin-preloader">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================
    ******* Main Wrapper Area Start **********
    ======================================= -->
    <div class="main-wrapper" id="mainWrapper">

        <!-- ====== Header Area Start ====== -->
        <?php
            include('header.php');
        ?>
        <!-- ====== Header Area End ====== -->

        <!-- ==================================
        ******* Page Wrapper Area Start *******
        =================================== -->
        <div class="page-wrapper d-flex clearfix">

            <!-- ====== Left Sidebar Area Start ====== -->
                <?php
                    require('leftSidebar.php');
                ?>
            <!-- ====== Left Sidebar Area End ====== -->

            <!-- ====== Page Content Area Start ====== -->
            <div class="page-content">
                <!-- Wrapper -->
                <div class="wrapper wrapper-content">
                    <div class="container-fluid">
                        <div class="row justify-content-center">                        
                           <div class="col-12 col-lg-5">
                              <div class="card-wizard-index mb-30">
                                    <div class="p-3 bg-smile">
                                        <div class="mb-4">
                                            <div class="float-right text-right">
                                                
                                            </div>
                                            <span class="peity-pie" data-peity="{ &quot;fill&quot;: [&quot;rgba(255, 255, 255, 0.8)&quot;, &quot;rgba(255, 255, 255, 0.2)&quot;]}" data-width="54" data-height="54" style="display: none;">5/8</span>
                                            <svg class="peity" height="54" width="54">
                                                <path d="M 27 0 A 27 27 0 1 1 7.908116907963219 46.09188309203678 L 27 27" data-value="5" fill="rgba(255, 255, 255, 0.8)"></path>
                                                <path d="M 7.908116907963219 46.09188309203678 A 27 27 0 0 1 26.999999999999996 0 L 27 27" data-value="3" fill="rgba(255, 255, 255, 0.2)"></path>
                                            </svg>
                                            <!-- <i class="fa fa-user fa-3x"></i> 'User-icon' -->
                                        </div>
                                    </div>
                                    <div class="ml-3 mr-3">
                                        <div class="bg-white p-3 wizard-stats-desc rounded">
                                            <h5 class="float-right mt-0">
                                                <?php
                                                error_reporting (E_ALL|E_STRICT);

                                                require 'settings.php';
                                                include 'db_connection.php';

                                                $sql= "SELECT Firma FROM kunde";
                                                mysqli_query($con, "SET NAMES utf8");
                                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                                $dsnumber = mysqli_num_rows($result);
                                                print_r($dsnumber); 
                                                mysqli_close($con);      
                                                ?>
                                            </h5>
                                            <h6 class="mt-0 mb-0">Kunden</h6>
                                            <p class="mb-0">aktuell gesamt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5">
                                <div class="card-wizard-index mb-30">
                                    <div class="p-3 bg-smile">
                                        <div class="mb-4">
                                            <div class="float-right text-right">        
                                            </div>
                                            <span class="peity-pie" data-peity="{ &quot;fill&quot;: [&quot;rgba(255, 255, 255, 0.8)&quot;, &quot;rgba(255, 255, 255, 0.2)&quot;]}" data-width="54" data-height="54" style="display: none;">5/8</span>
                                            <svg class="peity" height="54" width="54">
                                                <path d="M 27 0 A 27 27 0 1 1 7.908116907963219 46.09188309203678 L 27 27" data-value="5" fill="rgba(255, 255, 255, 0.8)"></path>
                                                <path d="M 7.908116907963219 46.09188309203678 A 27 27 0 0 1 26.999999999999996 0 L 27 27" data-value="3" fill="rgba(255, 255, 255, 0.2)"></path>
                                            </svg>
                                            <!-- <i class="fa fa-shield fa-3x"></i> 'Schild-Icon'-->
                                        </div>
                                    </div>
                                    <div class="ml-3 mr-3">
                                        <div class="bg-white p-3 wizard-stats-desc rounded">
                                            <h5 class="float-right mt-0">
                                                <?php
                                                    error_reporting (E_ALL|E_STRICT);

                                                    require 'settings.php';
                                                    include 'db_connection.php';

                                                    $sql= "SELECT Bezeichnung FROM geraet";
                                                    mysqli_query($con, "SET NAMES utf8");
                                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                                    $dsnumber = mysqli_num_rows($result);
                                                    print_r($dsnumber);  
                                                    mysqli_close($con);     
                                                ?> 
                                            </h5>
                                            <h6 class="mt-0 mb-0">Geräte</h6>
                                            <p class="mb-0">aktuell gesamt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">                        
                           <div class="col-12 col-lg-8">
                                <div class="box box-info bg-boxshadow mb-30">
                                    <div class="box-body">
                                        <div>
                                            <div class="box-header mb-30">
                                                <h6 class="box-title mb-3">Herzlich willkommen im Inventar-Tool der Firma ZerBITS GmbH</h6>
                                                <div><strong>Sie sind als <?php echo $_GET["vorname"], " ", $_GET["nachname"];?> angemeldet.</strong><br/>
                                                    <p></p>
                                                </div>      
                                                <div>
                                                   Links in der Navigationsleiste finden Sie die Auswahlmöglichkeiten, um sich die Geräte 
                                                   der Kunden oder die Geräte nach Geräteart sortiert anzeigen zu lassen.
                                                   Des Weiteren haben Sie die Möglichkeit über den 'Sandwich-Toggle' das Menü ein- und 
                                                   auszuklappen. 
                                                   Zum Logout bitte rechts oben klicken.
                                                </div> 
                                                <?php
                                                $_SESSION["vorname"] = $_GET["vorname"];
                                                $_SESSION["nachname"] = $_GET["nachname"];
                                                // Kontrollausgabe 
                                                /*var_dump($_SESSION["vorname"]);
                                                var_dump($_SESSION["nachname"]);*/
                                                ?>                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <!-- ====== Page Content Area End ====== -->
        </div>
        <!-- ==================================
        ******* Page Wrapper Area End *******
        =================================== -->
        
        <?php 
            //including footer
            require('footer.php');
        ?>

    </div>
    <!-- ======================================
    ********* Main Wrapper Area End ***********
    ======================================= -->

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
    <!-- 'settings.js' for 'settingsPanel.php'(Veränderung der Oberfläche während des Betriebs)-->
    <script src="js/settings.js"></script>    
</body>

</html>