<?php 
    SESSION_START();
    // including head
    require('head.php');
?>

<body>

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
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="box box-info bg-boxshadow mb-30">
                                    <div class="box-body">
                                        <div>
                                            <div class="box-header mb-30">
                                                <h5 class="box-title mb-3">Datensatz anlegen</h5>
                                                <?php 
                                                    // check variables
                                                    if(isset($_GET["custname"])){  
                                                        $customername = $_GET["custname"];
                                                        if(!empty($customername)){
                                                            echo "<p>Kunde: {$customername} </p>";
                                                            echo "<p id='sql_check'></p>";
                                                        }
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="box box-info bg-boxshadow mb-30">
                                    <div class="box-body">
                                        <div>
                                            <div class="box-header mb-30">
                                                <h5 class="box-title mb-3">Auswahl</h5>
                                                <?php 
                                                    $customername=$_GET["custname"];
                                                    $vorname = $_SESSION["vorname"];
                                                    $nachname = $_SESSION["nachname"];
                                                    echo "<div>                                                    
                                                            <a href='start.php?vorname={$vorname}&nachname={$nachname}' class='btn waves-effect m-2 btn-secondary'>zurück zur Startseite</a>
                                                            <a href='show_data.php?customer={$customername}' class='btn waves-effect m-2 btn-secondary'>zurück zur Datenanzeige</a>
                                                          </div>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">                               
                            <div class="col-12">
                                <div class="ibox wizard bg-boxshadow mb-30">
                                    <h5 class="mb-30">Dateneingabe</h5>
                                    <div class="ibox-content p-0">
                                        <form id="form" action="" method="post">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="kundenname" name="cname" type="text" value="<?php $customername=$_GET["custname"]; echo $customername;?>" class="validate">
                                                        <label for="kundenname">Kundenname </label>
                                                        <div></div>
                                                    </div>
                                                </div>                                                   
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="Bezeichnung" name="devicename" type="text" class="validate">
                                                        <label for="Bezeichnung">Bezeichnung</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="typ" name="devicetyp" type="text" class="validate">
                                                        <label for="typ">Gerätetyp</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="CPU" name="cpu" type="text" class="validate">
                                                        <label for="CPU">CPU</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="hdd" name="hdd" type="text" class="validate">
                                                        <label for="hdd">HDD_SSD_Kapazität</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="ram" name="ram" type="text" class="validate">
                                                        <label for="ram">RAM</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="seriennr" name="sernr" type="text" class="validate">
                                                        <label for="seriennr">Seriennr.</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="bs" name="os" type="text" class="validate">
                                                        <label for="bs">Betriebssystem</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="tv" name="tv" type="text" class="validate">
                                                        <label for="tv">TeamViewer</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col-12">
                                                        <input id="anschaffung" name="startdate" type="date" class="validate">
                                                        <label for="anschaffung">Anschaffungsdatum</label>
                                                    </div>
                                                </div>                                               
                                                <div>
                                                    <div class="col-12">
                                                        <div class="wizard-sign-button">
                                                            <button type="submit" name ="submit" class="btn waves-effect mt-15" style="background-color: #409fc4">Datensatz speichern</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Page Content Area End ====== -->
            <?php
                if(isset($_POST['submit'])){
                    error_reporting(E_ALL|E_STRICT);

                    require 'settings.php';
                    include_once 'db_connection.php';

                    //input values
                    $cname = mysqli_real_escape_string($con, $_POST['cname']);
                    $devicename = mysqli_real_escape_string($con, $_POST['devicename']);
                    $devicetyp = mysqli_real_escape_string($con, $_POST['devicetyp']);
                    $cpu = mysqli_real_escape_string($con, $_POST['cpu']);
                    $hdd = mysqli_real_escape_string($con, $_POST['hdd']);
                    $ram = mysqli_real_escape_string($con, $_POST['ram']);
                    $sernr = mysqli_real_escape_string($con, $_POST['sernr']);
                    $os = mysqli_real_escape_string($con, $_POST['os']);
                    $tv = mysqli_real_escape_string($con, $_POST['tv']);
                    $startdate = mysqli_real_escape_string($con, $_POST['startdate']);

                    $sql = "INSERT INTO geraet (Kunden_ID, Bezeichnung, Typ_ID, CPU, HDD_SSD_Kapazitaet, RAM, Seriennr, BS, TeamViewer, Anschaffung) 
                            VALUES ((SELECT Kunden_ID FROM kunde WHERE Firma ='".$cname."'),'".$devicename."', 
                                    (SELECT Typ_ID FROM geraetetyp WHERE geraeteart ='".$devicetyp."'), '".$cpu."', '".$hdd."', '".$ram."','".$sernr."','".$os."', '".$tv."', '".$startdate."')";

                    mysqli_query($con, "SET NAMES utf8");
                    mysqli_query($con, $sql);

                    // check sql-query-result
                    $num = mysqli_affected_rows($con);
                    if($num > 0){
                        echo "<script>
                              document.getElementById('sql_check').style.color = '#088A08';
                              document.getElementById('sql_check').style.fontWeight = 'bold';
                              document.getElementById('sql_check').innerHTML ='Datensatz wurde gespeichert.';
                              </script>";
                    }
                    else {
                        echo "<script>
                             document.getElementById('sql_check').style.color = '#B40404';
                             document.getElementById('sql_check').style.fontWeight = 'bold';
                             document.getElementById('sql_check').innerHTML ='Fehler im SQL-Statement, Daten wurden nicht gespeichert!';
                             </script>";
                    }
                    
                    mysqli_close($con);
                }
            ?>
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
    <script src="js/plugins-js/plugins-js/jquery.nice-select.min.js"></script>
    <script src="js/fullscreen.js"></script>
    <script src="js/nicescroll.min.js"></script>
    <script src="js/active.js"></script>
    <!-- 'settings.js' für Einschubpanel rechts (Veränderung der Oberfläche während des Betriebs)-->
    <script src="js/settings.js"></script>

    <!-- plugins for data-table-->
    <script src="js/plugins-js/data-table-js/data-table.bootstrap.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table-active.js"></script>

    <script>
        function checkValue(element) {
            // check if the input has any value (if we've typed into it)
            if ($(element).val())
                $(element).addClass('has-value');
            else
                $(element).removeClass('has-value');
        }

        $(document).ready(function() {
            // Run on page load
            $('.form-control').each(function() {
                checkValue(this);
            })
            // Run on input exit
            $('.form-control').blur(function() {
                checkValue(this);
            });

        });
    </script>
</body>

</html>
