<div class="left-sidebar-area">
    <!-- Side Menu Area -->
    <div class="side-menu-area">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="menu-title" style="font-size:1.1em"><a href="start.php?vorname=<?php $vorname=$_SESSION['vorname'];echo $vorname;?>&nachname=<?php $nachname=$_SESSION['nachname'];echo $nachname;?>" style="font-weight:700;text-transform:uppercase;padding:0px;">Übersicht</a></li>
            <li class="treeview"> 
                <a href="javascript:void(0)" class="waves-effect waves-light"><i class="icon_profile"></i><span>Kundenauswahl</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">  
                    <?php    
                        error_reporting (E_ALL|E_STRICT);

                        // DB-Connection
                        require 'settings.php';
                        include 'db_connection.php';
                        
                        $sql = "SELECT * FROM kunde ORDER BY 2";

                        mysqli_query($con, "SET NAMES utf8");
   
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        $ds = mysqli_fetch_assoc($result); // Array mit Datensätzen
                        $dsnumber = mysqli_num_rows($result); // Anzahl Datensätze
                        
                        mysqli_data_seek($result, 0);

                        if ($dsnumber >0){
                            for($i = 0; $i < $dsnumber; $i++){
                                $dsitems = mysqli_fetch_row($result);                               
                                echo "<li><a href='show_data.php?customer={$dsitems[1]}'>{$dsitems[1]}</a></li>";                             
                            }
                        }
                        else{
                            echo "<li>Keine Datensätze vorhanden.</li>";
                        }
                    ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)" class="waves-effect waves-light"><i class="icon_desktop"></i><span>Geräteauswahl</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="show_data.php?devicetyp=Rechner">  1 - Rechner </a></li>
                    <li><a href="show_data.php?devicetyp=Laptop">  2 - Laptop </a></li>
                    <li><a href="show_data.php?devicetyp=Monitor">  3 - Monitor </a></li>
                    <li><a href="show_data.php?devicetyp=Drucker">  4 - Drucker </a></li>
                    <li><a href="show_data.php?devicetyp=Server">  5 - Server </a></li>
                    <li><a href="show_data.php?devicetyp=NAS">  6 - NAS </a></li>
                    <li><a href="show_data.php?devicetyp=keine Angabe">  7 - keine Angabe</a></li>        
                </ul>
            </li>
        </ul>
    </div>
</div>