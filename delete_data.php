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
                                                <h5 class="box-title mb-3">Inventarliste</h5>
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
                            <div class="col-lg-12">
                                <div class="ibox bg-boxshadow mb-30">
                                        <h5 class="mb-30">Bitte zu löschenden Datensatz auswählen:</h5>
                                        <div class="ibox-content">
                                            <!-- Table Responsive -->
                                            <div class="table-responsive">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">   
                                                    <?php 
                                                    echo "<table class='table table-striped table-bordered dataTable' id='DataTables_Tables_0' aria-describedby='DataTables_Table_0_info' role='grid'>";

                                                        error_reporting (E_ALL|E_STRICT);

                                                        require 'settings.php';
                                                        include_once 'db_connection.php';

                                                        // check customer
                                                        if(isset($_GET["custname"])){  
                                                            $customername = $_GET["custname"];    
                                                            if(!empty($customername)){
                                                                 
                                                                $sql  = "SELECT geraet.Bezeichnung, geraetetyp.geraeteart AS 'Geräteart', geraet.CPU, geraet.HDD_SSD_Kapazitaet AS 'Festplattenspeicher', geraet.RAM, geraet.Seriennr, geraet.BS, geraet.Anschaffung 
                                                                        FROM geraet, kunde, geraetetyp
                                                                        WHERE kunde.Kunden_ID = geraet.Kunden_ID AND geraetetyp.Typ_ID = geraet.Typ_ID AND kunde.Firma ='".$customername."'";

                                                                mysqli_query($con, "SET NAMES utf8");
                                                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                                                $ds = mysqli_fetch_assoc($result);
                                                                $dsnumber = mysqli_num_rows($result);

                                                                // check if data exists
                                                                if ($dsnumber >0){
                                                                    echo"<thead><tr><th>Aktion</th>";
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";
                                                                    }
                                                                    echo "</tr></thead>";

                                                                    mysqli_data_seek($result, 0);

                                                                    echo "<tbody>";
                                                                    for($i = 0; $i < $dsnumber; $i++){
                                                                        $dsitems = mysqli_fetch_row($result); 
                                                                        $seriennr = $dsitems[5]; // 'Seriennr' to identify data to delete
                                                                        echo "<tr><td><a href='delete_data2.php?custname={$customername}&seriennr={$seriennr}' title='Daten werden endgültig gelöscht!!'><i class='icon_trash_alt' style='font-size: 1.4em; color:#DF0101' ></i></a></td>"; 
                                                                        foreach($dsitems as $value){
                                                                                echo "<td>".$value."</td>";      
                                                                        }
                                                                        echo "</tr>"; 
                                                                    }
                                                                    echo "</tbody>";

                                                                    echo"<tfoot><tr><th>Aktion</th>";
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";
                                                                    }
                                                                    echo "</tr></tfoot>";
                                                                    mysqli_close($con); 
                                                                }
                                                                else {
                                                                    echo "Keine Datensätze vorhanden!";
                                                                }
                                                            }    
                                                        }    
                                                    echo "</table>";                                   
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
    
    <!-- plugins for data-table -->
    <script src="js/plugins-js/data-table-js/data-table.bootstrap.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table-active.js"></script>
</body>

</html>
