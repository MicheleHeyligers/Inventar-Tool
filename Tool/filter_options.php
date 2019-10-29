<button class="btn dropdown-toggle btn-default" style="box-shadow: none;margin-left: 5px; margin-right: 5px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Filtern nach
</button>
<!-- Dropdown items --> 
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position:absolute;will-change:transform;top:0px;left:0px;transform: translate3d(51px, 189px, 0px);">
    <a class="dropdown-item" href="filter_data.php?devicetyp=Rechner&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Rechner</a>
    <a class="dropdown-item" href="filter_data.php?devicetyp=Laptop&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Laptop</a>
    <a class="dropdown-item" href="filter_data.php?devicetyp=Monitor&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Monitor</a>
    <a class="dropdown-item" href="filter_data.php?devicetyp=Drucker&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Drucker</a>
    <a class="dropdown-item" href="filter_data.php?devicetyp=Server&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Server</a>
    <a class="dropdown-item" href="filter_data.php?devicetyp=NAS&customer=<?php $customername=$_GET['customer'];echo $customername;?>">NAS</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="filter_data.php?devicetyp=keine Angabe&customer=<?php $customername=$_GET['customer'];echo $customername;?>">Keine Angabe</a>
</div>  