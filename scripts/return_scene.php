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

$AOIleftposition = "-16 1 -11";
$AOIrightposition = "14 1 -11";
$AOIleftwidth = "22";
$AOIrightwidth = "22";
$AOIleftheight = "40";
$AOIrightheight = "40";
$AOIopacity = "0.25";

if (substr($scene,3,3) == "L-W") {
    $AOIleftposition = "-16 1 -11";
    $AOIrightposition = "14 1 -11";
    $AOIleftwidth = "44";
    $AOIrightwidth = "22";
    $AOIleftheight = "40";
    $AOIrightheight = "40";
} elseif (substr($scene,3,3) == "L-N") {
    $AOIleftposition = "-16 1 -11";
    $AOIrightposition = "14 1 -11";
    $AOIleftwidth = "22";
    $AOIrightwidth = "44";
    $AOIleftheight = "40";
    $AOIrightheight = "40";
} else {
    $AOIleftposition = "-16 1 -11";
    $AOIrightposition = "14 1 -11";
    $AOIleftwidth = "22";
    $AOIrightwidth = "22";
    $AOIleftheight = "40";
    $AOIrightheight = "40";
};

echo json_encode(array($scene, $scenepath, $AOIleftposition, $AOIrightposition, $AOIleftwidth, 
$AOIrightwidth, $AOIleftheight, $AOIrightheight, $AOIopacity));
 ?>