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
                                                    // Variablen abfragen
                                                    if(isset($_GET["customer"])){  
                                                        $customername = $_GET["customer"];
                                                        if(!empty($customername)){
                                                            echo "<p>Kunde: {$customername} </p>";
                                                        }
                                                    }
                                                    else if(isset($_GET["devicetyp"])){
                                                        $device = $_GET["devicetyp"];
                                                        if(!empty($device)){
                                                            echo "<p> Liste aller {$device} </p>";
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                // Variable abfragen
                                if(isset($_GET["customer"])){  
                                    $customername = $_GET["customer"];
                                    if(!empty($customername)){
                                        //Anzeige der Box mit Buttons zum ändern/löschen/hinzufügen
                                    echo "<div class='col-xl-6'>
                                                <!-- Ibox -->
                                                <div class='box box-info bg-boxshadow mb-30'>
                                                    <!-- Ibox Content -->
                                                    <div class='box-body'>
                                                        <div>
                                                            <div class='box-header mb-30'>
                                                                <h5 class='box-title mb-3'>Auswahl</h5>
                                                                <div>
                                                                    <a href='insert_data.php?custname={$customername}' class='btn waves-effect m-2  btn-secondary'>Daten hinzufügen</a>
                                                                    <a href='modify_data.php?custname={$customername}' class='btn waves-effect m-2  btn-secondary'>Daten bearbeiten</a>
                                                                    <a href='delete_data.php?custname={$customername}' class='btn waves-effect m-2  btn-secondary'>Daten löschen</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                }
                                
                            ?>                                    
                                
                            <div class="col-lg-12">
                                <div class="ibox bg-boxshadow mb-30">
                                        <h5 class="mb-30">Geräte</h5>
                                        <div class="ibox-content">
                                            <!-- Table Responsive -->
                                            <div class="table-responsive">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                    <div class="html5buttons-tables" style="margin-bottom: 15px">
                                                        <div class="dt-buttons btn-group">
                                                            <!--'href'-Attribut wird durch script am Ende der Tabelle gesetzt, damit Inhalt der Tabelle mitgegeben werden kann-->
                                                            <a id="pdflink" class="btn btn-default waves-effect buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" href="pdf.php?custname= <?php $customername=$_GET['customer'];echo $customername;?>" target="_blank">                                                            
                                                                <span>PDF</span>
                                                            </a>
                                                            <?php 
                                                                if(isset($_GET["customer"])){
                                                                    include ('filter_options.php');
                                                                } 
                                                            ?>
                                                        </div>
                                                    </div>
                                                      
                                                    <?php 
                                                    echo "<table class='table table-striped table-bordered dataTable' id='DataTables_Tables_0' aria-describedby='DataTables_Table_0_info' role='grid'>";
                                                    // '$html' - for html-content in PDF-file
                                                    $html = "<table class='table table-striped table-bordered dataTable' id='DataTables_Tables_0' aria-describedby='DataTables_Table_0_info' role='grid'>";

                                                        error_reporting (E_ALL|E_STRICT);

                                                        // DB-Connection
                                                        require 'settings.php';
                                                        include_once 'db_connection.php';

                                                        // Überprüfung, welche Variable (Kunde o. Gerätetyp) gesetzt wurde
                                                        if(isset($_GET["customer"])){  
                                                            $customername = $_GET["customer"];    
                                                            if(!empty($customername)){
                                                                
                                                                // SQL-query, um Geräte zu bestimmtem Kunden auszugeben  
                                                                $sql  = "SELECT geraet.Bezeichnung, geraetetyp.geraeteart AS 'Geräteart', geraet.CPU, geraet.HDD_SSD_Kapazitaet AS 'Festplattenspeicher', geraet.RAM, geraet.Seriennr, geraet.BS, geraet.Anschaffung 
                                                                        FROM geraet, kunde, geraetetyp
                                                                        WHERE kunde.Kunden_ID = geraet.Kunden_ID AND geraetetyp.Typ_ID = geraet.Typ_ID AND kunde.Firma ='".$customername."'
                                                                        ORDER BY geraetetyp.geraeteart";

                                                                // alles in utf-8 codieren/ausgeben
                                                                mysqli_query($con, "SET NAMES utf8");

                                                                // Abfrageergebnis in '$result' speichern
                                                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                                                
                                                                // Datensatz-Objekte mit 'fetch-assoc' aus '$result' holen
                                                                $ds = mysqli_fetch_assoc($result);
                                                                // Anzahl der Datensätze (Zeilen) in '$dsnumber' speichern
                                                                $dsnumber = mysqli_num_rows($result);
                                                                
                                                                // Abfrage, ob überhaupt Datensätze vorhanden sind, sonst Meldung "Keine Datensätze vorhanden!"
                                                                if ($dsnumber >0){
                                                                    // Tabellen-Spaltenbezeichner auslesen
                                                                    echo"<thead><tr>";
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";
                                                                    }
                                                                    echo "</tr></thead>";

                                                                    //Datensatzzeiger zurücksetzen
                                                                    mysqli_data_seek($result, 0);

                                                                    /*Tabellen-Werte pro Reihe auslesen 
                                                                    und in Tabellenbody schreiben */
                                                                    echo "<tbody>";
                                                                    $html .= "<tbody>";  

                                                                    // Variables for PDF
                                                                    $_SESSION["countlaptops"]=0;
                                                                    $_SESSION["countrechner"]=0;
                                                                    $_SESSION["countserver"]=0;

                                                                    for($i = 0; $i < $dsnumber; $i++){
                                                                        $dsitems = mysqli_fetch_row($result); //Datensatz extrahieren                                                          
                                                                       
                                                                        $devicetyp = $dsitems[1];                                                                        
                                                                        // count of devicetyp for PDF
                                                                        if ($devicetyp === "Laptop"){
                                                                            $_SESSION["countlaptops"]+=1;
                                                                        }
                                                                        if ($devicetyp === "Rechner"){
                                                                                $_SESSION["countrechner"]+=1;
                                                                        }
                                                                        if ($devicetyp === "Server"){
                                                                                    $_SESSION["countserver"]+=1;
                                                                        } 
                                                                            
                                                                        echo "<tr>";
                                                                        $html .= "<tr>"; 

                                                                        foreach($dsitems as $value){
                                                                                echo "<td>".$value."</td>"; 
                                                                                $html .= "<td>'".$value."'</td>";                                                                       
                                                                        }
                                                                        echo "</tr>"; 
                                                                        $html .= "</tr>";        
                                                                    } 
                                                                    echo "</tbody>";
                                                                    $html .= "</tbody>";

                                                                    // Tabellen-Spaltenbezeichner auslesen
                                                                    echo"<tfoot><tr>";                                                                    
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";                                                                        
                                                                    }
                                                                    echo "</tr></tfoot>";
                                                                    $html .= "</table>";

                                                                    $_SESSION["content"]= "";
                                                                    // $html als Session-Variable setzen, einfache Anführungsstriche in der PDF-Ausgabe entfernen
                                                                    $_SESSION["content"]= str_replace("'", "", $html);
                                                                    
                                                                    mysqli_close($con); 
                                                                }
                                                                else {
                                                                    echo "Keine Datensätze vorhanden!";
                                                                }
                                                            }   
                                                        }
                                                        else if(isset($_GET["devicetyp"])){
                                                            $device = $_GET["devicetyp"];  
                                                            if(!empty($device)){
                                                                // Anfrage, um alle Geräte eines bestimmten Typs auszugeben
                                                                $sql  = "SELECT kunde.Firma, geraet.Bezeichnung, geraet.CPU, geraet.HDD_SSD_Kapazitaet AS 'Festplattenspeicher', geraet.RAM, geraet.Seriennr, geraet.BS, geraet.Anschaffung 
                                                                        FROM geraet, kunde, geraetetyp
                                                                        WHERE geraetetyp.Typ_ID = geraet.Typ_ID AND kunde.Kunden_ID = geraet.Kunden_ID AND geraetetyp.geraeteart= '".$device."'";

                                                                mysqli_query($con, "SET NAMES utf8");

                                                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));                                    
                                                                $ds = mysqli_fetch_assoc($result);
                                                                $dsnumber = mysqli_num_rows($result);

                                                                if ($dsnumber >0){
                                                                    echo"<thead><tr>";
                                                                    foreach($ds as $columname => $value){
                                                                        echo "<th>".$columname."</th>";
                                                                    }
                                                                    echo "</tr></thead>";

                                                                    mysqli_data_seek($result, 0);

                                                                    echo "<tbody>";
                                                                    $html .= "<tbody>";

                                                                    // Variables for PDF
                                                                    $_SESSION["countlaptops"]=0;
                                                                    $_SESSION["countrechner"]=0;
                                                                    $_SESSION["countserver"]=0;
                                                                    
                                                                    for($i = 0; $i < $dsnumber; $i++){
                                                                        $ds = mysqli_fetch_row($result); 

                                                                        $devicetyp = $device;                                                                        
                                                                        // count of devicetyp for PDF
                                                                        if ($devicetyp === "Laptop"){
                                                                            $_SESSION["countlaptops"]+=1;
                                                                        }
                                                                        if ($devicetyp === "Rechner"){
                                                                                $_SESSION["countrechner"]+=1;
                                                                        }
                                                                        if ($devicetyp === "Server"){
                                                                                    $_SESSION["countserver"]+=1;
                                                                        } 
                                                                            
                                                                        echo "<tr>"; 
                                                                        $html .= "<tr>"; 
                                                                        foreach($ds as $value){
                                                                                echo "<td class='gradeA'>".$value."</td>"; 
                                                                                $html .= "<td>'".$value."'</td>";      
                                                                        }
                                                                        echo "</tr>";
                                                                        $html .= "</tr>";  
                                                                    }
                                                                    echo "</tbody>";
                                                                    $html .= "</tbody>";
                                                                    $html .= "</table>";
                                                                   
                                                                    $_SESSION["content"]= "";
                                                                    $_SESSION["content"]= str_replace("'", "", $html);
                                                                    // script, um Gerätetyp an 'pdf.php' zu übergeben
                                                                    echo '<script>
                                                                            var elem = document.getElementById("pdflink");
                                                                                elem.setAttribute("href", "pdf.php?devicetyp='.$device.'");   
                                                                         </script>';
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
