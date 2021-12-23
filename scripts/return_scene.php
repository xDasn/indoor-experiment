<?php

$taskOrder = $_POST['taskOr'];
$currentTaskCount = $_POST['taskCount'];

$sceneArray = explode("_", $taskOrder);
$sceneId = $sceneArray[$currentTaskCount-1];
    
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

$AOIleftposition = "-150 -45 -100";
$AOIrightposition = "150 -45 -100";
$AOIleftwidth = "235";
$AOIrightwidth = "235";
$AOIleftheight = "370";
$AOIrightheight = "370";
$AOIopacity = "0";

if (substr($scene,3,3) == "L-W") {
    $AOIleftposition = "-150 -45 10";
    $AOIrightposition = "150 -45 -100";
    $AOIleftwidth = "470";
    $AOIrightwidth = "235";
} elseif (substr($scene,3,3) == "L-N") {
    $AOIleftposition = "-150 -45 -100";
    $AOIrightposition = "150 -45 10";
    $AOIleftwidth = "235";
    $AOIrightwidth = "470";
} else {
    $AOIleftposition = "-150 -45 -100";
    $AOIrightposition = "150 -45 -100";
    $AOIleftwidth = "235";
    $AOIrightwidth = "235";
    $AOIleftheight = "370";
    $AOIrightheight = "370";
};

echo json_encode(array($scene, $scenepath, $AOIleftposition, $AOIrightposition, $AOIleftwidth, 
$AOIrightwidth, $AOIleftheight, $AOIrightheight, $AOIopacity));
 ?>