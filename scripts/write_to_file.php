<?php
$filename = "../data/".$_POST['filename'];

$current = file_get_contents($filename);

$current .= $_POST['filedata']."\n";

file_put_contents($filename, $current);
?>