<?php

$taskOrder = $_POST['taskOr'];
$currentTaskCount = $_POST['taskCount'];

$sceneArray = explode("_", $taskOrder);
$sceneId = $sceneArray[$currentTaskCount]; //25
    
//get whole scene name based on id
$d = dir('../scenes') or die($php_errormsg); 
while (false !== ($f = $d->read())) { 
    if (preg_match('/^'.$sceneId.'.*$/',$f)) { 
        $scene = $f;
    } 
} 
$d->close();

$scenepath = "scenes/".$scene;

//$scene = "04_L-EE1_R-EE1";

$AOIleftposition = "-6 1 -11";
$AOIrightposition = "6 1 -11";
$AOIleftwidth = "12";
$AOIrightwidth = "12";
$AOIleftheight = "12";
$AOIrightheight = "12";
$AOIopacity = "0.25";

if (substr($scene,3,3) == "L-W") {
    $AOIleftposition = "-4 0 -11";
    $AOIrightposition = "8 0.5 -11";
    $AOIleftwidth = "15";
    $AOIrightwidth = "9";
    $AOIleftheight = "14";
    $AOIrightheight = "12";
} elseif (substr($scene,3,3) == "L-N") {
    $AOIleftposition = "-8 0.5 -11";
    $AOIrightposition = "4 0 -11";
    $AOIleftwidth = "9";
    $AOIrightwidth = "15";
    $AOIleftheight = "12";
    $AOIrightheight = "14";
} else {
    $AOIleftposition = "-6 1 -11";
    $AOIrightposition = "6 1 -11";
    $AOIleftwidth = "12";
    $AOIrightwidth = "12";
    $AOIleftheight = "12";
    $AOIrightheight = "12";
};

echo json_encode(array($scene, $scenepath, $AOIleftposition, $AOIrightposition, $AOIleftwidth, 
$AOIrightwidth, $AOIleftheight, $AOIrightheight, $AOIopacity));
 ?>