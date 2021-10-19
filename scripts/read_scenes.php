<?php
    $dir = $_GET['directory'];
    $myfiles = array_diff(scandir($dir), array('.', '..'));   
    echo json_encode($myfiles);
?>