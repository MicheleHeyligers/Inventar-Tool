<?php
session_start();
$_SESSION = array();
session_destroy();
echo "<script type='text/javascript'> 
            alert('Logout erfolgreich');
            window.location='index.php';
      </script>";
?>