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

$AOIleftposition = "-150 -45 0";
$AOIrightposition = "150 -45 0";
$AOIleftwidth = "225";
$AOIrightwidth = "225";
$AOIleftheight = "350";
$AOIrightheight = "350";
$AOIopacity = "0";

if (substr($scene,3,3) == "L-W") {
    $AOIleftposition = "-150 -45 110";
    $AOIrightposition = "150 -45 0";
    $AOIleftwidth = "450";
    $AOIrightwidth = "225";
    //$AOIleftheight = "350";
    //$AOIrightheight = "350";
} elseif (substr($scene,3,3) == "L-N") {
    $AOIleftposition = "-150 -45 0";
    $AOIrightposition = "150 -45 110";
    $AOIleftwidth = "225";
    $AOIrightwidth = "450";
    //$AOIleftheight = "350";
    //$AOIrightheight = "350";
} else {
    $AOIleftposition = "-150 -45 0";
    $AOIrightposition = "150 -45 0";
    $AOIleftwidth = "225";
    $AOIrightwidth = "225";
    $AOIleftheight = "350";
    $AOIrightheight = "350";
};

echo json_encode(array($scene, $scenepath, $AOIleftposition, $AOIrightposition, $AOIleftwidth, 
$AOIrightwidth, $AOIleftheight, $AOIrightheight, $AOIopacity));
 ?>