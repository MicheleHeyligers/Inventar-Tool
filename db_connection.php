<?php 
    $con = mysqli_connect($servername, $username, $password, $daba);

    if(!$con){
        die("Connection failed: ".mysqli_connect_error());
    }
?>