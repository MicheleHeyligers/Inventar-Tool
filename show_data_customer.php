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
            <div class="left-sidebar-area">
                <!-- Side Menu Area -->
                <div class="side-menu-area">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="menu-title" style="font-size:1.1em">
                            <h5 style="font-weight:700;text-transform:uppercase;padding:0px;color: #fff;">Übersicht</h5>
                        </li>
                        <li class="treeview">
                            <a href="javascript:void(0)" class="waves-effect waves-light">
                                <i class="icon_desktop"></i>
                                <span>Geräteauswahl</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="a" id="1" href=""> Rechner </a></li>
                                <li><a class="a" id="2" href=""> Laptop </a></li>
                                <li><a class="a" id="3" href=""> Monitor </a></li>
                                <li><a class="a" id="4" href=""> Drucker </a></li>
                                <li><a class="a" id="5" href=""> Server </a></li>
                                <li><a class="a" id="6" href=""> NAS </a></li>
                                <li><a class="a" id="7" href=""> keine Angabe</a></li>            
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
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
                                                <h5 id ="eins" class="box-title mb-3">Inventarliste</h5>
                                                <?php 
                                                    // Variablen abfragen
                                                    if(isset($_GET["firma"])){  
                                                        $customername = $_GET["firma"];
                                                        echo '<script>
                                                                var elem = document.getElementsByClassName("a");
                                                                var i = 0;
                                                                for(i = 0; i<elem.length; i++){
                                                                    
                                                                    switch(i+1){
                                                                        case 1:
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=Rechner&firma='.$customername.'");break;
                                                                        case 2:
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=Laptop&firma='.$customername.'");break;
                                                                        case 3: 
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=Monitor&firma='.$customername.'");break;
                                                                        case 4: 
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=Drucker&firma='.$customername.'");break;
                                                                        case 5: 
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=Server&firma='.$customername.'");break;
                                                                        case 6: 
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=NAS&firma='.$customername.'");break;
                                                                        case 7: 
                                                                            elem[i].setAttribute("href", "show_data_customer2.php?devicetyp=keine Angabe&firma='.$customername.'");break;
                                                                    }
                                                                }                                                                       
                                                              </script>';
                                                        if(!empty($customername)){
                                                            echo "<p>Kunde: {$customername} </p>";
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
           
                            <div class='col-xl-6'>                                                
                                <div class='box box-info bg-boxshadow mb-30'>                                                    
                                    <div class='box-body'>
                                        <div>
                                            <div class='box-header mb-30'>
                                                <h6 class="box-title mb-3">Herzlich willkommen im Inventar-Tool der Firma ZerBITS GmbH</h6>
                                                <div><strong>Sie sind als <?php echo $_GET["firma"];?> angemeldet.</strong><br/>
                                                    <p></p>
                                                </div>      
                                                <div>
                                                   Über die linke Navigationsleiste können Sie sich die Geräte nach Gerätetyp sortiert anzeigen lassen. 
                                                   Klicken Sie links auf Übersicht, kommen Sie jederzeit wieder auf diese Seite zurück.
                                                   Zum Logout bitte rechts oben klicken.
                                                </div>                                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="ibox bg-boxshadow mb-30">
                                        <h5 class="mb-30">Geräte</h5>
                                        <div class="ibox-content">
                                            <!-- Table Responsive -->
                                            <div class="table-responsive">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                     
                                                    <?php 
                                                    echo "<table class='table table-striped table-bordered dataTable' id='DataTables_Tables_0' aria-describedby='DataTables_Table_0_info' role='grid'>";
                                                    
                                                        error_reporting (E_ALL|E_STRICT);

                                                        // DB-Connection
                                                        require 'settings.php';
                                                        include_once 'db_connection.php';

                                                        // Überprüfung, welcher Kunde gesetzt wurde
                                                        if(isset($_GET["firma"])){  
                                                            $customername = $_GET["firma"];    
                                                            if(!empty($customername)){
                                                                
                                                                $sql  = "SELECT geraet.Bezeichnung, geraetetyp.geraeteart AS 'Geräteart', geraet.CPU, geraet.HDD_SSD_Kapazitaet AS 'Festplattenspeicher', geraet.RAM, geraet.Seriennr, geraet.BS, geraet.Anschaffung 
                                                                        FROM geraet, kunde, geraetetyp
                                                                        WHERE kunde.Kunden_ID = geraet.Kunden_ID AND geraetetyp.Typ_ID = geraet.Typ_ID AND kunde.Firma ='".$customername."'";

                                                                mysqli_query($con, "SET NAMES utf8");

                                                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));                                    
                                                                $ds = mysqli_fetch_assoc($result);
                                                                $dsnumber = mysqli_num_rows($result);
                                                                
                                                                // Abfrage, ob überhaupt Datensätze vorhanden sind, sonst Meldung "Keine Datensätze vorhanden!"
                                                                if ($dsnumber >0){
                                                                    echo"<thead><tr>";
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";
                                                                    }
                                                                    echo "</tr></thead>";
                                                                   
                                                                    mysqli_data_seek($result, 0);
                                                                    
                                                                    echo "<tbody>";
                                                                    for($i = 0; $i < $dsnumber; $i++){
                                                                        $dsitems = mysqli_fetch_row($result); 
                                                                        echo "<tr>";
                                                                        foreach($dsitems as $value){
                                                                                echo "<td>".$value."</td>";   
                                                                        }
                                                                        echo "</tr>";       
                                                                    } 
                                                                    echo "</tbody>";
                                                               
                                                                    echo"<tfoot><tr>";                                                                    
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
    <!-- 'settings.js' für 'settingsPanel.php'(Veränderung der Oberfläche während des Betriebs)-->
    <script src="js/settings.js"></script>

    <!-- plugins for data-table -->
    <script src="js/plugins-js/data-table-js/data-table.bootstrap.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table.min.js"></script>
    <script src="js/plugins-js/data-table-js/data-table-active.js"></script>   
</body>

</html>
